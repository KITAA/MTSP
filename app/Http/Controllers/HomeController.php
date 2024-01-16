<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $berita = Berita::orderBy('created_at', 'ASC')->get();

        if (Auth::check()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == 'admin') {
                return view('admin.dashboard', compact('berita'));
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
