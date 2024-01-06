<?php

namespace App\Http\Controllers;

use App\Models\Infaq;
use App\Models\InfaqStatus;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class InfaqController extends Controller
{
    public function derma(Request $request)
    {
        return view('Infaq.derma', [
          'user' => $request->user(),
      ]);
    }

    public function bayar(Request $request)
    {
      $stripe = new \Stripe\StripeClient(env('STRIPE_SK'));

      $user = $request->user();

      $infaq = Infaq::create([
          'email' => $user->email,
          'donationAmount' => $request->donationAmount,
      ]);

      $stripe->customers->create([
        'email' => $infaq->email,
      ]);

      $session = $stripe->checkout->sessions->create([
          'customer_email' => $infaq->email,
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
      $stripe = new \Stripe\StripeClient(env('STRIPE_SK'));
      
      try {
        $session = $stripe->checkout->sessions->retrieve($_GET['session_id']);
        if (!$session) {
            throw new NotFoundHttpException;
       }

        $sstatus = InfaqStatus::where('session_id', $session->id)->first();
        if (!$sstatus) {
            throw new NotFoundHttpException();
        }
        
        if ($sstatus && $sstatus->status == 'unpaid') {
            $sstatus->status = 'paid';
            $sstatus->save();
        }

        return view('infaq.success');

      } catch (\Exception $e) {
        throw new NotFoundHttpException();
      }

      /* try {
        $session = $stripe->checkout->sessions->retrieve($_GET['session_id']);
        if (!$session) {
            throw new NotFoundHttpException;
        }
        $customer = \Stripe\Customer::retrieve($session->customer);

        $sstatus = InfaqStatus::where('session_id', $session->id)->first();
        if (!$sstatus) {
            throw new NotFoundHttpException();
        }
        if ($sstatus->status === 'unpaid') {
            $sstatus->status = 'paid';
            $sstatus->save();
        }
        return view('infaq.success', compact('customer'));

      } catch (\Exception $e) {
        throw new NotFoundHttpException();
      } */
    }

    public function cancel()
    {
        return view('Infaq.cancel');
    }

    public function webhook()
    {      
      // This is your Stripe CLI webhook secret for testing your endpoint locally.
      $endpoint_secret = env('STRIPE_WEBHOOK');
      
      $payload = @file_get_contents('php://input');
      $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
      $event = null;
      
      try {
          $event = \Stripe\Webhook::constructEvent(
          $payload, $sig_header, $endpoint_secret
        );
      } catch(\UnexpectedValueException $e) {
        // Invalid payload
        return response('', 400);
;      } catch(\Stripe\Exception\SignatureVerificationException $e) {
        // Invalid signature
        return response('', 400);
      }
      
      // Handle the event
      switch ($event->type) {
        case 'payment_intent.succeeded':
          $session = $event->data->object;

          $sstatus = InfaqStatus::where('session_id', $session->id)->first();
          if ($sstatus && $sstatus->status == 'unpaid') {
            $sstatus->status = 'paid';
            $sstatus->save();
          }
          

        // ... handle other event types
        default:
          echo 'Received unknown event type ' . $event->type;
      }
      
      return response('');
    }
}
