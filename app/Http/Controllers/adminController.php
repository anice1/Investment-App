<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Deposit;
use App\deposit_settings;


class adminController extends Controller
{
    public function deposit_sett(){
        return view('deposit_settings');
    }
    
    public function deposit(Request $req){
       
            

            try {
                
                $deposit_set = deposit_settings::find(1);

                    //// Coinpayment BTC ///////////////////////////////////////////////////////////////
                     $deposit_set->COINPAYMENTS_DB_PREFIX = 'cp_' ;
                    
                    $deposit_set->COINPAYMENTS_MERCHANT_ID = $req->input('cp_m_id') ;
                 
                    $deposit_set->COINPAYMENTS_PUBLIC_KEY = $req->input('cp_p_key') ;
                    
                   $deposit_set->COINPAYMENTS_PRIVATE_KEY = $req->input('cp_pr_key') ;
                    
                   $deposit_set->COINPAYMENTS_IPN_SECRET = $req->input('cp_ipn_secret');
                    
                    $deposit_set->COINPAYMENTS_IPN_URL = $req->input('cp_ipn_url');
                    
                    if($req->input('switch_BTC') == 0){
                        $deposit_set->SWITCH_BTC = '1';
                    }elseif($req->input('switch_BTC') == 1){
                        $deposit_set->SWITCH_BTC = '0' ;
                    }
                    
                   if($req->input('switch_ETH') == 0){
                        $deposit_set->SWITCH_ETH = '1';
                    }elseif($req->input('switch_ETH') == 1){
                        $deposit_set->SWITCH_ETH = '0';
                    }
                    
                   
                    

                   ///////////////direct payment btc//////////////
                   $deposit_set->BTC_WALLET = $req->input('btc_id') ;
                   
                   if($req->input('btc_switch') == 0){
                        $deposit_set->BTC_SWITCH = '1';
                    }
                    elseif($req->input('btc_switch') == 1){
                        $deposit_set->BTC_SWITCH = '0';
                    }
                    


                    /////////////// Coinbase ////////////////////////////////////////////////////////////////////
                    if($req->input('coinbase_switch') == 0){
                        $deposit_set->COINBASE_SWITCH = '1';
                    }elseif($req->input('coinbase_switch') == 1){
                        $deposit_set->COINBASE_SWITCH = '0';
                    }
                    
                
                    $deposit_set->COINBASE_API_KEY = $req->input('coinbase_key');
                    
                    $deposit_set->COINBASE_WEBHOOK_SECRETE = $req->input('coinbase_seceret');
                    
                    
                    /////////////// Blockchain ////////////////////////////////////////////////////////////////////
                    if($req->input('bc_switch') == 0){
                        $deposit_set->BC_SWITCH = '1';
                    }elseif($req->input('bc_switch') == 1){
                        $deposit_set->BC_SWITCH = '0';
                    }
                    
                    
                    $deposit_set->BCM_SECRETE = $req->input('bc_secrete');
                    
                    $deposit_set->BC_MY_XPUB = $req->input('bc_xpub');
                    
                    $deposit_set->BC_MY_API_KEY = $req->input('bc_api_key');
                   

                    $deposit_set->save();
                
                return redirect()->back()->with('success', 'Added Successful');
            } catch (\Exception $e) {
                return redirect()->back()->with('fail', 'Not Successful');
            }
        
    }
    
    public function deposit_history(){
        $deps = Deposit::all();
        return view('user_deposits', compact('deps'));
    }
    
    public function rejectDep($id){

        try{
            $usr = Deposit::find($id);
            $usr->status = 2;
            $usr->save();
            return back()->with('success', 'Deposit Rejected');
        }catch (\Exception $e){
            
            return back()->with('error', 'Deposit Rejected');
        }
       
    }

    public function approveDep($id){
        try{
            $usr = Deposit::find($id);
            $usr->status = 1;
            $usr->save();
            return back()->with('success', 'Deposit Approved');
            
            } catch (\Exception $e) {
                return back()->with('error', $e);
        }
    }

    public function deleteDep($id)
    {
            try {

                $deposit = Deposit::find($id);
                $deposit->delete();
                $deposit->save();
                return back()->with([
                    'toast_msg' => __('deposit Deleted'),
                    'toast_type' => 'err'
                ]);

            } catch (\Exception $e) {

                return back()->with([
                    'toast_msg' => __($e),
                    'toast_type' => 'err'
                ]);
            }
        
    }


    public function admin_addfund($id){
        $user = User::find($id);
        $deposit = Deposit::all()->where('user_id',$id);
        $total_deposits = $deposit->where('status',1)->sum('amount');

        return view('add_payment',['user' => $user, 'total_deposits' =>$total_deposits]);

    }

   
}
