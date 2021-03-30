<?php

namespace App\Http\Controllers;

use App\Enums\TypeEnum;
use App\Http\Requests\PaymentMethodRequest;
use App\Services\Payment\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Exception\CardException;

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
