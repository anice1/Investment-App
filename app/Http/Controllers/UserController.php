<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Deposit;
use App\deposit_settings;
use CoinbaseCommerce\ApiClient;
use CoinbaseCommerce\Resources\Charge;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
private $st;

  public function __construct()
  {
    
    $this->st = deposit_settings::find(1);
  }
    public function index(){
        $users = User::all()->where('role', '=', 0);
        return view('users', compact('users'));
    }

    public function create(){
        //
    }

    public function store(Request $request){
        $user = User::findOrfail(auth()->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->zip = $request->zip;
        $user->address = $request->address;
        $user->save();

      return back()->with('status', __('Profile Updated Successfully'));
    }

    public function userProfile(){
        return view('profile');
    }
    
    
    public function pay_with_drt_btc(Request $req)
  {    
    try
    {         
      if(!empty(Auth::User()))
      { 
        return view('user.drt_amt');
      }
      else
      {
        return redirect()->route('login');
      }      
    }
    catch(\Exception $e)
    {
      return back()->with([
          'toast_msg' => $e->getMessage(),
          'toast_type' => 'err'
      ]);
    }

    
  }
  
  public function pay_drt_amt(Request $req)
  {   
    try 
    {
      if(!empty(Auth::User()))
      { 
        $user = Auth::User();

        ////////////////////////////// Blockchain api ////////////////////////////////////////////////

        $invoice_id = strtotime(date('Y-m-d')); //'ZzsMLGKe162CfA5EcG6j';
        
        ///////////////////////////////////  Get BTC price ///////////////////////////////////////

        $drt_amt = ($req['amount'] * env('CONVERSION')); 
        $price_btc = file_get_contents("https://www.blockchain.com/tobtc?currency=USD&value=" . $drt_amt); 
        

        $paymt = new Deposit;
        $paymt->user_id = $user->id;
        $paymt->invoice = $invoice_id; 
        $paymt->usn = $user->name;
        $paymt->amount = $price_btc;
        $paymt->currency = env('CURRENCY');
        $paymt->account_name = 'DRT';
        $paymt->account_no = $this->st->BTC_WALLET;
        $paymt->bank = "BTC";
        $paymt->url =  '';
        $paymt->receipt = '';
        $paymt->status = 0;
        $paymt->on_apr = 0;
        $paymt->pop = '';

        $paymt->save();      

        return view('user/drt_amt')->with([
            'drt_amt' => $price_btc,
            'drt_addr' => $this->st->BTC_WALLET
        ]);
       
      }
      else
      {
        return redirect()->route('login');
      } 
        
    } 
    catch (Exception $e) 
    {
      return back()->with([
          'toast_msg' => $e->getMessage(),
          'toast_type' => 'err'
      ]);
    }   
  }
  
  
  public function pay_with_coinbase_btc(){    
    $user = Auth::User();
    if(!empty($user))
    {
      return view('user.pay_coinbase_amt');
    }
    else
    {
      return redirect('/login');
    }
    
  }

  public function pay_btc_coinbase_amt(Request $req){
    
    $user = Auth::User();
    
    if(!empty($user))
    {
      try
      {
        ApiClient::init($this->st->COINBASE_API_KEY);
        $chargeData = [
            'name' => $user->name,
            'description' => env('APP_NAME').' user deposit',
            'local_price' => [
                'amount' => $req->input('amount'),
                'currency' => 'USD'
            ],
            'pricing_type' => 'fixed_price'
        ];
        $details = Charge::create($chargeData);

        $paymt = new Deposit;
        $paymt->user_id = $user->id;
        $paymt->usn = $user->name;
        $paymt->amount = $req->input('amount') * env('CONVERSION');
        $paymt->currency = env('CURRENCY');
        $paymt->account_name = 'Coin Base';
        $paymt->account_no = $details['addresses']['bitcoin'];
        $paymt->bank = "BTC";
        $paymt->url =  $details['hosted_url'];
        $paymt->status = 0;
        $paymt->on_apr = 0;
        $paymt->pop = $details['id'];

        $paymt->save();

        // dd($details);

        return redirect()->away($details->hosted_url);

        // return back()->With(['coinbase_charge' => $details]);
      }
      catch(\Exception $e)
      {
        return back()->With(['toast_msg' => __('messages.err_occr').' '.$e->getMessage(), 'toast_type' => 'err']);
      }
      
    }
    else
    {
      return redirect('/login');
    }
      

  }

  public function coinbase_btc_confirm($id)
  {
    $user = Auth::User();
    if(empty($user))
    {
      return redirect('/login');
    }
    ApiClient::init($this->st->COINBASE_API_KEY);
    $chargeObj = Charge::retrieve($id);
    $status_array = $chargeObj['timeline'];
    $cnt = '';
    foreach($status_array as $status)
    {
      if($status['status'] == "COMPLETED")
      {
        try
        {
          $btc_pay = Deposit::where('pop', $id)->where('status', 0)->get();
          if(count($btc_pay) > 0)
          {
            if($btc_pay[0]->status == 0)
            {
              $btc_pay[0]->status = 1;
              $btc_pay[0]->on_opr = 1;

              $user = User::where('id', $btc_pay->user_id)->get();
              $user->wallet += (FLOAT) $btc_pay->amount;
              $btc_pay[0]->save();
              $user->save();

              return back()->With([
                'toast_msg' => __('messages.dpt_confm_suc'), 
                'toast_type' => 'suc'
              ]);
            }
            if($btc_pay[0]->status == 1)
            {
              return back()->With([
                'toast_msg' => __('messages.dpst_confr'), 
                'toast_type' => 'err'
              ]);
            }

            return back()->With([
              'toast_msg' => __('messages.dpst_rej'), 
              'toast_type' => 'err'
            ]);
          }
          else
          {
            return back()->With([
              'toast_msg' => __('messages.dpst_rcrd'), 
              'toast_type' => 'err'
            ]);
          }
        }
        catch(\Exception $e)
        {
          return back()->With([
            'toast_msg' => __('messages.err_occr').' '.$e->getMessage(), 
            'toast_type' => 'err'
          ]);
        }    
      }
      else
      {
        $cnt = $status['status'];
      }
    }
    return back()->With([
      'toast_msg' => __('messages.sts').': '.$cnt, 
      'toast_type' => 'err'
    ]);
  }

  public function coinbase_cron_btc_deposit()
  {
    ApiClient::init($this->st->COINBASE_API_KEY);
    $jobs = Deposit::where('bank', 'BTC')->where('status', 0)->get();
    foreach($jobs as $job)
    {
      $chargeObj = Charge::retrieve($job->pop);
      $status_array = $chargeObj['timeline'];
      foreach($status_array as $status)
      {
        // echo $status['status'];
        if($status['status'] == "COMPLETED")
        {
          try
          {
            $btc_pay = Deposit::where('pop', $job->pop)->where('status', 0)->get();
            if(!empty($btc_pay))
            {
              $btc_pay->status = 1;
              $btc_pay->on_opr = 1;

              $user = User::where('id', $btc_pay->user_id)->get();
              $user->wallet += (FLOAT) $btc_pay->amount;
              $btc_pay->save();
              $user->save();
            }
            else
            {
              
            }
          }
          catch(\Exception $e)
          {
            
          }    
        }
      }
    }
  }
  
  
  public function pay_with_bcm_btc(Request $req)
  {    
    try
    {         
      if(!empty(Auth::User()))
      { 
        return view('user.bcm_amt');
      }
      else
      {
        return redirect()->route('login');
      }      
    }
    catch(\Exception $e)
    {
      return back()->with([
          'toast_msg' => $e->getMessage(),
          'toast_type' => 'err'
      ]);
    }

    
  }

  public function pay_bcm_amt(Request $req)
  {   
    try 
    {
      if(!empty(Auth::User()))
      { 
        $user = Auth::User();

        ////////////////////////////// Blockchain api ////////////////////////////////////////////////

        $invoice_id = strtotime(date('Y-m-d')); //'ZzsMLGKe162CfA5EcG6j';

        $bc_secrete = $this->st->BCM_SECRETE;
        $my_xpub = $this->st->BC_MY_XPUB; 
        $my_api_key = $this->st->BC_MY_API_KEY;
        $my_callback_url = url('/').'/bcm/cb?invoice_id='.$invoice_id.'&secret='.$bc_secrete;
        $root_url = 'https://api.blockchain.info/v2/receive';
        $parameters = 'xpub=' .$my_xpub. '&callback=' .urlencode($my_callback_url). '&key=' .$my_api_key;
        $response = file_get_contents($root_url . '?' . $parameters);
        $object = json_decode($response);
        // echo 'Send Payment To : ' . $object->address;

        ///////////////////////////////////  Get BTC price ///////////////////////////////////////

        $bcm_amt = ($req['amount'] * env('CONVERSION')); 
        $price_btc = file_get_contents("https://www.blockchain.com/tobtc?currency=USD&value=" . $bcm_amt); 
        

        $paymt = new Deposit;
        $paymt->user_id = $user->id;
        $paymt->invoice = $invoice_id; 
        $paymt->usn = $user->name;
        $paymt->amount = $price_btc;
        $paymt->currency = env('CURRENCY');
        $paymt->account_name = 'BCM';
        $paymt->account_no = $object->address;
        $paymt->bank = "BTC";
        $paymt->url =  '';
        $paymt->receipt = '';
        $paymt->status = 0;
        $paymt->on_apr = 0;
        $paymt->pop = '';

        $paymt->save();      

        return view('user/bcm_amt')->with([
            'bcm_amt' => $price_btc,
            'bcm_addr' => $object->address
        ]);
       
      }
      else
      {
        return redirect()->route('login');
      } 
        
    } 
    catch (Exception $e) 
    {
      return back()->with([
          'toast_msg' => $e->getMessage(),
          'toast_type' => 'err'
      ]);
    }   
  }
  
  
  public function receipt_upload(Request $req){

    $user = Auth::User();
    if(!empty($user))
    {  
      try
      {
        $validate = $req->validate([
         'recPic' => 'required|image|mimes:jpeg,png,jpg|max:500',            
        ]);

        $file = $req->file('recPic');
        $path = $user->name."_receipt_id_".$req->recid.".jpg"; //$req->file('u_file')->store('public/post_img');
        $file->move(public_path('/img/receipts/'), $path);
        
        $rec = Deposit::find($req->recid);
        $rec->receipt = $path;
        $rec->save();


        
        return back();
      }
      catch(\Exception $e)
      {
        
        return back();;
      }
        
    }
    else
    {
      return redirect('/');
    }

  }

  public function bcm_btc_cb(Request $req)
  {
    // dd($req);
    // $address = $req->addr;
    // $status = $req->status;

    ////////////////// Blockchain Callback ////////////////////////////
    $invoice_id = $req['invoice_id'];
    $transaction_hash = $req['transaction_hash'];
    $value_btc = $req['value'] / 100000000;
    $conf = $req['confirmations']; 

    $response = file_get_contents("https://blockchain.info/ticker");
    $object = json_decode($response);
    $C_price = $object->USD->last;
    
    $dep = Deposit::where('invoice', $invoice_id)->get();
    if($conf >= 4 && $dep->status = 0 )
    {
      $user = User::find($dep->user_id);
      $user->wallet += ($value_btc*$C_price) / (float)env('CONVERSION');
      $dep->status = 1;
      $dep->on_apr = 1;
    }

    $dep->save();   
    
    // $dep = deposits::where('account_no', $re)
    
  }
  
  
  public function pay_with_btc(Request $req){    
    $user = Auth::User();
    if(!empty($user))
    {
      return view('user.pay_btc_amt')->with(['coin' => $req['coin']]);
    }
    else
    {
      return redirect('/login');
    }
    
  }

  
  public function pay_btc_amt(Request $req){
    
    $user = Auth::User();
   

    if(!empty($user))
    {
      $cost = (FLOAT) $req->input('amount');
      $currency_base = 'USD';
      $currency_received = $req['coin'];
      $extra_details = "Maxprofit";

      $transaction = \Coinpayments::createTransactionSimple($cost, $currency_base, $currency_received, $extra_details);
      $transaction = json_decode($transaction);
      if($transaction)
      {      
       
        $paymt = new Deposit;
        $paymt->user_id = $user->id;
        $paymt->usn = $user->name;
        $paymt->amount = $cost *  env('CONVERSION');
        $paymt->currency = env('CURRENCY');
        $paymt->account_name = $transaction->txn_id;
        $paymt->account_no = $transaction->address;
        $paymt->bank = $transaction->currency2;
        $paymt->url =  $transaction->status_url;
        $paymt->status = 0;
        $paymt->on_apr = 0;
        $paymt->pop = "";

        $paymt->save();
        
      }
      // return redirect($transaction->status_url);
      return view('user.pay_btc', ['trans' => $transaction]);

      dd($transaction);
    }
    else
    {
      return redirect('/login');
    }
      

  }

  public function btc_confirm(Request $req)
  {
    
    try 
    {
      $ipn = \Coinpayments::validateIPNRequest($req);
      if ($ipn->isApi()) 
      {
        // Payment::find($ipn->txn_id);
        $btc_pay = Deposit::where('account_name', $ipn->txn_id)->get();
        if($btc_pay[0]->status == 0)
        {
          $btc_pay[0]->status = 1;
          $btc_pay[0]->on_opr = 1;
          $btc_pay[0]->save();

          $user = User::where('id', $btc_pay->user_id)->get();
          $user[0]->wallet += (FLOAT) $btc_pay->amount;
          $user[0]->save();
        }
        if($btc_pay[0]->status == 1)
        {
          return back()->With([
            'toast_msg' => __('messages.dpst_confr'), 
            'toast_type' => 'err'
          ]);
        }
        return back()->With([
          'toast_msg' => __('messages.dpst_rej'), 
          'toast_type' => 'err'
        ]);


      }
    }
    catch (IpnIncompleteException $e)
    {
      return back()->With([
        'toast_msg' => __('messages.dpst_rej'), 
        'toast_type' => 'err'
      ]);  
    }

  }
  
  
}
