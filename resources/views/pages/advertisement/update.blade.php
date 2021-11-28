@extends('layouts.base')
@section('title', 'Update Campaign')

@section('style')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link href="{{ asset('assets/old-css/boostrap-datetime.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/old-css/timepicker.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/old-css/daterangepicker.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/old-css/bootstrap-multiselect.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/new.css') }}">

    <style>
        .loader {
            animation:spin 1s infinite linear;
            border:solid 1vmin transparent;
            border-radius:50%;
            border-right-color:#d6336c;
            border-top-color:#d6336c;
            box-sizing:border-box;
            height:8vmin;
            left:calc(50% - 10vmin);
            position:fixed;
            top:calc(50% - 10vmin);
            width:8vmin;
            z-index:1;
            &:before {
                animation:spin 2s infinite linear;
                border:solid 2vmin transparent;
                border-radius:50%;
                border-right-color:#d6336c;
                border-top-color:#d6336c;
                box-sizing:border-box;
                content:"";
                height:16vmin;
                left:0;
                position:absolute;
                top:0;
                width:16vmin;
            }
            &:after {
                animation:spin 3s infinite linear;
                border:solid 2vmin transparent;
                border-radius:50%;
                border-right-color:#d6336c;
                border-top-color:#d6336c;
                box-sizing:border-box;
                content:"";
                height:8vmin;
                left:2vmin;
                position:absolute;
                top:2vmin;
                width:8vmin;
            }
        }

        @keyframes spin {
            100% {
                transform:rotate(360deg);
            }
        }

    </style>
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
    <form action="{{ route('adv.update', ['campaign_id' => $campaign_id]) }}" method="post" enctype="multipart/form-data" id="advUpdateForm">
        @csrf

        <input type="hidden" name="brand_logo_old" value="{{ $brand_logo }}">

        <div class="card">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Brand Name</label>
                            <div class="controls">
                                <input type="text" id="inputBrandName" name="brand_title" placeholder="Enter Brand Name" class="form-control"  value="{{ old('brand_title', $brand_title) }}">
                            </div>
                            @if($errors->has('brand_title'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('brand_title') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Brand Logo</label>
                            <input type="file" class="dropify form-control custom-file-input" data-height="143" accept="image/*" value="{{ old('brand_logo', $brand_logo) }}" id="brand_logo" name="brand_logo" data-default-file="{{ asset($brand_logo) }}" />
                            @if($errors->has('brand_logo'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('brand_logo') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Campaign Name</label>
                            <div class="custom-file">
                                <input type="text" id="inputCampaignName" name="campaign_name" placeholder="Enter Campaign Name" class="form-control"  value="{{ old('campaign_name', $campaign_name) }}">
                            </div>
                            @if($errors->has('campaign_name'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('campaign_name') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Campaign Type</label>
                            <div class="controls">
                                <select class="form-control" name="adv_campaign[]" id="adv_campaign" disabled>
                                    @foreach($campaignType as $campType)
                                        <option
                                            value="{{$campType->campaign_type_id}}"
                                            {{ $campType->campaign_type_id == $campaign_type_id ? 'selected' : ''}}
                                        >
                                            {{ $campType->campaign_type_name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('adv_campaign'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('adv_campaign') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <div class="controls">
                                <input type="text" id="title" name="title" placeholder="Enter Advertisement Title" class="form-control"  value="{{ old('title', $title) }}">
                            </div>
                            @if($errors->has('title'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('title') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <div class="controls">
                                <textarea class="form-control" rows="2" name="desc" style="height: 63px">{{ old('desc', $desc) }}</textarea>
                            </div>
                            @if($errors->has('desc'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('desc') }}</p>
                            @endif
                        </div>

                        @if (Auth::user()->role_id == 1)
                            <div class="form-group">
                                <label class="control-label">User</label>
                                <div class="controls">
                                    <select class="form-control select2" name="user_id">
                                        <option value="">Select User</option>
                                        @if (count($cadUsers) > 0)
                                            @foreach($cadUsers as $cadUser)
                                                <option value="{{ $cadUser->id }}" {{ old('user_id', $user_id) == $cadUser->id  ? 'selected' : ''}}>{{ $cadUser->business_name}}</option>
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
                                    @if (count($cadAdvertisementCategories) > 0)
                                        @foreach($cadAdvertisementCategories as $advCat)
                                        @if ($advCat->advertisement_category_id != 4)
                                            <option
                                                value="{{ $advCat->advertisement_category_id }}"
                                                {{ in_array($advCat->advertisement_category_id, $cat_ids) ? 'selected' : ''}}
                                            >
                                                {{ $advCat->advertisement_categories_name}}
                                            </option>
                                        @endif
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
                                <select class="form-control select2" data-placeholder="Choose one" name="adv_type">
                                    <option label="Select One"></option>
                                    <option value="Read more" {{ old('adv_type', $adv_type) == 'Read more'  ? 'selected' : ''}}>Read more</option>
                                    <option value="Shop now" {{ old('adv_type', $adv_type) == 'Shop now'  ? 'selected' : ''}}> Shop now</option>
                                    <option value="Install" {{ old('adv_type', $adv_type) == 'Install'  ? 'selected' : ''}}> Install</option>
                                    <option value="Contact us" {{ old('adv_type', $adv_type) == 'Contact us'  ? 'selected' : ''}}>Contact us</option>
                                </select>
                            </div>
                            @if($errors->has('adv_type'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('adv_type') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label class="control-label">Start Date</label>
                                    <input id="inputStartDate" name="start_date" class="form-control" value="{{ old('start_date', $start_date) }}" placeholder="Please select start date">
                                    @if($errors->has('start_date'))
                                        <span class="statusDanger text-danger error-msg">{{ $errors->first('start_date') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="control-label">End Date</label>
                                    <input id="inputEndDate" name="end_date" class="form-control" value="{{ old('end_date', $end_date) }}" placeholder="Please select end date">
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
                                    <input type="text" id="inputStartTime" name="start_time" class="form-control timepicker timeKeydown" value="{{ old('start_time', $start_time) }}" placeholder="Please select start time">
                                    @if($errors->has('start_time'))
                                        <span class="statusDanger text-danger error-msg">{{ $errors->first('start_time') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="control-label">End Time</label>
                                    <input type="text" id="inputEndTime" name="end_time" class="form-control timepicker timeKeydown" value="{{ old('end_time', $end_time) }}" placeholder="Please select start time">
                                    @if($errors->has('end_time'))
                                        <span class="statusDanger text-danger error-msg">{{ $errors->first('end_time') }}</span>
                                    @endif
                                </div>
                            </div>
                            <span id='ct' class="text-primary"></span>
                            <span id="timeValidation" class="statusDanger text-danger error-msg" style="display: none;">End time must be less than Start time!</span>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label class="control-label">Daily Impression</label>
                                    <input type="number" id="inputDailyImpression" name="daily_impression" class="form-control" min="1" value="{{ old('daily_impression', $daily_impression) }}">
                                    @if($errors->has('daily_impression', $daily_impression))
                                        <span class="statusDanger text-danger error-msg">{{ $errors->first('daily_impression') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="control-label">Lifetime Impression</label>
                                    <input type="number" id="inputLifetimeImpression" name="lifetime_impression" class="form-control number-input" min="1" value="{{ old('lifetime_impression', $lifetime_impression) }}">
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
                                <input type="number" id="inputRewardPoints" name="rewards_amount" class="form-control" min="13" value="{{ old('rewards_amount', $rewards_amount) }}">
                            </div>
                            @if($errors->has('rewards_amount'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('rewards_amount') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Budget</label>
                            <div class="controls">
                                <input type="number" id="inputBudget" name="budget" class="form-control number-input" value="{{ old('budget', $budget) }}" min="1">
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
                                        <option value="{{ $store->id}}" {{ in_array($store->id, old('favorite_store_ids', json_decode($favorite_store_ids)))  ? 'selected' : ''}}>{{ $store->name}}</option>
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
                                        <option value="{{ $category->id}}" {{ in_array($category->id, old('favorite_category_ids', json_decode($favorite_category_ids)))  ? 'selected' : ''}}>{{ $category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if($errors->has('favorite_category_id'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('favorite_category_id') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Select Age Range</label>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <input type="number" id="inputAgeMin" name="min_age" class="form-control" placeholder="Min age" max="100" value="{{ old('min_age', $min_age) }}">
                                    @if($errors->has('min_age'))
                                        <p class="statusDanger text-danger error-msg">{{ $errors->first('min_age') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="number" id="inputAgeMax" name="max_age" class="form-control" placeholder="Max age" max="100" value="{{ old('max_age', $max_age) }}">
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
                                <select class="form-control select2" name="country_id" id="adv_country">
                                    <option value="">Select Country</option>
                                    @if (count($countries) > 0)
                                        @foreach($countries as $country)
                                            <option
                                                value="{{ $country->id}}"
                                                {{ old('country_id', $country_id) == $country->id  ? 'selected' : ''}}
                                            >
                                                {{ $country->name}}
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
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id}}" {{ in_array($city->id, old('city_id', json_decode($city_id)))  ? 'selected' : ''}}> {{ $city->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('city_id'))
                                        <p class="statusDanger text-danger error-msg">{{ $errors->first('city_id') }}</p>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="control-label">Select State</label>
                                    <select class="multi-select" id="advState" name="state_id[]" multiple>
                                        @foreach($states as $state)
                                            <option value="{{ $state->id}}" {{ in_array($state->id, old('state_id', json_decode($state_id)))  ? 'selected' : ''}}> {{ $state->name}}</option>
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
                                <select class="form-control select2" name="is_active">
                                    <option value="">Select Active Status</option>
                                    @if (Auth::user()->role_id == 1)
                                        <option
                                            value="publish" {{ old('is_active', $is_active) == 'publish'  ? 'selected' : ''}}
                                        >
                                            Publish
                                        </option>
                                        <option
                                            value="pending" {{ old('is_active', $is_active) == 'pending'  ? 'selected' : ''}}>
                                            pending
                                        </option>
                                    @else
                                        <option
                                            value="pending" {{ old('is_active', $is_active) == 'pending'  ? 'selected' : ''}}>
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
                                <div class="feedMediaSection">
                                    <div class="form-group" id="imageSectionFeed">
                                        @if (isset($advertisement['Native']))
                                        <div class="form-row imgFeedTitleBlock margin-bottom-minus-10">
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
                                        @foreach($advertisement['Native'] as $key => $native)
                                        <div class="form-row imgFeedBlock nativeAdBlock" id="nativeAd_{{ $key }}">
                                            <div class="col-md-3" style="padding-left: 20px;">
                                                <div class="custom-file">
                                                    <div id="imageSection">
                                                        <input
                                                            type="file" class="custom-file-input native_ad_img"
                                                            id="native_ad_img{{ $key }}" name="nativeAdImg[{{ $native['media_id'] }}]" accept="image/*"
                                                            onchange="loadFile('nativeImgLoad{{ $key }}')">
                                                        <label class="custom-file-label" for="native_ad_img">Choose file</label>
                                                        {{-- hidden --}}
                                                        <input type="hidden" name="nativeAdImg[{{ $native['media_id'] }}]" value="{{ $native['media_link'] }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-1">
                                                <a href="javascript:void(0)" type="button" class="btn btn-outline-primary" id="previewNativeButton" onclick="nativeAdEditPreview('native', '{{ $title }}', '{{ asset($native['media_link']) }}', '{{ asset($brand_logo) }}', '{{ $native['position'] }}', '{{ $native['referal_link'] }}')"><i class="fe fe-smartphone"></i></a>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="controls">
                                                    <select class="form-control nativeAdType native_ad_type" name="native_ad_type[{{ $native['media_id'] }}]" id="native_ad_type{{ $key }}" onchange="percentCheckByAdTypeNative({{ $key }}, this.value)">
                                                        <option value="">Select Type</option>
                                                        <option value="1" {{ $native['ad_type'] == 1 ? 'selected' : '' }}>Promotions</option>
                                                        <option value="2" {{ $native['ad_type'] == 2 ? 'selected' : '' }}>Bons Plans</option>
                                                        <option value="3" {{ $native['ad_type'] == 3 ? 'selected' : '' }}>Codes Promo</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="url" id="inputAdvFeedLink{{ $key }}" name="nativeAdRefLink[{{ $native['media_id'] }}]" placeholder="Enter Referal Link" class="form-control" value="{{ $native['referal_link'] }}">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" id="nativeAdPercent{{ $key }}" name="nativeAdPercent[{{ $native['media_id'] }}]" placeholder="Enter time percent" class="form-control inputAdvFeedShowTime nativeAdPercent" min="1" value="{{ $native['time_percent'] }}"
                                                onkeyup="nativeAdPercentCalculation(this, {{ $key }})">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" id="inputAdvFeedPosition{{ $key }}" name="nativeAdPosition[{{ $native['media_id'] }}]" placeholder="Ad position" class="form-control nativeAdPosition" min="1" value="{{ $native['position'] }}" onkeyup="fnCheckNativeAdPosition({{ $key }})">
                                                <span class="mt-1 text-danger" id="positionError0"></span>
                                            </div>
                                            <span class="removedfeed" style="cursor: pointer;margin-top: 8px;position:absolute;" onclick="fnRemoveNativeAd({{ $key }})">
                                                <i class="fa fa-close"></i>
                                            </span>
                                            <img src="{{ asset($native['media_link']) }}" id="nativeImgLoad{{ $key }}" width="10%" height="auto">
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="form-row imgFeedBlock nativeAdBlock">
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
                                                <label class="control-label">Feed Ad Type</label>
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
                                                <input type="url" id="inputAdvFeedLink" name="nativeAdRefLink[]" placeholder="Enter Referal Link" class="form-control" value="">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="">Percent</label>
                                                {{-- <input type="number" id="inputAdvFeedShowTime" name="nativeAdPercent[]" placeholder="Enter time percent" class="form-control inputAdvFeedShowTime nativeAdPercent" min="1" value="100" onkeyup="nativeAdPercentCalculation(this)"> --}}

                                                <input type="number" id="nativeAdPercent0" name="nativeAdPercent[]" placeholder="Enter time percent" class="form-control inputAdvFeedShowTime nativeAdPercent" min="1" value="100" onkeyup="nativeAdPercentCalculation(this, 0)">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label">Position</label>
                                                <div class="controls">
                                                    <input type="number" id="adv_position_slot1" name="nativeAdPosition[]" class="form-control nativeAdPosition" min="1" placeholder="Ad position" onkeyup="fnCheckNativeAdPosition(1)">
                                                </div>
                                                <span class="mt-1 text-danger" id="positionError1"></span>
                                            </div>
                                            <img src="" id="nativeImgLoad0" width="10%" height="auto">
                                        </div>
                                        @endif
                                    </div>
                                    <span class="mt-5">Note: The total percent should not be more than 100</span>
                                </div>
                                <div class="addButton">
                                    <a  class="btn btn-info text-white" id="addInputFeedField">
                                        <i class="icon-plus"></i> Add more link
                                    </a>
                                </div>
                            </div>
                       </div>

                        <div id="mediaUploadSection">
                            <div id="storyMediaParent">
                                <h5 style="cursor: context-menu;" class="text-center">Story Media</h5>
                                <div class="storyMediaSection">
                                    @if (isset($advertisement['Story']))
                                    <div class="form-group margin-bottom-minus-10" id="storyTitleSection">
                                        <div class="form-row storyBlock">
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
                                    </div>
                                    <div class="form-group" id="imageSectionStory">
                                    @foreach($advertisement['Story'] as $key => $story)
                                        <div class="form-row  mt-2" id="storyBlock_{{ $key }}">
                                            <div class="col-md-7" style="padding-left: 20px;">
                                                <div class="custom-file">
                                                    <div id="imageSection">
                                                        <input
                                                            type="file" class="custom-file-input story_ad_img"
                                                            id="story_ad_img" name="storyAdMedia[{{ $story['media_id'] }}]" accept="video/*,image/*"
                                                            onchange="loadFile('storyImgLoad{{ $key }}')">
                                                        <label class="custom-file-label" for="story_ad_img">Choose file</label>
                                                        {{-- hidden --}}
                                                        <input type="hidden" name="storyAdMedia[{{ $story['media_id'] }}]" value="{{ $story['media_link'] }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 pl-0 pr-0 text-center">
                                                <div>
                                                    <a href="javascript:void(0)" type="button" class="btn btn-outline-primary" id="previewStoryButton" onclick="nativeAdEditPreview('story', '{{ $title }}', '{{ asset($story['media_link']) }}', '', '', '{{ asset($story['referal_link']) }}')"><i class="fe fe-smartphone"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="url" id="inputAdvFeedLink{{ $key }}" name="storyAdRefLink[{{ $story['media_id'] }}]" placeholder="Enter Referal Link" class="form-control" value="{{ $story['referal_link'] }}">
                                            </div>
                                            <span style="cursor: pointer;margin-top: 8px;position:absolute;" onclick="fnRemoveStory({{ $key }})">
                                                <i class="fa fa-close"></i>
                                            </span>
                                            <img src="{{ asset($story['media_link']) }}" id="storyImgLoad{{ $key }}" width="10%" height="auto">
                                        </div>
                                    @endforeach
                                    </div>
                                    <div class="addButton">
                                        <a  class="btn btn-info text-white" id="addInputStoryField">
                                            <i class="icon-plus"></i> Add more link
                                        </a>
                                    </div>
                                    @else
                                    <div class="form-group" id="imageSectionStory">
                                        <div class="form-row storyBlock">
                                            <div class="col-md-7">
                                                <label class="control-label">Upload Image/Video</label>
                                                <div class="custom-file">
                                                    <div id="imageSection">
                                                        <input  type="file" class="custom-file-input story_ad_img"
                                                            id="story_ad_img" name="storyAdMedia[]" accept="video/*,image/*" onchange="loadFile('storyImgLoad0')">
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
                                                <input type="url" id="storyLinkId" name="storyAdRefLink[]" placeholder="Enter Referal Link" class="form-control">
                                            </div>
                                            <img src="" id="storyImgLoad0" width="10%" height="auto">
                                        </div>
                                    </div>
                                    <div class="addButton">
                                        <a  class="btn btn-info text-white" id="addInputStoryField">
                                            <i class="icon-plus"></i> Add more link
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div id="bannerMediaParent">
                                <h5 style="cursor: context-menu;" class="text-center">Banner Media</h5>
                                <div class="bannnerMediaSection">
                                    @if (isset($advertisement['Banner']))
                                    <div class="form-group margin-bottom-minus-10" id="bannerTitleSection">
                                        <div class="form-row bannerItems">
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
                                    </div>
                                    <div class="form-group" id="bannerSection">
                                    @foreach($advertisement['Banner'] as $key => $banner)
                                        <div class="form-row bannerAdBlock mt-2" id="bannerBlock_{{ $key }}">
                                            <div class="col-md-4" style="padding-left: 20px;">
                                                <div class="custom-file">
                                                    <div id="imageSection">
                                                        <input
                                                            type="file" class="custom-file-input banner_ad_img"
                                                            id="banner_ad_img{{ $key }}" name="bannerAdImg[{{ $banner['media_id'] }}]" accept="image/*"
                                                            onchange="loadFile('bannerImgLoad{{ $key }}')">
                                                        <label class="custom-file-label" for="banner_ad_img">Choose file</label>
                                                        {{-- hidden --}}
                                                        <input type="hidden" name="bannerAdImg[{{ $banner['media_id'] }}]" value="{{ $banner['media_link'] }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-1 pl-0 pr-0 text-center">
                                                <div>
                                                    <a href="javascript:void(0)" type="button" class="btn btn-outline-primary" id="previewBannerButton" onclick="nativeAdEditPreview('banner', '', '{{ asset($banner['media_link']) }}', '', '{{ $banner['position'] }}', '{{ $banner['referal_link'] }}')"><i class="fe fe-smartphone"></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="controls">
                                                    <select class="form-control bannerAdType banner_ad_type" name="banner_ad_type[{{ $banner['media_id'] }}]" id="banner_ad_type{{ $key }}" onchange="percentCheckByAdType({{ $key }}, this.value)">
                                                        <option value="">Select Type</option>
                                                        <option value="1" {{ $banner['ad_type'] == 1 ? 'selected' : '' }}>Promotions</option>
                                                        <option value="2" {{ $banner['ad_type'] == 2 ? 'selected' : '' }}>Bons Plans</option>
                                                        <option value="3" {{ $banner['ad_type'] == 3 ? 'selected' : '' }}>Codes Promo</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="url" id="inputAdvFeedLink{{ $key }}" name="bannerAdRefLink[{{ $banner['media_id'] }}]" placeholder="Enter Referal Link" class="form-control" value="{{ $banner['referal_link'] }}">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="number" id="bannerAdPercent{{ $key }}" name="bannerAdPercent[{{ $banner['media_id'] }}]" placeholder="Enter time percent" class="form-control bannerAdPercent" min="1" value="{{ $banner['time_percent'] }}"
                                                onkeyup="bannerAdPercentCalculation(this, {{ $key }})">
                                            </div>
                                            {{--  <div class="col-md-2">
                                                <input type="number" id="bannerAdPosition{{ $key }}" name="bannerAdPosition[{{ $banner['media_id'] }}]" class="form-control bannerAdPosition" min="1" placeholder="Position" value="{{ $banner['position'] }}" onkeyup="fnCheckBannerAdPosition({{ $key }})">
                                                <span class="mt-1 text-danger" id="bannerPosError{{ $key }}"></span>
                                            </div>  --}}
                                            <span style="cursor: pointer;margin-top: 8px;position:absolute;" onclick="fnRemoveBanner({{ $key }})">
                                                <i class="fa fa-close"></i>
                                            </span>
                                            <img src="{{ asset($banner['media_link']) }}" id="bannerImgLoad{{ $key }}" width="10%" height="auto">
                                        </div>
                                    @endforeach
                                    </div>
                                    <div class="addButton">
                                        <a  class="btn btn-info text-white" id="addInputBannerField">
                                            <i class="icon-plus"></i> Add more link
                                        </a>
                                    </div>
                                    @else
                                    <div class="form-group" id="bannerSection">
                                        <div class="form-row bannerItems">
                                            <div class="col-md-4">
                                                <label class="control-label">Upload Image</label>
                                                <div class="custom-file">
                                                    <div id="imageSection">
                                                        <input
                                                            type="file" class="custom-file-input banner_ad_img"
                                                            id="banner_ad_img0" name="bannerAdImg[]" accept="image/*"
                                                            onchange="loadFile('bannerImgLoad0')">
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
                                                    <a href="javascript:void(0)" type="button" class="btn btn-outline-primary" onclick="fnPreviewBannerAd(0)"><i class="fe fe-smartphone"></i></a>
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
                                                <input type="url" id="inputAdvFeedLink0" name="bannerAdRefLink[]" placeholder="Enter Referal Link" class="form-control" value="">
                                            </div>
                                            <div class="col-md-2">
                                                <label for="">Percent</label>
                                                <input type="number" id="bannerAdPercent0" name="bannerAdPercent[]" placeholder="Enter time percent" class="form-control nativePercent bannerAdPercent" min="1" value=""
                                                onkeyup="bannerAdPercentCalculation(this, 0)">
                                            </div>
                                            {{--  <div class="col-md-2">
                                                <label class="control-label">Position</label>
                                                <div class="controls">
                                                    <input type="number" id="bannerAdPosition1" name="bannerAdPosition[]" class="form-control" min="1" placeholder="Ad position" onkeyup="fnCheckBannerAdPosition(1)">
                                                </div>
                                                <span class="mt-1 text-danger" id="bannerPosError1"></span>
                                            </div>  --}}
                                            <img src="" id="bannerImgLoad0" width="10%" height="auto">
                                        </div>
                                    </div>
                                    <div class="addButton">
                                        <a  class="btn btn-info text-white" id="addInputBannerField">
                                            <i class="icon-plus"></i> Add more link
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div id="homeBannerParent">
                                <h5 style="cursor: context-menu;" class="text-center">Home Banner</h5>
                                <div class="storyMediaSection">
                                    @if (isset($advertisement['Home Banner']))
                                    <div class="form-group margin-bottom-minus-10" id="storyTitleSection">
                                        <div class="form-row storyBlock">
                                            <div class="col-md-6">
                                                <label class="control-label">Upload Image/Video</label>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="">Reference Url</label>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label">Position</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="imageSectionHomeBanner">
                                    @foreach($advertisement['Home Banner'] as $key => $banner)
                                        <div class="form-row mt-2 homeBannerBlock" id="homeBannerBlock_{{ $key }}">
                                            <div class="col-md-6 margin-bottom-minus-10 mb-2" style="padding-left: 20px;">
                                                <div class="custom-file">
                                                    <div id="homeBannerImageSection">
                                                        <input  type="file" class="custom-file-input home_banner_img"
                                                            id="home_banner_img{{ $key }}" name="homeBannerMedia[{{ $banner['media_id'] }}]" accept="image/*" onchange="loadFile('homeBannerImgLoad{{ $key }}')">
                                                        <label class="custom-file-label" for="home_banner_img">Choose file</label>
                                                        {{-- hidden --}}
                                                        <input type="hidden" name="homeBannerMedia[{{ $banner['media_id'] }}]" value="{{ $banner['media_link'] }}">
                                                    </div>
                                                    <span class="help-inline alert-danger">{{ $errors->first('homeBannerMedia') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="url" id="homeBannerId{{ $key }}" name="homeBannerRefLink[{{ $banner['media_id'] }}]" placeholder="Enter Referal Link" class="form-control" value="{{ $banner['referal_link'] }}">
                                            </div>
                                            <div class="col-md-2">
                                                <div class="controls">
                                                    <input type="number" id="homeBannerAdPosition{{ $key }}" name="homeBannerAdPosition[{{ $banner['media_id'] }}]" class="form-control homeBannerAdPosition" min="1" placeholder="Ad position"
                                                    value="{{ $banner['position'] }}">
                                                </div>
                                            </div>
                                            <span style="cursor: pointer;margin-top: 8px;position:absolute;" onclick="fnRemoveHomeBanner({{ $key }})">
                                                <i class="fa fa-close"></i>
                                            </span>
                                            <img src="{{ asset($banner['media_link']) }}" id="homeBannerImgLoad{{ $key }}" width="10%" height="auto">
                                        </div>
                                    @endforeach
                                    </div>
                                    <span class="mt-5 text-info">Note: At most Two banner can be add.</span>
                                    <div class="addButton" id="homeBannerAddButtonUpdate">
                                        <a  class="btn btn-info text-white" id="addInputHomeBannerFieldUpdate">
                                            <i class="icon-plus"></i> Add more link
                                        </a>
                                    </div>
                                    @else
                                    <div class="form-group" id="imageSectionHomeBanner">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label class="control-label">Upload Image/Video</label>
                                                <div class="custom-file">
                                                    <div id="imageSection">
                                                        <input  type="file" class="custom-file-input story_ad_img"
                                                            id="story_ad_img" name="homeBannerMedia[]" accept="video/*,image/*" onchange="loadFile('homeBannerImgLoad0')">
                                                        <label class="custom-file-label" for="story_ad_img">Choose file</label>
                                                    </div>
                                                    <span class="help-inline alert-danger">{{ $errors->first('homeBannerMedia') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="">Reference Url</label>
                                                <input type="url" id="storyLinkId" name="homeBannerRefLink[]" placeholder="Enter Referal Link" class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label">Position</label>
                                                <div class="controls">
                                                    <input type="number" id="homeBannerAdPosition0" name="homeBannerAdPosition[]" class="form-control homeBannerAdPosition" min="1" placeholder="Ad position">
                                                </div>
                                            </div>
                                            <img src="" id="homeBannerImgLoad0" width="10%" height="auto">
                                        </div>
                                    </div>
                                    <span class="mt-5 text-info">Note: At most Two banner can be add.</span>
                                    <div class="addButton" id="homeBannerAddButton">
                                        <a  class="btn btn-info text-white" id="addInputHomeBannerField">
                                            <i class="icon-plus"></i> Add more link
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div id="rewardMediaParent">
                                <h5 style="cursor: context-menu;" class="text-center">Reward Media</h5>
                                <div class="rewardMediaSection">
                                    @if (isset($advertisement['Reward']))
                                    <div class="form-group margin-bottom-minus-10" id="rewardTitleSection">
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
                                    </div>
                                    <div class="form-group rewardSection" id="rewardSection">
                                    @foreach($advertisement['Reward'] as $key => $reward)
                                        <div class="form-row rewardBlock mt-2" id="rewardBlock_{{ $key }}">
                                            <div class="col-md-5" style="padding-left: 20px;">
                                                <div class="custom-file">
                                                    <div id="imageSection">
                                                        <input
                                                            type="file" class="custom-file-input reward_ad_media"
                                                            id="reward_ad_media" name="rewardAdMedia[{{ $reward['media_id'] }}]" accept="video/*,image/*" value="{{ $reward['media_link'] }}">
                                                        <label class="custom-file-label" for="reward_ad_media">Choose file</label>
                                                        {{-- hidden --}}
                                                        <input type="hidden" name="rewardAdMedia[{{ $reward['media_id'] }}]" value="{{ $reward['media_link'] }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="url" id="inputAdvFeedLink{{ $key }}" name="rewardAdRefLink[{{ $reward['media_id'] }}]" placeholder="Enter Referal Link" class="form-control" value="{{ $reward['referal_link'] }}">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="number" id="adv_position_slot" name="rewardAdReward[{{ $reward['media_id'] }}]" class="form-control" min="1" placeholder="Reward" value="{{ $reward['reward'] }}">
                                            </div>
                                            <span style="cursor: pointer;margin-top: 8px;position:absolute;" onclick="fnRemoveReward({{ $key }})">
                                                <i class="fa fa-close"></i>
                                            </span>
                                            <img src="{{ asset($reward['media_link']) }}"  width="10%" height="auto">
                                        </div>
                                    @endforeach
                                    </div>
                                    <div class="addButton">
                                        <a  class="btn btn-info text-white" id="addInputRewardField">
                                            <i class="icon-plus"></i> Add more link
                                        </a>
                                    </div>
                                    @else
                                    <div class="form-group" id="rewardSection">
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
                                    </div>
                                    <div class="addButton">
                                        <a  class="btn btn-info text-white" id="addInputRewardField">
                                            <i class="icon-plus"></i> Add more link
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('adv.list') }}" class="btn btn-default mr-2">Back</a>
                {{-- <button type="button" class="btn btn-primary" id="btnSubmitCampaign">Save</button> --}}
                <button type="button" class="btn btn-info btnValidation" id="btnUpdateCampaign">Update</button>
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

    <script type="text/javascript" src="{{ asset('assets/old-js/commonAdvertise.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/old-js/updateadvertisement.js') }}"></script>

    <script src="{{ asset('assets/old-js/index.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/old-js/moment.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/old-js/boostrap-datetime.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/old-js/timepicker.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            display_serverTime();
        });

        //date picker
        $('#inputEndDate').bootstrapMaterialDatePicker({ weekStart : 0, time: false, format : 'DD-MM-YYYY' });
        $('#inputStartDate').bootstrapMaterialDatePicker({ weekStart : 0, time: false, minDate: moment(), format : 'DD-MM-YYYY' }).on('change', function(e, date)
        {
            $('#inputEndDate').bootstrapMaterialDatePicker('setMinDate', date);
        });

        $('#inputStartTime').blur(function () {
            checkTimeSlot("{{ route('adv.check.timeslot') }}", {{ $campaign_id }});
        });

        $('#inputEndTime').blur(function () {
            checkTimeSlot("{{ route('adv.check.timeslot') }}", {{ $campaign_id }});
        });

    </script>
@endsection
