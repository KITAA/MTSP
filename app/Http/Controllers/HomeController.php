<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == 'user') {
                return view('dashboard');
            } elseif ($usertype == 'admin') {
                return view('admin.dashboard');
            } else {
                return redirect()->back();
            }
        } else {
            // The user is a guest
            return view('dashboard');
        }
    }
    
    
}
