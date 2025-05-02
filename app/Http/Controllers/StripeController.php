<?php

namespace App\Http\Controllers;

use Stripe\Checkout\Session;
use Illuminate\Http\Request;
use Stripe\Stripe;
use App\Models\Property;


class StripeController extends Controller
{
    
public function checkout(Request $request, Property $property)
{
    // dd($property);
    Stripe::setApiKey(env('STRIPE_SECRET'));

    $session = Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => $property->title,
                ],
                'unit_amount' => $property->price * 100,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => route('payment.success'),
        'cancel_url' => route('home'),
    ]);

    return redirect($session->url);
}

}
