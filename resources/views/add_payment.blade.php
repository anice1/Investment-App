@extends('layouts.layout')
@section('title')All Users @endsection
@section('content')

 <!----toggel------------------->
             <div class="" id="add_fund_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel"><b>Pay {{$user->name}}</b></h3>
                            <a href="{{ url('users')}}" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </a>
                        </div>
                        <div class="modal-body">
                           
                                <!----------------------->
                                <div class="row">  
                                        <div class="col-md-8">
                                            <div class="panel-body">
                                                <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                                    
                                                    
                                                    <div class="col-md-12 text-center border p-3 bg_grey">
                                                        <div class="h4">
                                                            <i class="fab fa-bitcoin"></i>{{ __('messages.btc_amt') }} <br>
                                                            <b>{{$total_deposits}} BTC</b>
                                                        </div> 
                                                        <hr>                                                     
                                                        {{__('messages.adr')}} <br>{{$user->wallet_address}} 
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4" align="center"><br>
                                            <i class="fab fa-bitcoin fa-4x text-info"></i>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <a href="{{ url('users')}}"  class="btn btn-primary">
                                                    {{ __('messages.bck') }}
                                                </a>                                                
                                            </div>
                                        </div>
                                    </div>

                                <!----------------------------------->

                                
                                
                           
                        </div>
                        <div class="modal-footer">
                                                        
                        </div>
                    </div>
                </div>
            </div>

                                <!--------------end--------------->


@endsection