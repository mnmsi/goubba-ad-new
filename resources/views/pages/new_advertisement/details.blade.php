@extends('layouts.base')
@section('title', 'Campaign Details')
<style>
    .details-title {
        background: #dff0d8;
        width: 20%;
        font-weight: 500;
    }

    .details-data {
        width: 30%;
    }
</style>
@section('breadcrumb')
    <h1 class="page-title">Campaign Details</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Campaign Management</a></li>
        <li class="breadcrumb-item active" aria-current="page">Campaign Details</li>
    </ol>
@endsection

@section('content')
<section>
    <div>
        <div class="card">
            <div class="expanel expanel-default mb-0">
                <div class="expanel-heading text-center font-weight-bold text-white" style="background: #09ad95!important;">Campaign Details</div>
                    <div class="expanel-body p-0">
                        <div class="table-responsive table-striped">
                            <table class="table card-table table-vcenter text-nowrap align-items-start mb-0">
                                <tbody>
                                    <tr>
                                        <td class="details-title">Brand Title:</td>
                                        <td class="details-data">{{ $brand_title }}</td>

                                        <td class="details-title">Brand Logo:</td>
                                        <td class="details-data">
                                            <img src="{{ asset($brand_logo) }}" alt="" width="50px" height="auto">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="details-title">Campaign Title:</td>
                                        <td class="details-data">{{ $campaign_name}}</td>

                                        <td class="details-title">Campaign Type:</td>
                                        <td class="details-data">{{ $campaign_type_name}}</td>
                                    </tr>
                                    <tr>
                                        <td class="details-title">Campaign Start Date:</td>
                                        <td class="details-data">{{ $start_date }}</td>

                                        <td class="details-title">Campaign End Date:</td>
                                        <td class="details-data">{{ $end_date }}</td>
                                    </tr>
                                    <tr>
                                        <td class="details-title">Campaign Start Time:</td>
                                        <td class="details-data">{{ $start_time }}</td>

                                        <td class="details-title">Campaign End Time:</td>
                                        <td class="details-data">{{ $end_time }}</td>
                                    </tr>
                                    <tr>
                                        <td class="details-title">Campaign Budget:</td>
                                        <td class="details-data">{{ $budget }}</td>

                                        <td class="details-title">Campaign Reward Amount:</td>
                                        <td class="details-data">{{ $rewards_amount }}</td>
                                    </tr>
                                    <tr>
                                        <td class="details-title">Advertisement Age Range</td>
                                        <td>{{ $age_range }}</td>

                                        <td class="details-title">Campaign Active Status:</td>
                                        <td>{{ $is_active }}</td>
                                    </tr>
                                    <tr>
                                        <td class="details-title">Advertisement Title</td>
                                        <td class="details-data">{{ $title }}</td>

                                        <td class="details-title">Advertisement Country</td>
                                        <td class="details-data">
                                            @foreach($countries as $country)
                                                {{ $country->id == $country_id ? $country->name : '' }}
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="details-title">Advertisement Description</td>
                                        <td colspan="3">{{ $desc }}</td>
                                    </tr>
                                    <tr>
                                        <td class="details-title">State:</td>
                                        <td colspan="3">
                                            @if (count($states) > 0)
                                                @foreach($states as $state)
                                                    {{ in_array($state->id,json_decode($state_id)) ? $state->name.',' : ''}}
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="details-title">City:</td>
                                        <td colspan="3">
                                            @if (count($cities) > 0)
                                                @foreach($cities as $city)
                                                    {{ in_array($city->id, json_decode($city_id)) ? $city->name."," : ''}}
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="expanel expanel-default mb-0">
                <div class="expanel-heading text-center font-weight-bold text-white" style="background: #09ad95!important;">Advertisement Details</div>
                    <div class="expanel-body p-0">
                        <div class="table-responsive">
                            <table class="table card-table table-vcenter text-nowrap align-items-start mb-0">
                                <tbody>
                                    @forelse ($advertisement as $key => $adv)

                                        <tr>
                                            <td class="details-title">Advertisement Category</td>
                                            <td colspan="3" style="background: #dff0d8">{{ $key }}</td>
                                        </tr>
                                        <tr>
                                            <td class="details-title">Media:</td>
                                            <td colspan="3">
                                                @foreach ($adv as $media)
                                                    <span>
                                                        <img src="{{ asset($media['media_link']) }}" alt="" width="100px" height="auto">
                                                    </span>
                                                @endforeach
                                            </td>
                                        </tr>

                                    @empty
                                        <p>No Details Found</p>
                                    @endforelse
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
