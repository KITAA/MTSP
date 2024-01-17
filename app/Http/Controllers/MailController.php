<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReceiptMail;

class MailController extends Controller
{
    public function sendEmail()
    {

        $payment = session()->get('payment');
        
        $mailData = [
            'title' => 'Receipt Pendaftaran Ahli',
            'body' => 'Terima kasih kerana mendaftar sebagai ahli. Berikut adalah maklumat pembayaran anda.',
        ];
         
        Mail::to($payment->email)->send(new ReceiptMail($mailData, $payment));

        session()->forget('payment');

        return redirect()->route('membership.success');
        
    }
}
