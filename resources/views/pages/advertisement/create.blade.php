@extends('layouts.base')
@section('title', 'Create Campaign')

@section('style')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link href="{{ asset('assets/old-css/boostrap-datetime.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/old-css/timepicker.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/old-css/daterangepicker.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/old-css/bootstrap-multiselect.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/new.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/loader.scss') }}">

@endsection

@section('breadcrumb')
    <h1 class="page-title">Create Campaign</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Campaign Manager</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create New Campaign</li>
    </ol>
@endsection

@section('content')

<section>
    <div class="loader" id="previewLoader" style="display: none;"></div>
    <form action="{{ route('adv.store') }}" method="post" enctype="multipart/form-data" id="advForm">
        @csrf
        <div class="card">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Brand Name</label>
                            <input type="text" id="brand_title" name="brand_title" placeholder="Enter Brand Name" class="form-control"  value="{{ old('brand_title') }}">
                            @if($errors->has('brand_title'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('brand_title') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Brand Logo</label>
                            <input type="file" class="dropify form-control" data-height="143" accept="image/*" value="{{ old('brand_logo') }}" id="brand_logo" name="brand_logo" />
                            @if($errors->has('brand_logo'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('brand_logo') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Campaign Name</label>
                            <input type="text" id="inputCampaignName" name="campaign_name" placeholder="Enter Campaign Name" class="form-control"  value="{{ old('campaign_name') }}">
                            @if($errors->has('campaign_name'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('campaign_name') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Campaign Type</label>
                            <select class="form-control select2 custom-select" data-placeholder="Choose one" name="adv_campaign[]" data-placeholder="Choose one">
                                <option label="Choose one"></option>
                                @foreach($CampaignType as $CampaignType)
                                    <option
                                        value="{{$CampaignType->campaign_type_id}}"
                                        {{ !empty(old('adv_campaign')) ? (in_array($CampaignType->campaign_type_id, old('adv_campaign')) ? 'selected' : '') : ''}}
                                    >
                                        {{ $CampaignType->campaign_type_name}}
                                    </option>
                                @endforeach
                            </select>
                            @if($errors->has('adv_campaign'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('adv_campaign') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input type="text" id="title" name="title" placeholder="Enter Advertisement Title" class="form-control"  value="{{ old('title') }}">
                            @if($errors->has('title'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('title') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea class="form-control" rows="2" name="desc" style="height: 63px">{{ old('desc') }}</textarea>
                            @if($errors->has('desc'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('desc') }}</p>
                            @endif
                        </div>

                        @if (Auth::user()->role_id == 1)
                            <div class="form-group">
                                <label class="control-label">User</label>
                                <div class="controls">
                                    <select class="form-control select2 custom-select" data-placeholder="Choose one" name="user_id">
                                        <option label="Select User"></option>
                                        @if (count($CadUsers) > 0)
                                            @foreach($CadUsers as $CadUser)
                                                <option value="{{ $CadUser->id }}" {{ old('user_id') == $CadUser->id  ? 'selected' : ''}}>{{ $CadUser->business_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                @if($errors->has('user_id'))
                                    <p class="statusDanger text-danger error-msg">{{ $errors->first('user_id') }}</p>
                                @endif
                            </div>
                        @else
                            <div class="form-group">
                                <input type="hidden" id="adv_user" name="user_id" value="{{Auth::user()->id}}">
                            </div>
                        @endif

                        <div class="form-group">
                            <label class="control-label">Category</label>
                            <div class="controls">
                                <select class="form-control" name="adv_cat[]" id="adv_cat" multiple>
                                    @if (count($CadAdvertisementCategories) > 0)
                                        @foreach($CadAdvertisementCategories as $CadAdvertisementCategorie)
                                        <option
                                            value="{{ $CadAdvertisementCategorie->advertisement_category_id }}"
                                            {{ !empty(old('adv_cat')) ? (in_array($CadAdvertisementCategorie->advertisement_category_id, old('adv_cat')) ? 'selected' : '') : ''}}
                                        >
                                            {{ $CadAdvertisementCategorie->advertisement_categories_name}}
                                        </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            @if($errors->has('adv_cat'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('adv_cat') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Advertisement Type</label>
                            <div class="controls">
                                <select class="form-control select2" data-placeholder="Choose one" name="adv_type" id="adv_type">
                                    <option label="Select One"></option>
                                    <option value="Read more" {{ old('adv_type') == 'Read more'  ? 'selected' : ''}}>Read more</option>
                                    <option value="Shop now" {{ old('adv_type') == 'Shop now'  ? 'selected' : ''}}> Shop now</option>
                                    <option value="Install" {{ old('adv_type') == 'Install'  ? 'selected' : ''}}> Install</option>
                                    <option value="Contact us" {{ old('adv_type') == 'Contact us'  ? 'selected' : ''}}>Contact us</option>
                                </select>
                            </div>
                            @if($errors->has('adv_type'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('adv_type') }}</p>
                            @endif
                        </div>
                        <strong class="text-info">Available users: {{ $totalUsers }}</strong>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label class="control-label">Start Date</label>
                                    <input id="inputStartDate" name="start_date" class="form-control" value="{{ old('start_date') }}" placeholder="Please select start date">
                                    @if($errors->has('start_date'))
                                        <span class="statusDanger text-danger error-msg">{{ $errors->first('start_date') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="control-label">End Date</label>
                                    <input id="inputEndDate" name="end_date" class="form-control" value="{{ old('end_date') }}" placeholder="Please select end date">
                                    @if($errors->has('end_date'))
                                        <span class="statusDanger text-danger error-msg">{{ $errors->first('end_date') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label class="label-control">Start Time</label>
                                    <input type="text" id="inputStartTime" name="start_time" class="form-control timepicker timeKeydown" value="{{ old('start_time') }}" placeholder="Please select start time">
                                    @if($errors->has('start_time'))
                                        <span class="statusDanger text-danger error-msg">{{ $errors->first('start_time') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="control-label">End Time</label>
                                    <input type="text" id="inputEndTime" name="end_time" class="form-control  timepicker timeKeydown" value="{{ old('end_time') }}" placeholder="Please select start time">
                                    @if($errors->has('end_time'))
                                        <span class="statusDanger text-danger error-msg">{{ $errors->first('end_time') }}</span>
                                    @endif
                                </div>
                            </div>
                            <p  class="text-primary">Current Time: <span id='ct'></span></p>
                            <span id="timeValidation" class="statusDanger text-danger error-msg" style="display: none;">End time must be less than Start time!</span>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label class="control-label">Daily Impression</label>
                                    <input type="number" id="inputDailyImpression" name="daily_impression" class="form-control" min="1" value="{{ old('daily_impression') }}">
                                    @if($errors->has('daily_impression'))
                                        <span class="statusDanger text-danger error-msg">{{ $errors->first('daily_impression') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="control-label">Lifetime Impression</label>
                                    <input type="number" id="inputLifetimeImpression" name="lifetime_impression" class="form-control number-input" min="1" value="{{ old('lifetime_impression') }}">
                                    @if($errors->has('lifetime_impression'))
                                        <span class="statusDanger text-danger error-msg">{{ $errors->first('lifetime_impression') }}</span>
                                    @endif
                                </div>
                            </div>
                            <span id="impressionValidation" class="statusDanger text-danger error-msg" style="display: none;">Daily impression & Lifetime impression can't be equal!</span>
                        </div>

                        <div class="form-group" id="rewardPoint">
                            <label class="control-label">Rewards Points</label>
                            <div class="controls">
                                <input type="number" id="inputRewardPoints" name="rewards_amount" class="form-control" min="13" value="{{ old('rewards_amount') }}">
                            </div>
                            @if($errors->has('rewards_amount'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('rewards_amount') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Budget</label>
                            <div class="controls">
                                <input type="number" id="inputBudget" name="budget" class="form-control number-input" value="{{ old('budget') }}" min="1">
                                <span class="help-inline alert-danger">{{ $errors->first('inputBudget') }}</span>
                            </div>
                            @if($errors->has('budget'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('budget') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Favorite Store</label>
                            <div class="controls">
                                <select class="multi-select" id="favorite_store" name="favorite_store_ids[]" multiple>
                                    @foreach($favoriteStores as $store)
                                        <option value="{{ $store->id}}"
                                            {{ !empty(old('favorite_store_ids')) ? (in_array($store->id, old('favorite_store_ids')) ? 'selected' : '') : 'selected'}}
                                            >{{ $store->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('favorite_store_ids'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('favorite_store_ids') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Favorite Category</label>
                            <div class="controls">
                                <select class="multi-select" id="favorite_category" name="favorite_category_ids[]" multiple>
                                    @foreach($favoriteCategory as $category)
                                        <option value="{{ $category->id}}" {{ old('favorite_category_ids') == $category->id  ? 'selected' : ''}}
                                            {{ !empty(old('favorite_category_ids')) ? (in_array($category->id, old('favorite_category_ids')) ? 'selected' : '') : 'selected'}}
                                            >{{ $category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('favorite_category_ids'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('favorite_category_ids') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Select Age Range</label>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <input type="number" id="inputAgeMin" name="min_age" class="form-control" placeholder="Min age" max="100" value="{{ old('min_age', 0) }}">
                                    @if($errors->has('min_age'))
                                        <p class="statusDanger text-danger error-msg">{{ $errors->first('min_age') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="number" id="inputAgeMax" name="max_age" class="form-control" placeholder="Max age" max="100" value="{{ old('max_age', 99) }}">
                                    @if($errors->has('max_age'))
                                        <p class="statusDanger text-danger error-msg">{{ $errors->first('max_age') }}</p>
                                    @endif
                                </div>
                            </div>
                            <span id="ageValidation" class="statusDanger text-danger error-msg" style="display: none;">Max age must be greater then min age.</span>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Select Country</label>
                            <div class="controls">
                                <select class="form-control select2 custom-select" data-placeholder="Choose one" name="country_id" id="adv_country">
                                    <option label="Select Country"></option>
                                    @if (count($Countries) > 0)
                                        @foreach($Countries as $Country)
                                            <option
                                                value="{{ $Country->id}}"
                                                {{ old('country_id') == $Country->id  ? 'selected' : ''}}
                                            >
                                                {{ $Country->name}}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            @if($errors->has('country_id'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('country_id') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label class="control-label">Select City</label>
                                    <select class="multi-select" id="advCity" name="city_id[]" multiple>
                                        @foreach($Cities as $Cities)
                                            <option value="{{ $Cities->id}}"
                                                {{ !empty(old('city_id')) ? (in_array($Cities->id, old('city_id')) ? 'selected' : '') : 'selected'}}
                                                > {{ $Cities->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('city_id'))
                                        <p class="statusDanger text-danger error-msg">{{ $errors->first('city_id') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="control-label">Select State</label>
                                    <select class="multi-select" id="advState" name="state_id[]" multiple>
                                        @foreach($States as $State)
                                            <option value="{{ $State->id}}"
                                                {{ !empty(old('state_id')) ? (in_array($State->id, old('state_id')) ? 'selected' : '') : 'selected'}}
                                                > {{ $State->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('state_id'))
                                        <p class="statusDanger text-danger error-msg">{{ $errors->first('state_id') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if (Auth::user()->role_id == 1)
                        <div class="form-group">
                            <label class="control-label">Active Status</label>
                            <div class="controls">
                                <select class="form-control select2 custom-select" data-placeholder="Choose one" name="is_active">
                                    <option label="Select Active Status"></option>
                                    @if (Auth::user()->role_id == 1)
                                        <option
                                            value="publish" {{ old('is_active') == 'publish'  ? 'selected' : ''}}
                                        >
                                            Publish
                                        </option>
                                        <option
                                            value="pending" {{ old('is_active') == 'pending'  ? 'selected' : ''}}>
                                            pending
                                        </option>
                                    @else
                                        <option
                                            value="pending" {{ old('is_active') == 'pending'  ? 'selected' : ''}}>
                                            pending
                                        </option>
                                    @endif
                                </select>
                            </div>
                            @if($errors->has('is_active'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('is_active') }}</p>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="nativeAdvSection">
                            <div id="feedMediaParent">
                                <h5 style="cursor: context-menu;" class="text-center">Native Ad Section</h5>
                                <div class="feedMediaSection p-0">
                                    <div class="form-group" id="imageSectionFeed">
                                        @if(!empty(old('native_ad_type')))
                                        <div class="form-row">
                                            <div class="col-md-3">
                                                <label class="control-label">Upload Image</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="control-label">Preview</label>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label">Ad Type</label>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="">Reference Url</label>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="">Percent</label>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label">Position</label>
                                            </div>
                                        </div>
                                        @for($i = 0; $i < count(old('native_ad_type')); $i++)
                                        <div class="form-row imgFeedBlock nativeAdBlock" id="nativeAdOld_{{ $i }}">
                                            <div class="col-md-3 margin-bottom-minus-10 mb-2" style="padding-left: 20px;">
                                                {{-- <label class="control-label">Upload Image</label> --}}
                                                <div class="custom-file">
                                                    <div id="imageSection">
                                                        <input
                                                            type="file" class="custom-file-input native_ad_img"
                                                            id="native_ad_img" name="nativeAdImg[]" accept="image/*"
                                                            onchange="loadFile('nativeImgLoad{{ $i }}')">
                                                        <label class="custom-file-label" for="native_ad_img">Choose file</label>
                                                    </div>
                                                </div>
                                                @if($errors->has('nativeAdImg'))
                                                    <p class="statusDanger text-danger error-msg">{{ $errors->first('nativeAdImg') }}</p>
                                                @endif
                                            </div>
                                            <div class="col-md-1">
                                                <a href="javascript:void(0)" type="button" class="btn btn-outline-primary" id="previewNativeButton" onclick="fnPreviewNativeAd({{ $i }})"><i class="fe fe-smartphone"></i></a>
                                            </div>
                                            <div class="col-md-2">
                                                {{-- <label class="control-label">Ad Type</label> --}}
                                                <div class="controls">
                                                    <select class="form-control nativeAdType native_ad_type" name="native_ad_type[]" id="native_ad_type{{ $i }}" onchange="percentCheckByAdTypeNative({{ $i }}, this.value)">
                                                        <option value="">Select Type</option>
                                                        <option value="1" {{ old('native_ad_type')[$i] == 1 ? 'selected' : '' }}>Promotions</option>
                                                        <option value="2" {{ old('native_ad_type')[$i] == 2 ? 'selected' : '' }}>Bons Plans</option>
                                                        <option value="3" {{ old('native_ad_type')[$i] == 3 ? 'selected' : '' }}>Codes Promo</option>
                                                    </select>
                                                </div>
                                                @if($errors->has('native_ad_type'))
                                                    <p class="statusDanger text-danger error-msg">{{ $errors->first('native_ad_type') }}</p>
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                {{-- <label for="">Reference Url</label> --}}
                                                <input type="url" id="inputAdvFeedLink" name="nativeAdRefLink[]" placeholder="Enter Referal Link" class="form-control" value="{{ old('nativeAdRefLink')[$i] }}">
                                            </div>
                                            <div class="col-md-2">
                                                {{-- <label for="">Percent</label> --}}
                                                <input type="number" id="nativeAdPercent0" name="nativeAdPercent[]" placeholder="Enter time percent" class="form-control inputAdvFeedShowTime nativeAdPercent" min="1" value="{{ old('nativeAdPercent')[$i] }}"
                                                onkeyup="bannerAdPercentCalculation(this, {{ $i }})">
                                            </div>
                                            <div class="col-md-2">
                                                {{-- <label class="control-label">Position</label> --}}
                                                <div class="controls">
                                                    <input type="number" id="adv_position_slot{{ $i }}" name="nativeAdPosition[]" class="form-control nativeAdPosition" min="1" placeholder="Ad position" value="{{ old('nativeAdPosition')[$i] }}"
                                                    onkeyup="fnCheckNativeAdPosition({{ $i }})">
                                                </div>
                                                <span class="mt-1 text-danger" id="positionError{{ $i }}"></span>
                                            </div>
                                            <span class="removedfeed" style="cursor: pointer;margin-top: 8px;position:absolute;" onclick="fnRemoveOldNativeAd({{ $i }})">
                                                <i class="fa fa-close"></i>
                                            </span>
                                            <img src="" id="nativeImgLoad{{ $i }}" width="10%" height="auto">
                                        </div>
                                        @endfor
                                        @else
                                        <div class="row imgFeedBlock nativeAdBlock">
                                            <div class="col-md-3">
                                                <label class="control-label">Upload Image</label>
                                                <div class="custom-file">
                                                    <div id="imageSection">
                                                        <input
                                                            type="file" class="custom-file-input native_ad_img"
                                                            id="native_ad_img1" name="nativeAdImg[]" accept="image/*"
                                                            onchange="loadFile('nativeImgLoad0')">
                                                        <label class="custom-file-label" for="native_ad_img">Choose file</label>
                                                    </div>
                                                </div>
                                                @if($errors->has('nativeAdImg'))
                                                    <p class="statusDanger text-danger error-msg">{{ $errors->first('nativeAdImg') }}</p>
                                                @endif
                                            </div>
                                            <div class="col-md-1 pl-0 pr-0 text-center">
                                                <label class="control-label">Preview</label>
                                                <div>
                                                    <a href="javascript:void(0)" type="button" class="btn btn-outline-primary" id="previewNativeButton" onclick="fnPreviewNativeAd(1)"><i class="fe fe-smartphone"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label">Ad Type</label>
                                                <div class="controls">
                                                    <select class="form-control nativeAdType native_ad_type" name="native_ad_type[]" id="native_ad_type0" onchange="percentCheckByAdTypeNative(0, this.value)">
                                                        <option value="">Select Type</option>
                                                        <option value="1" {{ old('native_ad_type') == 1 ? 'selected' : '' }}>Promotions</option>
                                                        <option value="2" {{ old('native_ad_type') == 2 ? 'selected' : '' }}>Bons Plans</option>
                                                        <option value="3" {{ old('native_ad_type') == 3 ? 'selected' : '' }}>Codes Promo</option>
                                                    </select>
                                                </div>
                                                @if($errors->has('native_ad_type'))
                                                    <p class="statusDanger text-danger error-msg">{{ $errors->first('native_ad_type') }}</p>
                                                @endif
                                            </div>
                                            <div class="col-md-2">
                                                <label for="">Reference Url</label>
                                                <input type="url" id="nativeAdRefLink1" name="nativeAdRefLink[]" placeholder="Enter Referal Link" class="form-control" value="">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="">Percent</label>
                                                <input type="number" id="nativeAdPercent0" name="nativeAdPercent[]" placeholder="Enter time percent" class="form-control inputAdvFeedShowTime nativeAdPercent" min="1" value="100"
                                                onkeyup="nativeAdPercentCalculation(this, 0)">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label">Position</label>
                                                <div class="controls">
                                                    <input type="number" id="adv_position_slot0" name="nativeAdPosition[]" class="form-control nativeAdPosition" min="1" placeholder="Ad position" onkeyup="fnCheckNativeAdPosition(0)">
                                                </div>
                                                <span class="mt-1 text-danger" id="positionError0"></span>
                                            </div>
                                            <img src="" id="nativeImgLoad0" width="10%" height="auto">
                                        </div>
                                        @endif
                                    </div>
                                    <span class="mt-5">Note: The total percent should not be more than 100</span>
                                </div>
                                <div class="addButton">
                                    <a  class="btn btn-info text-white" id="addInputFeedField">
                                        <i class="icon-plus"></i> Add more
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div id="mediaUploadSection">
                            <div id="storyMediaParent">
                                <h5 style="cursor: context-menu;" class="text-center">Story Media</h5>
                                <div class="storyMediaSection">
                                    <div class="form-group" id="imageSectionStory">
                                        @if(!empty(old('storyAdRefLink')))
                                        <div class="form-row" >
                                            <div class="col-md-7">
                                                <label class="control-label">Upload Image/Video</label>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="control-label">Preview</label>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="">Reference Url</label>
                                            </div>
                                        </div>
                                        @for($i = 0; $i < count(old('storyAdRefLink')); $i++)
                                        <div class="form-row storyBlock mt-2" id="storyBlock_{{ $i }}">
                                            <div class="col-md-7 margin-bottom-minus-10 mb-2" style="padding-left: 20px;">
                                                {{-- <label class="control-label">Upload Image/Video</label> --}}
                                                <div class="custom-file">
                                                    <div id="imageSection">
                                                        <input  type="file" class="custom-file-input story_ad_img"
                                                            id="story_ad_img{{ $i }}" name="storyAdMedia[]" accept="video/*,image/*" onchange="loadFile('storyImgLoad{{ $i }}')">
                                                        <label class="custom-file-label" for="story_ad_img">Choose file</label>
                                                    </div>
                                                    <span class="help-inline alert-danger">{{ $errors->first('storyAdMedia') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-1 pl-0 pr-0 text-center">
                                                {{--  <label class="control-label">Preview</label>  --}}
                                                <div>
                                                    <a href="javascript:void(0)" type="button" class="btn btn-outline-primary" id="previewStoryButton" onclick="fnPreviewStoryAd({{ $i }})"><i class="fe fe-smartphone"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                {{-- <label for="">Reference Url</label> --}}
                                                <input type="url" id="storyLinkId{{ $i }}" name="storyAdRefLink[]" placeholder="Enter Referal Link" class="form-control" value="{{ old('storyAdRefLink')[$i] }}">
                                            </div>
                                            <span style="cursor: pointer;margin-top: 8px;position:absolute;" onclick="fnRemoveStory({{ $i }})">
                                                <i class="fa fa-close"></i>
                                            </span>
                                            <img src="" id="storyImgLoad{{ $i }}" width="10%" height="auto">
                                        </div>
                                        @endfor
                                        @else
                                        <div class="form-row storyBlock">
                                            <div class="col-md-7">
                                                <label class="control-label">Upload Image/Video</label>
                                                <div class="custom-file">
                                                    <div id="imageSection">
                                                        <input  type="file" class="custom-file-input story_ad_img"
                                                            id="story_ad_img1" name="storyAdMedia[]" accept="video/*,image/*" onchange="loadFile('storyImgLoad0')">
                                                        <label class="custom-file-label" for="story_ad_img">Choose file</label>
                                                    </div>
                                                    <span class="help-inline alert-danger">{{ $errors->first('storyAdMedia') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-1 pl-0 pr-0 text-center">
                                                <label class="control-label">Preview</label>
                                                <div>
                                                    <a href="javascript:void(0)" type="button" class="btn btn-outline-primary" id="previewStoryButton" onclick="fnPreviewStoryAd(1)"><i class="fe fe-smartphone"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="">Reference Url</label>
                                                <input type="url" id="storyLinkId1" name="storyAdRefLink[]" placeholder="Enter Referal Link" class="form-control">
                                            </div>
                                            <img src="" id="storyImgLoad0" width="10%" height="auto">
                                        </div>
                                        @endif
                                    </div>
                                    <div class="addButton">
                                        <a  class="btn btn-info text-white" id="addInputStoryField">
                                            <i class="icon-plus"></i> Add more link
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div id="bannerMediaParent">
                                <h5 style="cursor: context-menu;" class="text-center">Banner Media</h5>
                                <div class="bannnerMediaSection">
                                    <div class="form-group" id="bannerSection">
                                        @if(!empty(old('banner_ad_type')))
                                        <div class="form-row">
                                            <div class="col-md-4" style="padding-left: 20px;">
                                                <label class="control-label">Upload Image</label>
                                            </div>
                                            <div class="col-md-1 pl-0 pr-0 text-center">
                                                <label class="control-label">Preview</label>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label">Ad Type</label>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Reference Url</label>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="">Percent</label>
                                            </div>
                                            {{--  <div class="col-md-2">
                                                <label class="control-label">Position</label>
                                            </div>  --}}
                                        </div>
                                        @for($i = 0; $i < count(old('banner_ad_type')); $i++)
                                        <div class="form-row bannerItems" id="bannerBlock_{{ $i }}">
                                            <div class="col-md-4 margin-bottom-minus-10 mb-2" style="padding-left: 20px;">
                                                {{-- <label class="control-label">Upload Image</label> --}}
                                                <div class="custom-file">
                                                    <div id="imageSection">
                                                        <input
                                                            type="file" class="custom-file-input banner_ad_img"
                                                            id="banner_ad_img{{ $i }}" name="bannerAdImg[]" accept="image/*" onchange="loadFile('bannerImgLoad{{ $i }}')">
                                                        <label class="custom-file-label" for="banner_ad_img">Choose file</label>
                                                    </div>
                                                </div>
                                                @if($errors->has('bannerAdImg'))
                                                    <p class="statusDanger text-danger error-msg">{{ $errors->first('bannerAdImg') }}</p>
                                                @endif
                                            </div>
                                            <div class="col-md-1 pl-0 pr-0 text-center">
                                                <div>
                                                    <a href="javascript:void(0)" type="button" class="btn btn-outline-primary" id="previewBannerButton" onclick="fnPreviewBannerAd({{ $i }})"><i class="fe fe-smartphone"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                {{-- <label class="control-label">Ad Type</label> --}}
                                                <div class="controls">
                                                    <select class="form-control bannerAdType" name="banner_ad_type[]" id="banner_ad_type{{ $i }}" onChange="fnCheckPercentageForAdType({{ $i }})">
                                                        <option value="">Select Type</option>
                                                        <option value="1" {{ old('banner_ad_type')[$i] == 1 ? 'selected' : '' }}>Promotions</option>
                                                        <option value="2" {{ old('banner_ad_type')[$i] == 2 ? 'selected' : '' }}>Bons Plans</option>
                                                        <option value="3" {{ old('banner_ad_type')[$i] == 3 ? 'selected' : '' }}>Codes Promo</option>
                                                    </select>
                                                </div>
                                                @if($errors->has('banner_ad_type'))
                                                    <p class="statusDanger text-danger error-msg">{{ $errors->first('banner_ad_type') }}</p>
                                                @endif
                                            </div>
                                            <div class="col-md-3">
                                                {{-- <label for="">Reference Url</label> --}}
                                                <input type="url" id="inputAdvFeedLink" name="bannerAdRefLink[]" placeholder="Enter Referal Link" class="form-control" value="{{ old('bannerAdRefLink')[$i] }}">
                                            </div>
                                            <div class="col-md-2">
                                                {{-- <label for="">Percent</label> --}}
                                                <input type="number" id="bannerAdPercent0" name="bannerAdPercent[]" placeholder="Enter time percent" class="form-control bannerAdPercent" min="1" value="{{ old('bannerAdPercent')[$i] }}"
                                                onkeyup="bannerAdPercentCalculation(this, {{ $i }})">
                                            </div>
                                            {{--  <div class="col-md-2">
                                                <label class="control-label">Position</label>
                                                <div class="controls">
                                                    <input type="number" id="bannerAdPosition{{ $i }}" name="bannerAdPosition[]" class="form-control bannerAdPosition" min="1" placeholder="Ad position" value="{{ old('bannerAdPosition')[$i] }}" onkeyup="fnCheckBannerAdPosition({{ $i }})">
                                                </div>
                                                <span class="mt-1 text-danger" id="bannerPosError{{ $i }}"></span>
                                            </div>  --}}
                                            <span class="removedfeed" style="cursor: pointer;margin-top: 8px;position:absolute;" onclick="fnRemoveBanner({{ $i }})">
                                                <i class="fa fa-close"></i>
                                            </span>
                                            <img src="" id="bannerImgLoad{{ $i }}" width="10%" height="auto">
                                        </div>
                                        @endfor
                                        @else
                                        <div class="form-row bannerItems">
                                            <div class="col-md-4">
                                                <label class="control-label">Upload Image</label>
                                                <div class="custom-file">
                                                    <div id="imageSection">
                                                        <input
                                                            type="file" class="custom-file-input banner_ad_img"
                                                            id="banner_ad_img0" name="bannerAdImg[]" accept="image/*" onchange="loadFile('bannerImgLoad0')">
                                                        <label class="custom-file-label" for="banner_ad_img">Choose file</label>
                                                    </div>
                                                </div>
                                                @if($errors->has('bannerAdImg'))
                                                    <p class="statusDanger text-danger error-msg">{{ $errors->first('bannerAdImg') }}</p>
                                                @endif
                                            </div>
                                            <div class="col-md-1 pl-0 pr-0 text-center">
                                                <label class="control-label">Preview</label>
                                                <div>
                                                    <a href="javascript:void(0)" type="button" class="btn btn-outline-primary" id="previewBannerButton" onclick="fnPreviewBannerAd(0)"><i class="fe fe-smartphone"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label">Ad Type</label>
                                                <div class="controls">
                                                    <select class="form-control bannerAdType banner_ad_type" name="banner_ad_type[]" id="banner_ad_type0" onchange="percentCheckByAdType(0, this.value)">
                                                        <option value="">Select Type</option>
                                                        <option value="1" {{ old('banner_ad_type') == 1 ? 'selected' : '' }}>Promotions</option>
                                                        <option value="2" {{ old('banner_ad_type') == 2 ? 'selected' : '' }}>Bons Plans</option>
                                                        <option value="3" {{ old('banner_ad_type') == 3 ? 'selected' : '' }}>Codes Promo</option>
                                                    </select>
                                                </div>
                                                @if($errors->has('banner_ad_type'))
                                                    <p class="statusDanger text-danger error-msg">{{ $errors->first('banner_ad_type') }}</p>
                                                @endif
                                            </div>
                                            <div class="col-md-3">
                                                <label for="">Reference Url</label>
                                                <input type="url" id="bannerAdRefLink1" name="bannerAdRefLink[]" placeholder="Enter Referal Link" class="form-control" value="">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="">Percent</label>
                                                <input type="number" id="bannerAdPercent0" name="bannerAdPercent[]" placeholder="Enter time percent" class="form-control bannerAdPercent" min="1" value="100" onkeyup="bannerAdPercentCalculation(this, 0)">
                                            </div>
                                            {{--  <div class="col-md-2">
                                                <label class="control-label">Position</label>
                                                <div class="controls">
                                                    <input type="number" id="bannerAdPosition1" name="bannerAdPosition[]" class="form-control bannerAdPosition" min="1" placeholder="Ad position" onkeyup="fnCheckBannerAdPosition(1)">
                                                </div>
                                                <span class="mt-1 text-danger" id="bannerPosError1"></span>
                                            </div>  --}}
                                            <img src="" id="bannerImgLoad0" width="10%" height="auto">
                                        </div>
                                        @endif
                                    </div>
                                    <div class="addButton">
                                        <a  class="btn btn-info text-white" id="addInputBannerField">
                                            <i class="icon-plus"></i> Add more link
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div id="homeBannerParent">
                                <h5 style="cursor: context-menu;" class="text-center">Home Banner</h5>
                                <div class="homeBannerSection">
                                    <div class="form-group" id="imageSectionHomeBanner">
                                        @if(!empty(old('homeBannerRefLink')))
                                        <div class="form-row" >
                                            <div class="col-md-6">
                                                <label class="control-label">Upload Image</label>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="">Reference Url</label>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label">Position</label>
                                            </div>
                                        </div>
                                        @for($i = 0; $i < count(old('homeBannerRefLink')); $i++)
                                        <div class="form-row homeBannerBlock mt-2" id="homeBannerBlock_{{ $i }}">
                                            <div class="col-md-6 margin-bottom-minus-10 mb-2" style="padding-left: 20px;">
                                                <div class="custom-file">
                                                    <div id="homeBannerImageSection">
                                                        <input  type="file" class="custom-file-input home_banner_img"
                                                            id="home_banner_img{{ $i }}" name="homeBannerMedia[]" accept="image/*" onchange="loadFile('homeBannerImgLoad{{ $i }}')">
                                                        <label class="custom-file-label" for="home_banner_img">Choose file</label>
                                                    </div>
                                                    <span class="help-inline alert-danger">{{ $errors->first('homeBannerMedia') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="url" id="homeBannerId{{ $i }}" name="homeBannerRefLink[]" placeholder="Enter Referal Link" class="form-control" value="{{ old('homeBannerRefLink')[$i] }}">
                                            </div>
                                            <div class="col-md-2">
                                                <div class="controls">
                                                    <input type="number" id="homeBannerAdPosition{{ $i }}" name="homeBannerAdPosition[]" class="form-control homeBannerAdPosition" min="1" placeholder="Ad position" value="{{ old('homeBannerAdPosition')[$i] }}">
                                                </div>
                                            </div>
                                            <span style="cursor: pointer;margin-top: 8px;position:absolute;" onclick="fnRemoveHomeBanner({{ $i }})">
                                                <i class="fa fa-close"></i>
                                            </span>
                                            <img src="" id="homeBannerImgLoad{{ $i }}" width="10%" height="auto">
                                        </div>
                                        @endfor
                                        @else
                                        <div class="form-row homeBannerBlock">
                                            <div class="col-md-6">
                                                <label class="control-label">Upload Image</label>
                                                <div class="custom-file">
                                                    <div id="homeBannerImageSection">
                                                        <input  type="file" class="custom-file-input story_ad_img"
                                                            id="home_banner_img" name="homeBannerMedia[]" accept="image/*"
                                                            onchange="loadFile('homeBannerImgLoad0')">
                                                        <label class="custom-file-label" for="home_banner_img">Choose file</label>
                                                    </div>
                                                    <span class="help-inline alert-danger">{{ $errors->first('homeBannerMedia') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="">Reference Url</label>
                                                <input type="url" id="homeBannerRefLinkId" name="homeBannerRefLink[]" placeholder="Enter Referal Link" class="form-control" value="{{ old('homeBannerRefLink') }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label">Position</label>
                                                <div class="controls">
                                                    <input type="number" id="homeBannerAdPosition0" name="homeBannerAdPosition[]" class="form-control homeBannerAdPosition" min="1" placeholder="Ad position">
                                                </div>
                                            </div>
                                            <img src="" id="homeBannerImgLoad0" width="10%" height="auto">
                                        </div>
                                        @endif
                                    </div>
                                    <span class="mt-5 text-info">Note: At most Two banner can be add.</span>
                                    <div class="addButton" id="homeBannerAddButton">
                                        <a  class="btn btn-info text-white" id="addInputHomeBannerField">
                                            <i class="icon-plus"></i> Add more link
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div id="rewardMediaParent">
                                <h5 style="cursor: context-menu;" class="text-center">Reward Media</h5>
                                <div class="rewardMediaSection">
                                    <div class="form-group" id="rewardSection">
                                        @if(!empty(old('rewardAdRefLink')))
                                        <div class="form-row rewardBlock">
                                            <div class="col-md-5">
                                                <label class="control-label">Upload Image/Video</label>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="control-label">Reference Url</label>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="control-label">Reward</label>
                                            </div>
                                        </div>
                                        @for($i = 0; $i < count(old('rewardAdRefLink')); $i++)
                                        <div class="form-row rewardBlock" id="rewardBlock_{{ $i }}">
                                            <div class="col-md-5 margin-bottom-minus-10 mb-2" style="padding-left: 20px;">
                                                {{-- <label class="control-label">Upload Image/Video</label> --}}
                                                <div class="custom-file">
                                                    <div id="imageSection">
                                                        <input  type="file" class="custom-file-input reward_ad_media"
                                                            id="reward_ad_media" name="rewardAdMedia[]" accept="video/*,image/*">
                                                        <label class="custom-file-label" for="reward_ad_media">Choose file</label>
                                                    </div>
                                                    <span class="help-inline alert-danger">{{ $errors->first('rewardAdMedia') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                {{-- <label class="control-label">Reference Url</label> --}}
                                                <div class="controls">
                                                    <input type="url" id="storyLinkId" name="rewardAdRefLink[]" placeholder="Enter Referal Link" class="form-control" value="{{ old('rewardAdRefLink')[$i] }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                {{-- <label class="control-label">Reward</label> --}}
                                                <div class="controls">
                                                    <input type="number" id="adv_position_slot" name="rewardAdReward[]" class="form-control" min="1" placeholder="Reward" value="{{ old('rewardAdReward')[$i] }}">
                                                </div>
                                            </div>
                                            <span style="cursor: pointer;margin-top: 8px;position:absolute;" onclick="fnRemoveReward({{ $i }})">
                                                <i class="fa fa-close"></i>
                                            </span>
                                        </div>
                                        @endfor
                                        @else
                                        <div class="form-row rewardBlock">
                                            <div class="col-md-5">
                                                <label class="control-label">Upload Image/Video</label>
                                                <div class="custom-file">
                                                    <div id="imageSection">
                                                        <input  type="file" class="custom-file-input reward_ad_media"
                                                            id="reward_ad_media" name="rewardAdMedia[]" accept="video/*,image/*">
                                                        <label class="custom-file-label" for="reward_ad_media">Choose file</label>
                                                    </div>
                                                    <span class="help-inline alert-danger">{{ $errors->first('rewardAdMedia') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="control-label">Reference Url</label>
                                                <div class="controls">
                                                    <input type="url" id="storyLinkId" name="rewardAdRefLink[]" placeholder="Enter Referal Link" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="control-label">Reward</label>
                                                <div class="controls">
                                                    <input type="number" id="adv_position_slot" name="rewardAdReward[]" class="form-control" min="1" placeholder="Reward">
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="addButton">
                                        <a  class="btn btn-info" id="addInputRewardField">
                                            <i class="icon-plus"></i> Add more link
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('adv.list') }}" class="btn btn-default mr-2">Back</a>
                <button type="button" class="btn btn-primary btnValidation" id="btnSubmitCampaign">Save</button>
            </div>
        </div>
    </form>
</section>

@include('pages.advertisement.preview')

@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('assets/old-js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/old-js/daterangepicker.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/old-js/bootstrap-multiselect.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/old-js/addAdvertisement.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/old-js/commonAdvertise.js') }}"></script>

    <script src="{{ asset('assets/old-js/index.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/old-js/moment.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/old-js/boostrap-datetime.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/old-js/timepicker.js') }}" type="text/javascript"></script>
    <script>

        $(document).ready(function() {
            display_serverTime();
        });

        //date picker
        $('#inputEndDate').bootstrapMaterialDatePicker({ weekStart : 0, time: false, minDate: moment(), format : 'DD-MM-YYYY' });
        $('#inputStartDate').bootstrapMaterialDatePicker({ weekStart : 0, time: false, minDate: moment(), format : 'DD-MM-YYYY' }).on('change', function(e, date)
        {
            $('#inputEndDate').bootstrapMaterialDatePicker('setMinDate', date);
        });

        $('#inputStartTime').blur(function () {
            checkTimeSlot("{{ route('adv.check.timeslot') }}");
        });

        $('#inputEndTime').blur(function () {
            checkTimeSlot("{{ route('adv.check.timeslot') }}");
        });

    </script>
@endsection
