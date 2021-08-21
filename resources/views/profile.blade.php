@extends('layouts.layout')
@section('title') {{Auth()->user()->name}} @endsection
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="lnr-map text-info"></i>
            </div>
            <div>Profile
                <div class="page-title-subheading">Hello! this is a summary of your profile</div>
            </div>
        </div>
        
    </div>
</div>   
@if (session('status'))
    <div class="alert alert-success fade">
        {{ session('status') }}
    </div>
@endif
<div class="tab-content">
    <div class="tab-pane tabs-animation fade active show" id="tab-content-0" role="tabpanel">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <div id="smartwizard" class="sw-main sw-theme-default">
                            <ul class="forms-wizard nav nav-tabs step-anchor">
                                <li class="nav-item active">
                                    <a href="#step-1" class="nav-link">
                                        <em>1</em><span>Account Information</span>
                                    </a>
                                </li>
                            </ul>
                            <form class='form-group' action='/profile/edit/{{auth()->user()->id}}' method='POST' id="info">
                                @csrf
                                <div class="form-wizard-content sw-container tab-content" style="min-height: 310.417px;">
                                    <div id="step-1" class="tab-pane step-content" style="display: block;">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label for="username">Username</label>
                                                    <input name="name" id="username" placeholder="username" type="text" class="form-control" value="{{Auth()->user()->name}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label for="exampleEmail55">Email</label>
                                                    <input name="email" id="exampleEmail55" placeholder="with a placeholder" type="email" class="form-control" value="{{Auth()->user()->email}}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="position-relative form-group">
                                                    <label for="exampleAddress">Address</label>
                                                    <input name="address" id="exampleAddress" placeholder="1234 Main St" type="text" class="form-control" value="{{Auth()->user()->address}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="position-relative form-group">
                                                    <label for="exampleCity">City</label>
                                                    <input name="city" id="exampleCity" type="text" class="form-control" value="{{Auth()->user()->city}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="position-relative form-group">
                                                    <label for="exampleState">State</label>
                                                    <input name="state" id="exampleState" type="text" class="form-control" value="{{Auth()->user()->state}}">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="position-relative form-group">
                                                    <label for="exampleZip">Zip</label>
                                                    <input name="zip" id="exampleZip" type="text" class="form-control" value="{{Auth()->user()->zip}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="accordion" class="accordion-wrapper mb-3">
                                            <div class="card">
                                                <div id="headingOne" class="card-header">
                                                    <button type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block">
                                                        <span class="form-heading">Account Information<p>Enter your  user informations below</p></span>
                                                    </button>
                                                </div>
                                                <div data-parent="#accordion" id="collapseOne" aria-labelledby="headingOne" class="collapse show">
                                                    <div class="card-body">
                                                        <div class="form-row">
                                                            <div class="col-md-6">
                                                                <div class="position-relative form-group">
                                                                    <label for="btc_address">Bitcoin Payment Address</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="paste your bitcoin wallet address here" id="clipboard-source-2" value="{{Auth()->user()->wallet_address}}" name="btc_address">
                                                                        <div class="input-group-append">
                                                                            <button type="button" data-clipboard-target="#clipboard-source-2" class="btn btn-primary clipboard-trigger">
                                                                                <i class="fa fa-copy"></i>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="position-relative form-group">
                                                                    <label for="exampleAddress">Currency</label>
                                                                    <input type="text" name="coin" id="" class="form-control" value="BTC" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="divider"></div>
                        <div class="clearfix">
                            <button type="submit" class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary" onclick="event.preventDefault();
                                                                            document.getElementById('info').submit();">Next</button>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

@endsection