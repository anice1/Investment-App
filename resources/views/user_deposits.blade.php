@extends('layouts.layout')
@section('title') Deposit History @endsection
@section('content')
      <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Deposits 
                    <div class="page-title-subheading">Hello {{Auth()->user()->name}}, Welcome to Deposits History.</div>
                </div>
            </div>
        </div>
    </div>  
    <div class="main-panel">
        <div class="content">
            <div class="page-inner mt--5">
                <div id="prnt"></div>  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" style="background-color:skyblue;">
                                    <div class="card-head-row card-tools-still-right">
                                        <h4 class="card-title text-white" > <i class="fas fa-donate"></i> Deposit History  </h4>
                                    </div>
                                </div>
                                <div class="card-body pb-0 table-responsive">
                                    <table class="display table table-stripped table-hover" >
                                        <thead>
                                            <tr>
                                                <th> Actions</th>
                                                <th> Username </th>
                                                <th> Amount  </th>                        
                                                <th> Acct Name/TXN ID  </th>
                                                <th> Acct No/Wallet  </th>
                                                <th>Payment Receipt</th>
                                                <th> Method  </th>
                                                <th> Date  </th>                        
                                                <th> Status  </th>                                                                                
                                            </tr>
                                        </thead>                
                                        <tbody>
                                        @if(count($deps) > 0 )
                                        @foreach($deps as $dep)
                                        <tr>
                                            <td>
                                                <div class="btn-group">                                    
                                                    @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                                                        <a class="btn btn-warning" title="Reject Deposit" href="{{ url('/admin/reject/user/payment/' .$dep->id)}}" > 
                                                            <span class=""><i class="fa fa-ban text-dark" ></i></span>
                                                        </a> 
                                                        <a class="btn btn-success"  title="Approve Deposit" href="{{ url('/admin/approve/user/payment/'.$dep->id)}}" > 
                                                            <span><i class="fa fa-check text-light"></i></span>
                                                        </a>
                                                        <a class="btn btn-danger" title="Delete Deposit" href="{{ url('/admin/delete/user/payment/'.$dep->id)}}" > 
                                                            <span class=""><i class="fa fa-times text-light"></i></span>
                                                        </a>
                                                    </div>
                                                    @endif
                                                </td> 
                                                <td>{{$dep->usn}}</td>
                                                <td>{{$dep->currency}} {{$dep->amount}}</td>                                
                                                <td>{{$dep->account_name}}</td>
                                                <td>{{$dep->account_no}}</td>
                                                <td><a href="{{asset('assets/img/receipts/'.$dep->receipt)}}" target="_blank"><img src="{{asset('assets/img/receipts/'.$dep->receipt)}}" width= "100px" height="50px"></a></td>
                                                <td>{{$dep->bank}}</td>
                                                <td>{{substr($dep->created_at, 0, 10)}}</td>                               
                                                <td>
                                                    @if($dep->status == 0)
                                                        <span class="p-2 bg-warning text-dark">Pending</span>
                                                    @elseif($dep->status == 1)
                                                        <span class="p-2 bg-success text-white">Approved</span>
                                                    @elseif($dep->status == 2)
                                                        <span class="p-2 bg-danger text-white">Rejected</span>
                                                    @endif
                                                </td>   
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan='9'>No active deposits</td>
                                            </tr>  
                                            @endif
                                        </tbody>
                                    </table>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
        