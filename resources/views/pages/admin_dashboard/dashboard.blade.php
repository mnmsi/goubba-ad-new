@extends('layouts.base')
@section('title', 'Dashboard')

@section('breadcrumb')
<h1 class="page-title">Dashboard</h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
</ol>
@endsection

@section('campaigns')
<div class="form-group mt-2">
    <select class="form-control select2-show-search" onchange="fnUserDataLoad(this.value, '{{ route('view_user.dashboard.admin') }}')">
        @foreach ($users as $item)
            <option value="{{ $item->id }}">{{ $item->business_name }}</option>
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
                                    <h2 class="mb-0 number-font">{{ $totalUsers }}</h2>
                                    <p class="text-white mb-0">Total Users</p>
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
                                    <h2 class="mb-0 number-font">{{ $totalCampaign }}</h2>
                                    <p class="text-white mb-0">Total Campaigns</p>
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
                                    <h2 class="mb-0 number-font">{{ $totalViews }}</h2>
                                    <p class="text-white mb-0">Total Views</p>
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
                                    <h2 class="mb-0 number-font">{{ $totalClicks }}</h2>
                                    <p class="text-white mb-0">Total Clicks</p>
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

    <div id="adminStatsDiv">
        <!-- ROW-3 OPEN -->
        <div class="row">
            <div class=" col-md-12 col-lg-12 col-xl-7">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center">Income Budget</h4>
                                <div class="mt-3 text-center">
                                    <div class="chart-circle mx-auto chart-dropshadow-success" data-value="{{ $percentageOfRevAndExp / 100 }}" data-thickness="7" data-color="#26c2f7"><div class="chart-circle-value"><div class="font-weight-normal fs-20">{{ $percentageOfRevAndExp }}%</div></div></div>
                                    <p class="mb-0 mt-2">Total Expense</p>
                                </div>
                                <ul class="list-items mt-2">
                                    <li class="p-1">
                                        <span class="list-label"></span>Income
                                        <span class="list-items-percentage float-right font-weight-semibold mr-4">{{ $totalBudget }}</span>
                                    </li>
                                    <li class="p-1">
                                        <span class="list-label"></span>Expense
                                        <span class="list-items-percentage float-right font-weight-semibold mr-4">-{{ $totalExpense }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- COL END -->
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center">Ad View</h4>
                                <div class="mt-3 text-center">
                                    <div class="chart-circle mx-auto chart-dropshadow-info" data-value="{{ $percentageOfClickAndView / 100 }}" data-thickness="7" data-color="#33ce7b"><div class="chart-circle-value"><div class="font-weight-normal fs-20">{{ $percentageOfClickAndView }}%</div></div></div>
                                    <p class="mb-0 mt-2">Total Click</p>
                                </div>
                                <ul class="list-items mt-2">
                                    <li class="p-1">
                                        <span class="list-label"></span>Views
                                        <span class="list-items-percentage float-right font-weight-semibold mr-4">{{ $totalViews }}</span>
                                    </li>
                                    <li class="p-1">
                                        <span class="list-label"></span>Click
                                        <span class="list-items-percentage float-right font-weight-semibold mr-4">{{ $totalClicks }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div><!-- COL END -->
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="mb-1 number-font">0.35</h2>
                                <p >Current Ratio</p>
                                <div class="progress h-2 mb-1">
                                    <div class="progress-bar bg-primary w-50" role="progressbar"></div>
                                </div>
                                <span class="text-muted"><span class="mb-0 text-success fs-13"><i class="fe fe-arrow-up"></i> 12%</span> increase</span>
                            </div>
                        </div>
                    </div><!-- COL END -->
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="mb-1 number-font">1.45</h2>
                                <p>Quick Ratio</p>
                                <div class="progress h-2 mb-1">
                                    <div class="progress-bar bg-secondary w-20" role="progressbar"></div>
                                </div>
                                <span class="text-muted"><span class="mb-0 text-danger fs-13"><i class="fe fe-arrow-down"></i> 26%</span> decrease</span>
                            </div>
                        </div>
                    </div><!-- COL END -->
                </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-5">
                <div class="card  overflow-hidden">
                    <div class="card-header">
                        <h3 class="card-title">Users</h3>
                    </div>
                    <div class="card-body text-center">
                        <div id="morrisBar8" class="h-340 donutShadow"></div>
                        <div class="mt-2 text-center">
                            <span class="dot-label bg-info"></span><span class="mr-3">Active</span>
                            <span class="dot-label bg-secondary"></span><span class="mr-3">Inactive</span>
                            <span class="dot-label bg-success"></span><span class="mr-3">Pending</span>
                        </div>
                    </div>
                </div>
            </div><!-- COL END -->
        </div>
        <!-- ROW-3 CLOSED -->
    </div>

    <!-- ROW-5 -->
    @if (Auth::user()->role_id == 1)
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
            <div class="card">
                <div class="card-header ">
                    <h3 class="card-title ">Ads Click Users</h3>
                </div>
                <div class="">
                    <div class="d-flex p-3">
                        <div class="mr-2">
                            <select class="form-control select2-show-search" onchange="loadUserClickTableData(this.value, '{{ route('dashboard.adClickUserTable') }}')">
                                <option value="all_camps">All Campaigns</option>
                                @foreach ($campaigns as $item)
                                    <option value="{{ $item->id }}">{{ $item->campaign_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="adClickUserTable" style="overflow: auto;height:auto;max-height: 500px;">
                        <div id="adClickUserTableId">
                            <div class="table-responsive border-top">
                                <table class="table card-table table-striped table-vcenter text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Avatar</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>User Points</th>
                                            <th>User Total Points</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clickedUsers as $user)
                                        @if($user->user) 
                                        <tr>
                                            <td>{{ $user->user->id }}</td>
                                            <td>{{ $user->user->name }}</td>
                                            <td><img src="{{ empty($user->user->avatar) ? asset('assets/images/sample_avatar.png') : $user->user->avatar }}" alt="profile-user" class="brround  avatar-sm w-32"></td>
                                            <td>{{ $user->user->email }}</td>
                                            <td>{{ empty($user->user->mobile) ? 'N/A' : $user->user->mobile }}</td>
                                            <td>{{ number_format($user->user->points) }}</td>
                                            <td>{{ number_format($user->user->total_points) }}</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7">
                                                {{ $clickedUsers->links('pagination::bootstrap-4') }}
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- COL END -->
    </div>
    @endif
    <!-- ROW-5 END -->
</div>
@endsection

@section('script')
<script>

    $(document).ready(function() {
        loadUserDataIntoMorrisChart(<?= $userChartData; ?>);
    });

</script>
@endsection
