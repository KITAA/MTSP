<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Membership;
use App\Notifications\DaftarAhliNotification;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == 'admin') {
                return view('admin.dashboard');
            } 
            
            elseif ($usertype == 'user') {
                return view('dashboard');
            } 
            
            else {
                return redirect()->back();
            }
        } else {
            // The user is a guest
            return view('dashboard');
        }
    }    
}
