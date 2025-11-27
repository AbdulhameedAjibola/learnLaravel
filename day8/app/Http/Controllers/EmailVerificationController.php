<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\DB; 


// Email notice Handler
class EmailVerificationController extends Controller
{
     public function verifyNotice()
    {
        
        return view('auth.verify-email');
    }

    //email verification handler
    public function verifyEmail (EmailVerificationRequest $request) 
    {
        
        $request->fulfill();

        return redirect('/');
    }


    //emaiil verification resend handler
    public function verifyHandler(Request $request)
    {
        
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}
