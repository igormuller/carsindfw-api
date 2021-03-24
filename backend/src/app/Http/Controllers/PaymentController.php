<?php

namespace App\Http\Controllers;

use App\Enums\TypeEnum;
use App\Services\Payment\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function webhook(Request $request)
    {
        return "teste";
    }
}
