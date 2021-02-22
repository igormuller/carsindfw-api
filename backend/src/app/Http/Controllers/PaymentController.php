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
        $data = $stripe->subscriptions->all(['customer'=>'cus_IxZzLrJsiWFUNB']);
//        return $data->data[0];
        return date('d/m/Y H:i:s', $data->data[0]->current_period_end);
    }

    public function webhook(Request $request)
    {
        return "teste";
    }

    public function plans()
    {
        $service = new PaymentService();
        return $service->getPlans();
    }

    public function customer()
    {
        $data = [
            'address' => [
                'city' => 22246,
                'line1' => '3430,Country square DR',
                'postal_code' => 74552,
                'state' => 29,
            ],
            'email' => 'teste@teste2.com',
            'metadata' => ['company' => 17],
            'name' => 'Teste Dealer2'
        ];
        $service = new PaymentService();
        return $service->createCustomer($data);
    }

    public function paymentMethods()
    {
        $data = [
            'type' => 'card',
            'card' => [
                'number' => '4242424242424242',
                'exp_month' => 2,
                'exp_year' => 2022,
                'cvc' => '314',
            ],
        ];
        $service = new PaymentService();
        return $service->createPaymentMethod($data);
    }

    public function subscription()
    {
        $data = [
            'customer' => 'cus_IxZzLrJsiWFUNB',
            'items' => [
                ['price' => 'price_1ILdGQGbi7IeMncTkbztU8Qx']
            ]
        ];
        $service = new PaymentService();
        return $service->createSubscription($data);
    }
}
