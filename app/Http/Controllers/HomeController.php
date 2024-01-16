<?php

namespace App\Http\Controllers;


use App\Models\Infaq;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Membership;
use App\Models\Payment;

class HomeController extends Controller
{
    public function index()
    {
        $berita = Berita::orderBy('created_at', 'ASC')->get();

        if (Auth::check()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == 'admin') {
                $totalUser=User::all()->count();
                $totalMembership=Membership::all()->count();
                $totalMoney=Payment::all()->sum('price');
                $totalInfaq=Infaq::all()->sum('donationAmount');
                $membership=Membership::where('status', 'Dalam proses')->get();
                $infaq = Infaq::where('status', 'paid')->get();
                $user = User::all();
                
                return view('admin.dashboard', compact('totalUser', 'totalMembership', 'totalMoney', 'totalInfaq', 'membership', 'infaq', 'user'));
            } 
            
            elseif ($usertype == 'user') {
                return view('dashboard', compact('berita'));
            } 
            
            else {
                return redirect()->back();
            }
        } else {
            // The user is a guest
            return view('dashboard', compact('berita'));
        }

    }    

}
