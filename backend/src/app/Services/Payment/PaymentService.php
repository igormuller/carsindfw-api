<?php

namespace App\Services\Payment;

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

    public function createPaymentMethodAndCustomer(array $data) : string
    {
        $paymentMethod = $this->createPaymentMethod($data);
        $customer = $this->createCustomer($data, $paymentMethod);
        return $customer->id;
    }

    public function createPaymentMethod(array $data) : PaymentMethod
    {
        $data = $this->prepareDataPaymentMethod($data);
        return $this->stripe->paymentMethods->create($data);
    }

    public function createSubscription(string $customer, string $price, int $trialPeriod = null) : Subscription
    {
        $data = [
            'customer' => $customer,
            'items' => [['price' => $price]],
        ];
        if (!empty($trialPeriod)) {
            $data['trial_period_days'] = $trialPeriod;
        }

        return $this->stripe->subscriptions->create($data);
    }

    private function prepareDataCustomer(array $data, PaymentMethod $paymentMethod) : array
    {
        $customerData = [
            'address' => [
                'coutry'      => 'US',
                'city'        => $data['address']['city_name'],
                'state'       => $data['address']['state_initials'],
//                'line1'       => $data['address']['number'] . ',' . $data['address']['street'],
//                'line2'       => $data['address']['complements'],
                'postal_code' => $data['address']['zipcode'],
            ],
            'email' => $data['user_email'],
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
        ];
        return $paymentMethodData;
    }
}
