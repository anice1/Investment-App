@extends('layouts.layout')
@section('title') Analytics Dashboard @endsection
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-graph2 icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Analytics Dashboard
                    <div class="page-title-subheading">Hello {{Auth()->user()->name}}, Welcome to your dashboard.</div>
                </div>
            </div>
        </div>
    </div>        

    <div class="tabs-animation">
        <div class="mb-3 card">
            <div class="card-header-tab card-header">
                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                    <i class="header-icon lnr-charts icon-gradient bg-happy-green"> </i>
                    Portfolio Performance
                </div>
            </div>
            <div class="no-gutters row">
                <div class="col-sm-6 @if(auth()->user()->role > 0) col-md-6 col-xl-6 @else col-md-4 col-xl-4 @endif">
                    <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                        <div class="icon-wrapper rounded-circle">
                            <div class="icon-wrapper-bg opacity-10 bg-warning"></div>
                            <i class="lnr-briefcase text-dark opacity-8"></i>
                        </div>
                        <div class="widget-chart-content">
                            <div class="widget-subheading">Cash Deposits (BTC)</div>
                            <div class="widget-numbers">{{$total_deposits}}</div>
                        </div>
                    </div>
                    <div class="divider m-0 d-md-none d-sm-block"></div>
                </div>
                @if(! auth()->user()->role > 0)
                <div class="col-sm-6 col-md-4 col-xl-4">
                    <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                        <div class="icon-wrapper rounded-circle">
                            <div class="icon-wrapper-bg opacity-9 bg-danger"></div>
                            <i class="lnr-link text-white"></i>
                        </div>
                        <div class="widget-chart-content">
                            <div class="widget-subheading">Referal Earning (BTC)</div>
                            <div class="widget-numbers"><span>0</span></div>
                        </div>
                    </div>
                    <div class="divider m-0 d-md-none d-sm-block"></div>
                </div>
                @endif
                <div class="col-sm-12 @if(auth()->user()->role > 0) col-md-6 col-xl-6 @else col-md-4 col-xl-4 @endif">
                    <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                        <div class="icon-wrapper rounded-circle">
                            <div class="icon-wrapper-bg opacity-9 bg-success"></div>
                            <i class="lnr-apartment text-white"></i>
                        </div>
                        <div class="widget-chart-content">
                            <div class="widget-subheading">@if(auth()->user()->role > 0)Total Eligible Payments (BTC) @else Total Expected ROI (BTC) @endif</div>
                            <div class="widget-numbers text-success"><span>{{$gains}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div>Referal
                    <div class="page-title-subheading">Invite your friends to earn from this platform as well.</div>
                </div>
            </div>
        </div>
    </div>  
        
    <div class="card no-shadow bg-transparent no-border rm-borders mb-5">
        <div class="card">
            
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
        
    </div>
@endsection