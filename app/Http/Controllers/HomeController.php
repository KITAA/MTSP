<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Membership;
use App\Models\Payment;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == 'admin') {
                $totalUser=User::all()->count();
                $totalMembership=Membership::all()->count();
                $totalMoney=Payment::all()->sum('price');
                return view('admin.dashboard', compact('totalUser', 'totalMembership', 'totalMoney'));
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
