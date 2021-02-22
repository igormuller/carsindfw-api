<?php

namespace App\Services\Payment;

use Stripe\StripeClient;

class PaymentService
{
    private $stripe;

    public function __construct()
    {
        $key = env('STRIPE_KEY_SECRET');
        $this->stripe = new StripeClient($key);
    }

    public function getPlans()
    {
        return $this->stripe->plans->all(['limit' => 3]);
    }

    public function createCustomer(array $data)
    {
        return $this->stripe->customers->create($data);
    }

    public function createPaymentMethod(array $data)
    {
        return $this->stripe->paymentMethods->attach('pm_1ILf8cGbi7IeMncT8x4g1lEZ', ['customer' => 'cus_IxZzLrJsiWFUNB']);
//        return $this->stripe->paymentMethods->create($data);
    }

    public function createSubscription(array $data)
    {
        return $this->stripe->subscriptions->create($data);
    }
}
