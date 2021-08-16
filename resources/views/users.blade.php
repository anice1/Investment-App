@extends('layouts.layout')
@section('title')All Users @endsection
@section('content')
<div class="app-page-title">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="page-title-icon">
                <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
            </div>
            <div>List of Users
                <div class="page-title-subheading">These are the list of all users registered in the network</div>
            </div>
        </div>
    </div>
</div>
<div class="mb-3 card">
    <div class="card-header-tab card-header">
        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
            <i class="header-icon lnr-charts icon-gradient bg-happy-green"> </i>
            Registered Users Summary
        </div>
    </div>
    <div class="no-gutters row">
        <div class="col-sm-6 col-md-12 col-xl-12 text-center">
            <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                <div class="icon-wrapper rounded-circle">
                    <div class="icon-wrapper-bg opacity-10 bg-warning"></div>
                    <i class="lnr-laptop-phone text-dark opacity-8"></i>
                </div>
                <div class="widget-chart-content">
                    <div class="widget-subheading">Total Users</div>
                    <div class="widget-numbers">{{$users->count()}}</div>
                </div>
            </div>
            <div class="divider m-0 d-md-none d-sm-block"></div>
        </div>
        <!-- <div class="col-sm-6 col-md-4 col-xl-4">
            <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                <div class="icon-wrapper rounded-circle">
                    <div class="icon-wrapper-bg opacity-9 bg-danger"></div>
                    <i class="lnr-graduation-hat text-white"></i>
                </div>
                <div class="widget-chart-content">
                    <div class="widget-subheading">Invested Dividents</div>
                    <div class="widget-numbers"><span>9M</span></div>
                    <div class="widget-description opacity-8 text-focus">
                        Grow Rate:
                        <span class="text-info pl-1">
                            <i class="fa fa-angle-down"></i>
                            <span class="pl-1">14.1%</span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="divider m-0 d-md-none d-sm-block"></div>
        </div>
        <div class="col-sm-12 col-md-4 col-xl-4">
            <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                <div class="icon-wrapper rounded-circle">
                    <div class="icon-wrapper-bg opacity-9 bg-success"></div>
                    <i class="lnr-apartment text-white"></i>
                </div>
                <div class="widget-chart-content">
                    <div class="widget-subheading">Capital Gains</div>
                    <div class="widget-numbers text-success"><span>$563</span></div>
                    <div class="widget-description text-focus">
                        Increased by
                        <span class="text-warning pl-1">
                            <i class="fa fa-angle-up"></i>
                            <span class="pl-1">7.35%</span>
                        </span>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length" id="example_length">
                                            <label>Show 
                                                <select name="example_length" aria-controls="example" class="custom-select custom-select-sm form-control form-control-sm">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select> entries
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div id="example_filterd" class="dataTables_filter">
                                            <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 ">
                                        <div class="table-responsive">
                                            <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered dataTable dtr-inline" role="grid" aria-describedby="example_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 142.3px;" aria-label="Name: activate to sort column descending" aria-sort="ascending">Name</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 239.3px;" aria-label="Position: activate to sort column ascending">Email</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 106.3px;" aria-label="Office: activate to sort column ascending">City/State</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 61.3px;" aria-label="Age: activate to sort column ascending">Coin</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 117.3px;" aria-label="Start date: activate to sort column ascending">Wallet Address</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 117.3px;" aria-label="Start date: activate to sort column ascending">Payment Status</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 78.3px;" aria-label="Salary: activate to sort column ascending">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody> 
                                                    @foreach($users as $user) 
                                                        <tr role="row" class="odd">
                                                            <td class="dtr-control sorting_1" tabindex="0">{{$user->name}}</td>
                                                            <td>{{$user->email}}</td>
                                                            <td>{{$user->city}} / {{$user->state}}</td>
                                                            <td>BTC</td>
                                                            <td>Wallet Address</td>
                                                            <td>Status</td>
                                                            <td>
                                                                <div role="group" class="btn-group-lg btn-group btn-group-toggle">
                                                                    <button type="button" class="btn btn-success">Pay Now</button>
                                                                    <button type="button" class="btn btn-danger">Block</button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th rowspan="1" colspan="1">Name</th>
                                                        <th rowspan="1" colspan="1">Email</th>
                                                        <th rowspan="1" colspan="1">City - State</th>
                                                        <th rowspan="1" colspan="1">Coin </th>
                                                        <th rowspan="1" colspan="1">Wallet-Address</th>
                                                        <td>Payment Status</td>
                                                        <th rowspan="1" colspan="1">Action</th></tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="example_info" role="status" aria-live="polite">Showing 1 to 10 of 10 entries</div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
                                            <ul class="pagination">
                                                <li class="paginate_button page-item previous disabled" id="example_previous">
                                                    <a href="#" aria-controls="example" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                                </li>
                                                <li class="paginate_button page-item active">
                                                    <a href="#" aria-controls="example" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                                                </li>
                                                <li class="paginate_button page-item next disabled" id="example_next">
                                                    <a href="#" aria-controls="example" data-dt-idx="2" tabindex="0" class="page-link">Next</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
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