<?php

namespace App\Services\Payment;

use App\Enums\TypeEnum;
use App\Models\PlanType;
use App\Models\User;
use App\Services\Company\CompanyService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Stripe\Customer;
use Stripe\PaymentMethod;
use Stripe\StripeClient;
use Stripe\Subscription;

class PaymentService
{
    private $stripe;

    public function __construct()
    {
        $key = env('STRIPE_KEY_SECRET');
        $this->stripe = new StripeClient($key);
    }

    public function createCustomer(array $data, PaymentMethod $paymentMethod) : Customer
    {
        $data = $this->prepareDataCustomer($data, $paymentMethod);
        return $this->stripe->customers->create($data);
    }

    public function createPaymentMethod(array $data) : PaymentMethod
    {
        $data = $this->prepareDataPaymentMethod($data);
        return $this->stripe->paymentMethods->create($data);
    }

    public function createSubscription(string $customer, PlanType $planType) : Subscription
    {
        $data = [
            'customer'          => $customer,
            'items'             => [['price' => $planType->stripe_id]],
            'trial_period_days' => $planType->trial_period_days ?? 0,
        ];
        return $this->stripe->subscriptions->create($data);
    }

    private function prepareDataCustomer(array $data, PaymentMethod $paymentMethod) : array
    {
        $customerData = [
            'address' => [
                'country'     => 'US',
                'city'        => $data['address']['city_name'],
                'state'       => $data['address']['state_initials'],
//                'line1'       => $data['address']['number'] . ',' . $data['address']['street'],
//                'line2'       => $data['address']['complements'],
                'postal_code' => $data['address']['zipcode'],
            ],
            'email' => $data['user_email'],
            'phone' => $data['phone']?? null,
            'name'  => $data['type'] === 'person' ? $data['user_name'] : $data['name'],
            'metadata' => [
                'company' => $data['company_id'],
            ],
            'payment_method'   => $paymentMethod->id,
            'invoice_settings' => [
                'default_payment_method' => $paymentMethod->id,
            ],
        ];
        return $customerData;
    }

    public function cratePaymentIntent(int $amount, string $customer_id, string $payment_method_id)
    {
        return $this->stripe->paymentIntents->create([
            'amount' => $amount,
            'currency' => 'usd',
            'customer' => $customer_id,
            'payment_method' => $payment_method_id,
            'payment_method_types' => ['card'],
            'off_session' => true,
            'confirm' => true
        ]);
    }

    private function prepareDataPaymentMethod(array $data) : array
    {
        $expiration = explode('/', $data['card_expiration_date']);
        $paymentMethodData = [
            'type' => 'card',
            'card' => [
                'number'    => $data['card_number'],
                'exp_month' => $expiration[0],
                'exp_year'  => $expiration[1],
                'cvc'       => $data['card_cvv'],
            ],
            'billing_details' => [
                'name' => $data['card_name']
            ]
        ];
        return $paymentMethodData;
    }

    public function attachCardInCustomer(string $payment_method_id, string $customer_id) : PaymentMethod
    {
        $paymentMethod = $this->stripe->paymentMethods->attach($payment_method_id, ['customer' => $customer_id]);
        return $paymentMethod;
    }

    public function cancelSubscriptionByCustomer(string $customer_id) : bool
    {
        $subscriptions = $this->stripe->subscriptions->all(['customer' => $customer_id]);
        $subscription = $this->stripe->subscriptions->cancel($subscriptions->data[0]->id);
        return $subscription->status === 'canceled'? true : false;
    }

    public function userAllDetail(string $customer_id) : array
    {
        $user = Auth::user();
        $detail['customer']        = $this->dataCustomer($customer_id, $user);
        $detail['payment_methods'] = $this->dataPaymentMethodByCustomer($customer_id);
        $detail['payment_intents'] = $this->dataPaymentIntentByCustomer($customer_id);
        $detail['subscription']    = $this->dataSubscriptionByCustomer($customer_id);
        $detail['invoices']        = $this->dataInvoicesByCustomer($customer_id);
        return $detail;
    }

    public function dataCustomer(string $customer_id, User $user) : array
    {
        $customer = $this->stripe->customers->retrieve($customer_id);
        $service  = new CompanyService();
        $data['plan_type'] = $service->detailByPlanType($user->company);
        $data['last_plan'] = $service->detailLastPlan($user->company);
        $data['plans']     = $service->detailByPlans($user->company);
        $data['email']     = $customer->email;
        $data['name']      = $customer->name;
        $data['status']    = TypeEnum::getCompanyStatusName($user->company->status);
        return $data;
    }

    public function dataPaymentMethodByCustomer(string $customer_id) : array
    {
        $data = [];

        $paymentMethods       = $this->stripe->paymentMethods->all(['customer' => $customer_id, 'type' => 'card']);
        $customer             = $this->stripe->customers->retrieve($customer_id);
        $paymentMethodDefault = $customer->invoice_settings->default_payment_method;

        foreach ($paymentMethods as $key => $paymentMethod) {
            $card = [
                'default'    => $paymentMethodDefault === $paymentMethod->id,
                'brand'      => Str::upper($paymentMethod->card->brand),
                'expiration' => $paymentMethod->card->exp_month . '/' . $paymentMethod->card->exp_year,
                'last4'      => $paymentMethod->card->last4,
                'id'         => $paymentMethod->id,
            ];
            $data[$key] = $card;
        }
        return $data;
    }

    public function defaultPaymentMethod(string $payment_method_id, string $customer_id)
    {
        $data = [
            'invoice_settings' => ['default_payment_method' => $payment_method_id]
        ];
        $this->stripe->customers->update($customer_id, $data);
    }

    public function deletePaymentMethod(string $payment_method_id)
    {
        $this->stripe->paymentMethods->detach($payment_method_id);
    }

    public function dataPaymentIntentByCustomer(string $customer_id) : array
    {
        $data = [];
        $paymentIntents = $this->stripe->paymentIntents->all(['customer'=>$customer_id]);
        foreach ($paymentIntents as $key => $paymentIntent) {
            $aux = [
                'amount'              => $paymentIntent->amount,
                'amount_front'        => $this->formatCurrency($paymentIntent->amount),
                'canceled_at'         => $this->formatDate($paymentIntent->canceled_at),
                'cancellation_reason' => $paymentIntent->cancellation_reason,
                'created'             => $this->formatDate($paymentIntent->created),
                'description'         => $paymentIntent->statement_descriptor,
                'status'              => $paymentIntent->status,
            ];
            $data[$key] = $aux;
        }
        return $data;
    }

    public function dataSubscriptionByCustomer(string $customer_id) : array
    {
        $data = [];
        $subscriptions = $this->stripe->subscriptions->all(['customer' => $customer_id]);
        foreach ($subscriptions as $key => $subscription) {
            $aux = [
                'billing_cycle_anchor'   => $this->formatDate($subscription->billing_cycle_anchor),
                'created'                => $this->formatDate($subscription->created),
                'current_period_start'   => $this->formatDate($subscription->current_period_start),
                'current_period_end'     => $this->formatDate($subscription->current_period_end),
                'plan_amount_front'      => $this->formatCurrency($subscription->plan->amount),
                'plan_amount'            => $subscription->plan->amount,
                'plan_trial_period_days' => $subscription->plan->trial_period_days,
                'start_date'             => $this->formatDate($subscription->start_date),
                'status'                 => $subscription->status,
                'trial_end'              => $this->formatDate($subscription->trial_end),
                'trial_start'            => $this->formatDate($subscription->trial_start),
            ];
            $data[$key] = $aux;
        }
        return $data;
    }

    public function dataInvoicesByCustomer(string $customer_id) : array
    {
        $data = [];
        $invoices = $this->stripe->invoices->all(['customer' => $customer_id]);
        foreach ($invoices as $key => $invoice) {
            $aux = [
                'amount_paid'       => $invoice->amount_paid,
                'amount_paid_front' => $this->formatCurrency($invoice->amount_paid),
                'created'           => $this->formatDate($invoice->created),
                'customer_email'    => $invoice->customer_email,
                'customer_name'     => $invoice->customer_name,
                'number'            => $invoice->number,
                'status'            => $invoice->status,
            ];
            $data[$key] = $aux;
        }
        return $data;
    }

    private function formatDate($date) :? string
    {
        return empty($date) ? null : Carbon::parse($date)->format('Y-m-d');
    }

    private function formatCurrency(string $amount) : string
    {
        return substr_replace($amount, '.', (strlen($amount)-2), 0);
    }
}
