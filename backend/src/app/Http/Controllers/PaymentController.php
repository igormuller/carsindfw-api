<?php

namespace App\Http\Controllers;

use App\Services\Payment\PaymentService;
use Illuminate\Http\Request;
use Stripe\StripeClient;

class PaymentController extends Controller
{

    public function testePayment()
    {
        $key = env('STRIPE_KEY_SECRET');
        $stripe = new StripeClient($key);
        return $stripe->subscriptions->all(['customer'=>'cus_J02EfIB9KRUyP2']);
    }

    public function webhook(Request $request)
    {
        return "teste";
    }
}
