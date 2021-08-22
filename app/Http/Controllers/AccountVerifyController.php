<?php

namespace App\Http\Controllers;

use App\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\Verified;

class AccountVerifyController extends Controller
{
   public function sendVerificationEmail(Request $request){
       if($request->user()->hasVerifiedEmail()){
           return ['status'=>'Email Already Verified'];
       }
       $request->user()->sendEmailVerificationNotification();
       return view('auth.verify');
   }

   public function verify(EmailVerificationRequest $request){
    
    if($request->user()->hasVerifiedEmail()){
        return ['status'=>'Email Already Verified'];
    }

    if($request->user()->markEmailAsVerified()){
        event(new Verified($request->user()));   
    }

    return ['status'=>'Email has been verified'];

   }

}
