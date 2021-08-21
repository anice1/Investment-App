@extends('layouts.layout')
@section('title') Deposit Settings @endsection
@section('content')
<div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-safe icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Deposits 
                    <div class="page-title-subheading">Hello {{Auth()->user()->name}}, Welcome to Deposits Settings.</div>
                </div>
            </div>
        </div>
    </div>        

   <div class="main-panel">
            <div class="content">
                @php
                    $deposit_set = App\deposit_settings::find(1);
                @endphp
               
                <div class="page-inner mt--5 ">
                  <div id="prnt"></div>
                  <div class="row">
                       
                    <div class="col-sm-12 card">
                        @if (count($errors) > 0)
                   <div class="alert alert-danger">
                 <button type="button" class="close" data-dismiss="alert">×</button>
                 <ul>
                  @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
                  @endforeach
                 </ul>
                </div>
               @endif
               @if ($message = Session::get('success'))
               <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                       <strong>{{ $message }}</strong>
               </div>
               @elseif ($message = Session::get('fail'))
               <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                       <strong>{{ $message }}</strong>
               </div>
               @endif
                      <form id="settings_form" action="{{ route('deposit_update')}}" method="post">
                          @csrf
                          <div class="row">
                               <div class="col-md-6">
                                  <div class="card mt-5 pd-20" >
                                      <h3 align="center"><img align="center" src="{{ asset('assets/img/bitcoin.png')}}" class="img-responsive" style="width: 100px; height: 100px;"></h3>
                                      <h2 class="text-center">Coinpayment Setup </h2>
                                      <hr>
                                      <div class="form-group">
                                          <h5> Coinpayment Merchant ID  </h5>
                                          <input type="text" name="cp_m_id" value="{{$deposit_set->COINPAYMENTS_MERCHANT_ID}}" class="form-control" placeholder=""  >
                                      </div>  
                                      <div class="form-group">
                                          <h5> Coinpayment Public Key </h5>
                                          <input type="text" name="cp_p_key" value="{{$deposit_set->COINPAYMENTS_PUBLIC_KEY}}" class="form-control" placeholder=""  >
                                      </div>
                                      <div class="form-group">
                                          <h5> coinpayment Private Key  </h5>
                                          <input type="text" name="cp_pr_key" value="{{$deposit_set->COINPAYMENTS_PRIVATE_KEY}}" class="form-control" placeholder=""  >
                                      </div>
                                      <div class="form-group">
                                          <h5> Coinpayment IPN Secret  </h5>
                                          <input type="text" name="cp_ipn_secret" value="{{$deposit_set->COINPAYMENTS_IPN_SECRET}}" class="form-control" placeholder=""  >
                                      </div>
                                      <div class="form-group">
                                          <h5> coinpayment IPN URL </h5>
                                          <input type="text" name="cp_ipn_url" value="{{$deposit_set->COINPAYMENTS_IPN_URL}}" class="form-control" placeholder=""  >
                                      </div>
                                      
                                      <div class="" align="right"> 
                                          <b>On/Off Bitcoin </b><br>             
                                          <label class="switch">
                                            <input id="switch_BTC" type="checkbox" name="switch_BTC"  value="{{$deposit_set->SWITCH_BTC}}" @if($deposit_set->SWITCH_BTC == 1){{'checked'}}@endif>

                                          </label>
                                      </div> 

                                      <div class="" align="right"> 
                                          <b>On/Off Ethereum  </b><br>             
                                          <label class="switch">
                                            <input id="switch_ETH" type="checkbox" name="switch_ETH"  value="{{$deposit_set->SWITCH_ETH}}" @if($deposit_set->SWITCH_ETH == 1){{'checked'}}@endif>
                                            
                                          </label>
                                      </div> 

                                  </div>                                                   
                              </div> 
                              
                              
                              
                              <div class="col-md-6">
                                	<div class="card mt-5 pd-20" >
                                	    <h3 align="center">
                                	      <img align="center" src="{{ asset('assets/img/bcimg.png')}}" class="img-responsive" style="width: 100px; height: 100px;">
                                	    </h3>
                                	    <h2 class="text-center">Blockchain payment</h2>
                                	    <hr>
                                	    <div class="form-group">
                                	        <h5> Blockchain secrete (Choose your secrete)  </h5>
                                	        <input type="text" name="bc_secrete" value="{{ $deposit_set->BCM_SECRETE}}" class="form-control"   >
                                	    </div>
                                	    <div class="form-group">
                                	        <h5> Blockchain address xpub key  </h5>
                                	        <input type="text" name="bc_xpub" value="{{ $deposit_set->BC_MY_XPUB}}" class="form-control"   >
                                	    </div>
                                	    <div class="form-group">
                                	        <h5> Blockchain api key </h5>
                                	        <input type="text" name="bc_api_key" value="{{ $deposit_set->BC_MY_API_KEY }}" class="form-control" >
                                	    </div>
                                	    
                                	    <div class="" align="right"> 
                                	        <b>On/Off</b><br>             
                                	        <label class="switch">
                                	          <input id="bc_switch" type="checkbox" name="bc_switch"  value="{{ $deposit_set->BC_SWITCH }}" @if($deposit_set->BC_SWITCH == 1){{'checked'}}@endif>
                                	        </label>
                                	    </div>                                                     
                                	</div>                                                   
                                 </div> 
                              
                              

                              <div class="col-md-6">
                                <div class="card mt-5 pd-20" >
                                    <h3 align="center">
                                      <img align="center" src="{{ asset('assets/img/coinbase.png')}}" class="img-responsive" style="width: 45%;">
                                    </h3>
                                    <h2 class="text-center">Coinbase Setup</h2>
                                    <hr>
                                    <div class="form-group">
                                        <h5> Coinbase Key </h5>
                                        <input type="text" name="coinbase_key" value="{{ $deposit_set->COINBASE_API_KEY}}" class="form-control"   >
                                    </div>
                                    <div class="form-group">
                                        <h5> Coinbase Webhook Secret </h5>
                                        <input type="text" name="coinbase_seceret" value="{{ $deposit_set->COINBASE_WEBHOOK_SECRETE}}" class="form-control" >
                                    </div>
                                    <div class="" align="right"> 
                                        <b>On/Off</b><br>             
                                        <label class="switch">
                                          <input id="coinbase_switch" type="checkbox" name="coinbase_switch"  value="{{ $deposit_set->COINBASE_SWITCH }}" @if($deposit_set->COINBASE_SWITCH == 1){{'checked'}}@endif>
                                          
                                        </label>
                                    </div>                                                     
                                </div>                                                   
                              </div> 
                              
                          
                          
                              <div class="col-md-6">
                                <div class="card mt-5 pd-20" >
                                    
                                    <h2 class="text-center">{{env('APP_NAME')}} <br> Direct Payment Setup</h2>
                                    <hr>
                                    <div class="form-group">
                                        <h5> btc wallet id </h5>
                                        <input type="text" name="btc_id" value="{{ $deposit_set->BTC_WALLET}}" class="form-control" placeholder="BITCOIN WALLET ID"  >
                                    </div>
                                    <div class="" align="right"> 
                                        <b>On/Off</b><br>             
                                        <label class="switch">
                                          <input id="btc_switch" type="checkbox" name="btc_switch"  value="{{ $deposit_set->BTC_SWITCH}}" @if($deposit_set->BTC_SWITCH == 1){{'checked'}}@endif>
                                          
                                        </label>
                                    </div>                                                     
                                </div>                                                   
                              </div> 
                              
                        <div class="row mt-50 mb-5 "> 
                         <div class="col-md-12">
                            <button  class="btn btn-sm btn-info float-right mt-5 pd-20" type= "submit" > 
                              Save Changes 
                            </button>
                          </div>                                     
                        </div>
                          
                      </form>
                    </div>
                 </div>
                </div>
            </div>
    </div>

@endsection