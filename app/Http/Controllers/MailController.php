<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Symfony\Component\HttpFoundation\Response;

class MailController extends Controller
{
    public function sendEmail($name, $address, $password, $refCode) {
   
        $mailData = [
            'title' => env('APP_NAME'),
            'ref_link' => env('APP_URL').$refCode
        ];
  
        Mail::to($address)->send(new SendMail($mailData));
   
        return response()->json([
            'message' => 'Thank you for choosing '.env('APP_NAME').' Please Check your mail'
        ], Response::HTTP_OK);
    }
}
