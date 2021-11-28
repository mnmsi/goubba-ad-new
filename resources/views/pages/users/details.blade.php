@extends('layouts.base')
@section('title', 'Advertiser Details')
<style>
    .details-title {
        background: #dff0d8;
        width: 30%;
        font-weight: 500;
    }

    .details-data {
        width: 70%;
    }
</style>
@section('breadcrumb')
    <h1 class="page-title">Advertiser Details</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Advertiser Manager</a></li>
        <li class="breadcrumb-item active" aria-current="page">Advertiser Details</li>
    </ol>
@endsection

@section('content')
<section>
    <div>
        <div class="card">
            <div class="expanel expanel-default mb-0">
                <div class="expanel-heading text-center font-weight-bold text-white" style="background: #09ad95!important;">Advertiser Details</div>
                <div class="expanel-body p-0">
                    <div class="table-responsive table-striped">
                        <table class="table card-table table-vcenter text-nowrap align-items-start mb-0">
                            <tbody>
                                <tr>
                                    <td class="details-title">Name:</td>
                                    <td class="details-data">{{ $user_info['business_name'] }}</td>
                                </tr>
                                <tr>
                                    <td class="details-title">Email:</td>
                                    <td class="details-data">{{ $user_info['email'] }}</td>
                                </tr>
                                <tr>
                                    <td class="details-title">Role:</td>
                                    <td class="details-data">{{ ucfirst($user_info['role_name']) }}</td>
                                </tr>
                                <tr>
                                    <td class="details-title">Phone:</td>
                                    <td class="details-data">{{ $user_info['phone'] }}</td>
                                </tr>

                                <tr>
                                    <td class="details-title">Approve Status:</td>
                                    <td class="details-data">{{ $user_info['is_approved'] ? 'Approved' : 'Not Approved' }}</td>
                                </tr>

                                <tr>
                                    <td class="details-title">Active Status:</td>
                                    <td class="details-data">{{ $user_info['is_active'] ? 'Active' : 'Not Active' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="expanel expanel-default mb-0">
                <div class="expanel-heading text-center font-weight-bold text-white" style="background: #09ad95!important;">Advertiser Campaign Details</div>
                    <div class="expanel-body p-0">
                        <div class="table-responsive table-striped">
                            <table class="table align-items-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Campain Name</th>
                                        <th>Campain Type Name</th>
                                        <th>Campain Status</th>
                                        <th>Total Advertisement</th>
                                        <th>Active Advertisement</th>
                                        <th>Pending Advertisement</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($user_info['campains']) > 0)
                                        @foreach ($user_info['campains'] as $row)
                                            <tr>
                                                <td>{{ $row['campaign_name'] }}</td>
                                                <td>{{ $row['campaign_type_name'] }}</td>
                                                <td>{{ $row['campaign_active'] }}</td>
                                                <td>{{ $row['total_ad'] }}</td>
                                                <td>{{ $row['total_publish_ad'] }}</td>
                                                <td>{{ $row['total_pending_ad'] }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="text-center">
                                            <td colspan="6" style="font-weight: bold">No Campain</td>
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
</section>
@endsection
