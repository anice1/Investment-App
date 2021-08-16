@extends('layouts.layout')
@section('title')Referals @endsection
@section('content')
<div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Referal History
                    <div class="page-title-subheading">Invite your friends to earn from this platform as well.</div>
                </div>
            </div>
        </div>
    </div>  
        
    <div class="card no-shadow bg-transparent no-border rm-borders mb-0">
        <div class="card">
            <div class="no-gutters row">
                <div class="col-md-12 col-lg-4">
                    <ul class="list-group list-group-flush">
                        <li class="bg-transparent list-group-item">
                            <div class="widget-content p-0">
                                <div class="widget-content-outer">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total Referals</div>
                                            <div class="widget-subheading">Total number of people reffered</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-success">0</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-12 col-lg-4">
                    <ul class="list-group list-group-flush">
                        <li class="bg-transparent list-group-item">
                            <div class="widget-content p-0">
                                <div class="widget-content-outer">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Pending Referals</div>
                                            <div class="widget-subheading">Referal pending approval</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-danger">0</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-12 col-lg-4">
                    <ul class="list-group list-group-flush">
                        <li class="bg-transparent list-group-item">
                            <div class="widget-content p-0">
                                <div class="widget-content-outer">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Referal Earnings</div>
                                            <div class="widget-subheading">Amount earned from referals</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-success">$0</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div> 
            
            <div class="no-gutters row">
            <div class="col-md-12">
            <hr>
                <div class="card-body">
                    <h5 class="card-title">Referal Link</h5>
                    <div class="input-group">
                        <input type="text" class="form-control" id="clipboard-source-2" value="{{$ref_code}}">
                        <div class="input-group-append">
                            <button type="button" data-clipboard-target="#clipboard-source-2" class="btn btn-primary clipboard-trigger">
                                <i class="fa fa-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
        
@endsection