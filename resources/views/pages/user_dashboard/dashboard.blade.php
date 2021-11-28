@extends('layouts.base')
@section('title', 'Dashboard')

@section('breadcrumb')
<h1 class="page-title">Dashboard</h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
</ol>
@endsection

{{-- @section('campaigns')
<div class="btn-group mt-2 mb-2">
    <button type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown">
        <span id="navCampButtonText">All Campaigns</span> <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
        <li>
            <a href="javascript:void(0)"
            onclick="loadCampData(this, '{{ route('view.dashboard', ['campId' => 'all_camps']) }}')">All Campaigns</a>
        </li>
        @foreach ($campaigns as $item)
            <li>
                <a href="javascript:void(0)"
                onclick="loadCampData(this, '{{ route('view.dashboard', ['campId' => $item->id]) }}')">{{ $item->campaign_name }}</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection --}}

@section('campaigns')
<div class="form-group mt-2">
    <select class="form-control select2-show-search" onchange="loadCampData(this.value, '{{ route('view.dashboard') }}')">
        @foreach ($campaigns as $item)
            <option value="{{ $item->id }}">{{ $item->campaign_name }}</option>
        @endforeach
    </select>
</div>
@endsection

@section('content')
<div>
    <div id="loaderId" class="spinner2" style="display: none;">
        <div class="cube1"></div>
        <div class="cube2"></div>
    </div>
    <div id="loadViewDiv">
        <div id="loadDashboardData">
            <!-- ROW-1 OPEN -->
            <div class="row" id="totalStatsDiv">
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 totalViewStats">
                    <div class="card bg-primary img-card box-primary-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font">{{ $totalViews }}</h2>
                                    <p class="text-white mb-0">Total Views</p>
                                </div>
                                <div class="ml-auto"> <i class="fa fa-send-o text-white fs-30 mr-2 mt-2"></i> </div>
                            </div>
                        </div>
                    </div>
                </div><!-- COL END -->
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 totalViewStats">
                    <div class="card bg-secondary img-card box-secondary-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font">{{ $totalClicks }}</h2>
                                    <p class="text-white mb-0">Total Clicks</p>
                                </div>
                                <div class="ml-auto"> <i class="fa fa-bar-chart text-white fs-30 mr-2 mt-2"></i> </div>
                            </div>
                        </div>
                    </div>
                </div><!-- COL END -->
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 totalClicksStats">
                    <div class="card  bg-success img-card box-success-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font">{{ $totalCost }}</h2>
                                    <p class="text-white mb-0">Total Budget</p>
                                </div>
                                <div class="ml-auto"> <i class="fa fa-dollar text-white fs-30 mr-2 mt-2"></i> </div>
                            </div>
                        </div>
                    </div>
                </div><!-- COL END -->
                <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 totalClicksStats">
                    <div class="card bg-info img-card box-info-shadow">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="text-white">
                                    <h2 class="mb-0 number-font">{{ $remainingBalance }}</h2>
                                    <p class="text-white mb-0">Remaining Balance</p>
                                </div>
                                <div class="ml-auto"> <i class="fa fa-cart-plus text-white fs-30 mr-2 mt-2"></i> </div>
                            </div>
                        </div>
                    </div>
                </div><!-- COL END -->
            </div>
            <!-- ROW-1 CLOSED -->
        </div>
    </div>
</div>
@endsection
