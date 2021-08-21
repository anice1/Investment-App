<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Referal;

class ReferalController extends Controller
{
    public function index(){
        $path = 'https://skycapitalglobal.com/register/';
        $user = Referal::all()->where('user_id', '=', auth()->user()->id)->first();

        $ref_code = $path.$user->ref_code;
        return view('referals', compact('ref_code'));
    }
}
