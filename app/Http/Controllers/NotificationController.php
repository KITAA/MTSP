<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function removeNotif($id)
    {
        auth()->user()->notifications()->where('id', $id)->delete();
        
        return redirect()->back();
    }
}
