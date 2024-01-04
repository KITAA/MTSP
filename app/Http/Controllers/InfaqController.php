<?php

namespace App\Http\Controllers;

use App\Models\Infaq;
use App\Models\InfaqStatus;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class InfaqController extends Controller
{
    public function derma()
    {
        return view('Infaq.derma');
    }

    public function bayar(Request $request)
    {
      $stripe = new \Stripe\StripeClient(env('STRIPE_SK'));

        $infaq = Infaq::create([
            'email' => "",
            'donationAmount' => $request->donationAmount,
        ]);

        $session = $stripe->checkout->sessions->create([
            'line_items' => [
              [
                'price_data' => [
                  'currency' => 'MYR',
                  'product_data' => [
                    'name' => "Infaq"],
                  'unit_amount' => $infaq->donationAmount*100,
                ],
                'quantity' => 1,
              ],
            ],
            'mode' => 'payment',
            'success_url' => route('infaq.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('infaq.cancel', [], true),
        ]);

        $infaqStatus = new InfaqStatus();
        $infaqStatus->donationAmount = $infaq->donationAmount;
        $infaqStatus->status = 'unpaid';
        $infaqStatus->session_id = $session->id;
        $infaqStatus->save();

        return redirect($session->url);
    }

    public function success(Request $request)
    {
      
      /* $stripe = new \Stripe\StripeClient(env('STRIPE_SK'));

      $session = $stripe->checkout->sessions->retrieve($_GET['session_id']);

      if(!$session)
      {
        throw new NotFoundHttpException;
      }

      $customer = $stripe->customers->retrieve($session->customer);
      
      return view('Infaq.success', compact('customer')); */
      
      return view('Infaq.success');
    }

    public function cancel()
    {
        return view('Infaq.cancel');
    }
}
