<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Deposit;

class HomeController extends Controller
{
    
    
    public function index(Deposit $deposit, User $user){
        $path = 'https://skycapitalglobal.com/register/';
        $ref_code = auth()->user()->ref_code;

        //get auth user referal code
        $ref_code = $path.$ref_code;
        $referals = count($user->where('ref_by', auth()->user()->ref_code)->get());

        //get auth user payments

        if(! count($deposit->all()) > 0){
            $total_deposits = 0;
            $gains = 0;
        }
        else{

            if(auth()->user()->role >=1){
                $total_deposits = $deposit->all()->where('status',1)->sum('amount');
                $gains = $deposit->where('paid',0)->where('status',1)->where('date_for_payment','<', now())->sum('gain');   
            }
            else{
            
                $total_deposits = auth()->user()->deposits->where('paid',0)->where('status',1)->sum('amount');
                $gains = auth()->user()->deposits->where('paid',0)->where('status',1)->sum('gain');
            }     
        }
        return view('dashboard', compact('ref_code','total_deposits', 'gains', 'referals'));

    }
    
}
