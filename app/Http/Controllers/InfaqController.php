<?php

namespace App\Http\Controllers;

use App\Models\Infaq;
use Illuminate\Support\Facades\Mail;
use App\Mail\InfaqMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class InfaqController extends Controller
{
  public function derma()
  {
    if (Auth::check()) {
      $user = auth()->user();
      $infaqHistory = Infaq::where('email', $user->email)->orderBy('created_at', 'desc')->get();


      if ($infaqHistory) {
        return view('Infaq.derma', [
          'infaqHistory' => $infaqHistory
        ]);
      }
    }

    //dd($infaq);
    return view('Infaq.derma');
  }

  public function bayar(Request $request)
  {
    $stripe = new \Stripe\StripeClient(env('STRIPE_SK'));

    if (Auth::check()) {
      $user = auth()->user();
      $email = $user->email;
    } else {
      $email = $request->email;
    }

    $stripe->customers->create([
      'email' => $email,
    ]);

    $session = $stripe->checkout->sessions->create([
      'customer_email' => $email,
      'line_items' => [
        [
          'price_data' => [
            'currency' => 'MYR',
            'product_data' => [
              'name' => "Infaq"
            ],
            'unit_amount' => $request->donationAmount * 100,
          ],
          'quantity' => 1,
        ],
      ],
      'mode' => 'payment',
      'success_url' => route('infaq.success', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
      'cancel_url' => route('infaq.cancel', [], true),
    ]);

    $infaq = Infaq::create([
      'email' => $email,
      'donationAmount' => $request->donationAmount,
      'status' => 'unpaid',
      'session_id' => $session->id
    ]);

    $infaq->save();

    return redirect($session->url);
  }

  public function success()
  {
    $stripe = new \Stripe\StripeClient(env('STRIPE_SK'));

    try {
      $session = $stripe->checkout->sessions->retrieve($_GET['session_id']);
      if (!$session) {
        throw new NotFoundHttpException;
      }

      $sstatus = Infaq::where('session_id', $session->id)->first();

      if ($sstatus && $sstatus->status == 'unpaid') {
        $sstatus->status = 'paid';
        $sstatus->save();

        $mailData = [
          'title' => 'Receipt Infaq',
          'body' => 'Terima kasih kerana menginfaq kearah kebaikan.',
        ];
        $infaq = $sstatus;

        Mail::to($sstatus->email)->send(new InfaqMailable($mailData, $infaq));
      }

      if (Auth::check()) {
        $user = auth()->user();
        $infaqHistory = Infaq::where('email', $user->email)->orderBy('created_at', 'desc')->get();

        if ($infaqHistory) {
          return view('Infaq.derma', [
            'infaqHistory' => $infaqHistory
          ]);
        }
      }

      //dd($infaq);
      return view('Infaq.derma');
    } catch (\Exception $e) {
      throw new NotFoundHttpException();
    }
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
        $payload,
        $sig_header,
        $endpoint_secret
      );
    } catch (\UnexpectedValueException $e) {
      // Invalid payload
      return response('', 400);;
    } catch (\Stripe\Exception\SignatureVerificationException $e) {
      // Invalid signature
      return response('', 400);
    }

    // Handle the event
    switch ($event->type) {
      case 'payment_intent.succeeded':
        $session = $event->data->object;

        $sstatus = Infaq::where('session_id', $session->id)->first();
        if ($sstatus && $sstatus->status == 'unpaid') {
          $mailData = [
            'title' => 'Receipt Infaq',
            'body' => 'Terima kasih kerana menginfaq kearah kebaikan.',
          ];
          $infaq = $sstatus;

          Mail::to($sstatus->email)->send(new InfaqMailable($mailData, $infaq));
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
