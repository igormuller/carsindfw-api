<?php

namespace App\Http\Controllers;

use App\Enums\TypeEnum;
use App\Http\Requests\PaymentMethodRequest;
use App\Models\PlanType;
use App\Services\Payment\PaymentService;
use App\Services\Plan\AdminPlanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Exception\ApiErrorException;
use Stripe\Exception\CardException;
use Stripe\Exception\OAuth\InvalidScopeException;

class PaymentController extends Controller
{
    private $service;

    public function __construct() {
        $this->service = new PaymentService();
    }

    public function cancelSubscription()
    {
        $company = Auth::user()->company;
        $response = $this->service->cancelSubscriptionByCustomer($company->stripe_id);

        if ($response) {
            $company->status = TypeEnum::COMPANY_STATUS_CANCELED;
            $company->save();
            return \response(["message" => "Subscription canceled"]);
        }
        return \response(["message" => "Error when cancel Subscription"]);
    }

    public function detailGeneral()
    {
        $user = Auth::user();
        return $this->service->userAllDetail($user->company->stripe_id);
    }

    public function detailCustomer()
    {
        $user = Auth::user();
        return $this->service->dataCustomer($user->company->stripe_id, $user);
    }

    public function detailPaymentMethod()
    {
        $user = Auth::user();
        return $this->service->dataPaymentMethodByCustomer($user->company->stripe_id);
    }

    public function detailPaymentIntent()
    {
        $user = Auth::user();
        return $this->service->dataPaymentIntentByCustomer($user->company->stripe_id);
    }

    public function detailSubscription()
    {
        $user = Auth::user();
        return $this->service->dataSubscriptionByCustomer($user->company->stripe_id);
    }

    public function detailInvoice()
    {
        $user = Auth::user();
        return $this->service->dataInvoicesByCustomer($user->company->stripe_id);
    }

    public function newPaymentMethod(PaymentMethodRequest $request)
    {
        try {
            $paymentMethod = $this->service->createPaymentMethod($request->all());

            $user = Auth::user();
            $this->service->attachCardInCustomer($paymentMethod->id, $user->company->stripe_id);
            return response('Payment created!' . $paymentMethod);
        } catch (CardException $e) {
            return response(['message' => $e->getMessage()], 402);
        }
    }

    public function contractNewPlan(Request $request)
    {
        $request->validate(['plan' => 'required|integer|exists:plan_types,id']);
        try {
            $user = Auth::user();
            $type = PlanType::find($request->plan);
            $planService = new AdminPlanService();

            $amount = number_format($type->value, 2, '', '');
            $paymentMethod = $this->service->getPaymentMethodDefault($user->company->stripe_id);
            $paymentIntent = $this->service->cratePaymentIntent(
                $amount, $user->company->stripe_id, $paymentMethod, ['description' => $type->description]);

            $newPlan = $planService->newPlan($type, $user->company);

            return response(['new_plan' => $newPlan]);
        } catch (ApiErrorException $e) {
            return response(['message' => $e->getMessage()], 402);
        }
    }

    public function changeSubscription(Request $request)
    {
        $request->validate(['plan' => 'required|integer|exists:plan_types,id']);
        try {
            $user = Auth::user();
            $type = PlanType::find($request->plan);
            $planService = new AdminPlanService();

            $subscription = $this->service->getFirstSubscription($user->company->stripe_id, ['status' => 'active']);
            if (empty($subscription)) {
                $subscription = $this->service->getFirstSubscription($user->company->stripe_id, ['status' => 'trialing']);
            }
            if (empty($subscription)) {
                throw new InvalidScopeException('No active or trialing subscription found!', 402);
            }

            $planService->create($type, $user->company_id);
            $company = $user->company;
            $company->plan_type_id = $type->id;
            $company->save();
            return $this->service->changeSubscription($type, $subscription->id);
        } catch (ApiErrorException $e) {
            return response(['message' => $e->getMessage()], 402);
        }
    }

    public function defaultPaymentMethod(Request $request)
    {
        $request->validate(['id' => 'required']);
        try {
            $user = Auth::user();
            $this->service->defaultPaymentMethod($request->id, $user->company->stripe_id);
        } catch (CardException $e) {
            return response(['message' => $e->getMessage()], 402);
        }
    }

    public function deletePaymentMethod($id)
    {
//        $request->validate(['id' => 'required']);
        try {
            $this->service->deletePaymentMethod($id);
        } catch (CardException $e) {
            return response(['message' => $e->getMessage()], 402);
        }
    }

    public function webhook(Request $request)
    {
        return "teste";
    }
}
