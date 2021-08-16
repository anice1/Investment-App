@extends('layouts.layout')
@section('title') Deposit Funds @endsection
@section('content')
<div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Deposit
                    <div class="page-title-subheading">Hello {{Auth()->user()->name}}, Deposit Funds</div>
                </div>
            </div>
        </div>
    </div>      
                @php
                
               $deposit_set = App\deposit_settings::find(1);
                
                @endphp
      <div class="main-panel">
            <div class="content">
                <div class="page-inner mt--5">
                   
                    <div id="prnt"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">{{ __('messages.dpst_int_yr_walt') }}</div>                                        
                                    </div>
                                </div>
                                <div class="card-body"> 
                                        
                                                <div id="pay_cont" class="row">
                                                   
                                                    @if($deposit_set->BTC_SWITCH == 1)
                                                    <div class="col-lg-6 mt-5">                                                                    
                                                        <div class="payment_method" align="center">
                                                            <p>
                                                                <i class="fab fa-bitcoin fa-4x text-info"></i> <br>
                                                            </p>
                                                            <p>
                                                            Pay with BTC (Direct)
                                                            </p> 
                                                           
                                                            <div align="">
                                                                <a href="{{ route('drt.index') }}" class="btn btn_blue" >
                                                                Pay with BTC
                                                                </a>
                                                            </div>                                      
                                                        </div>                                                       
                                                    </div>
                                                    @endif

                                                    

                                                     @if($deposit_set->SWITCH_BTC == 1)
                                                    <div class="col-lg-6 mt-5">                                                                   
                                                        <div class="payment_method" align="center">
                                                            <p>
                                                                <i class="fab fa-bitcoin fa-4x text-info"></i> <br>
                                                            </p>
                                                            <p>
                                                                {{ __('Pay using Bitcoin (Coinpayment system)') }}
                                                            </p> 
                                                           
                                                            <div align="">
                                                                <a href="{{ route('btc.index', ['coin' => 'BTC']) }}" class="btn btn_blue" >
                                                                    {{ __('Pay with BTC') }}
                                                                </a>
                                                            </div>                                      
                                                        </div>                                                       
                                                    </div>
                                                    @endif 

                                                    @if($deposit_set->COINBASE_SWITCH == 1)
                                                    <div class="col-lg-6 mt-5">                                                                    
                                                        <div class="payment_method" align="center">
                                                            <p>
                                                                <i class="fab fa-bitcoin fa-4x text-info"></i> <br>
                                                            </p>
                                                            <p>
                                                                {{ __('messages.py_usng_cnbs_cps') }}
                                                            </p> 
                                                           
                                                            <div align="">
                                                                <a href="{{ route('coinbase.index') }}" class="btn btn_blue" >
                                                                    {{ __('messages.pay_w_cb') }}
                                                                </a>
                                                            </div>                                      
                                                        </div>                                                       
                                                    </div>
                                                    @endif

                                                    @if($deposit_set->BCM_SWITCH == 1)
                                                    <div class="col-lg-6 mt-5">                                                                    
                                                        <div class="payment_method" align="center">
                                                            <p>
                                                                <i class="fab fa-bitcoin fa-4x text-info"></i> <br>
                                                            </p>
                                                            <p>
                                                                {{ __('messages.pay_w_btc_bc') }}
                                                            </p> 
                                                           
                                                            <div align="">
                                                                <a href="{{ route('bcm.index') }}" class="btn btn_blue" >
                                                                    {{ __('messages.pay_w_bc') }}
                                                                </a>
                                                                
                                                            </div>                                      
                                                        </div>                                                       
                                                    </div>
                                                    @endif

                                                    @if($deposit_set->SWITCH_ETH == 1)
                                                    <div class="col-lg-6 mt-5">                                                                   
                                                        <div class="payment_method" align="center">
                                                            <p>
                                                                <i class="fab fa-ethereum fa-4x text-info"></i> <br>
                                                            </p>
                                                            <p>
                                                                {{ __('messages.pay_u_eth') }}
                                                            </p> 
                                                           
                                                            <div align="">
                                                                <a href="{{ route('btc.index', ['coin' => 'ETH']) }}" class="btn btn_blue" >
                                                                    {{ __('messages.pay_w_eth') }}
                                                                </a>
                                                            </div>                                      
                                                        </div>                                                       
                                                    </div>
                                                    @endif

                                                    

                                                </div>                                                   
                                           
                                </div>
                            </div>
                        </div>
                        
                    </div><br><br>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">{{ __('messages.dpst_hstr') }}</div>
                                </div>
                                <div class="card-body pb-0">
                                    <?php
                                        $deps = App\Models\Deposit::where('user_id', Auth()->user()->id)->orderby('id', 'desc')->paginate(10);
                                    ?>                                                   
                                                
                                    <div class="table-responsive">
                                        <table class="display table table-striped table-hover" >
                                        <thead>
                                            <tr>  
                                                <th>{{ __('messages.amnt') }}</th>        
                                                <th>{{ __('messages.mthd') }}</th>
                                                <th>{{ __('messages.act') }}</th>
                                                <th>Receipt Upload</th>
                                                <th>{{ __('messages.id') }}</th>
                                                <th>{{ __('messages.date') }}</th>
                                                <th>{{ __('messages.sts') }}</th>
                                                                                                                        
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @if(count($deps) > 0 )
                                                @foreach($deps as $dep)
                                                    <tr> 
                                                        <td>
                                                            @if($dep->bank != 'BTC')
                                                                {{$settings->currency}} 
                                                            @endif
                                                            {{$dep->amount}}
                                                        </td>     
                                                        <td>{{$dep->bank}}</td>
                                                        <td>
                                                           {{$dep->account_no}}
                                                        </td>
                                                        <td>
                                                        <form method = "post" action="{{route('drt.rec_Upload')}}" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="recid" value ="{{$dep->id}}">
                                                        <input type="file" name="recPic"> 
                                                        <input type="submit" value="upload" class="btn btn-sm btn-primary mt-1 pd-2">
                                                        </form>
                                                        </td>
                                                        <td>
                                                           {{$dep->account_name}}
                                                        </td>
                                                        <td>{{$dep->created_at}}</td>
                                                        <td>
                                                            @if($dep->status == 0)
                                                                Pending
                                                            @elseif($dep->status == 1)
                                                                Approved
                                                            @elseif($dep->status == 2)
                                                                Rejected
                                                            @endif
                                                        </td> 
                                                                                                                          
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>                                                            
                                                    <td colspan="6">{{ __('messages.no_data') }}</td>                                        
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                            
                                    <br><br>  
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
            
@endsection