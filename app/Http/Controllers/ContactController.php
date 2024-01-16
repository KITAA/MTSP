<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Models\User;

class ContactController extends Controller
{
    public function index()
    {
        return view('Hubungi.contact');
    }

    public function submitForm(Request $request)
    {
       
            // Get all admin users
            $adminUsers = User::where('usertype', 'admin')->get();

            // Send email to each admin user
            foreach ($adminUsers as $adminUser) {
                $mailData = [
                    'title' => 'Informasi Hubungi',
                    'body' => 'Terima kasih kerana menghubungi kami.',
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'message' => $request->input('message')
                ];

                Mail::to($adminUser->email)->send(new ContactMail($mailData));
            }

            // If you reach here, the emails were sent successfully.
            return back()->with('success', 'Your message has been sent successfully!');
      
    }
}
