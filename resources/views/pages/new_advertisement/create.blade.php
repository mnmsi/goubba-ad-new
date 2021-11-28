@extends('layouts.base')
@section('title', 'Create Campaign')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/form-wizard/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/form-wizard/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/form-wizard/css/style.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/form-wizard/css/fontawesome-all.css') }}">

    <link href="{{ asset('assets/old-css/boostrap-datetime.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/old-css/timepicker.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/old-css/daterangepicker.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/old-css/bootstrap-multiselect.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/css/new.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/mobile.css') }}">
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
    <div id="mydiv">
        <div id="mydivheader" class="rounded-pill">Available users: {{ $totalUsers }}</div>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="wrapper">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-2">
                        <div class="steps-area steps-area-fixed bg-step-color" style="position: static">
                            <div class="image-holder" style="height: 800px">
                                <img src="{{ asset('assets/form-wizard/img/luke-chesser-3rWagdKBF7U-unsplash.jpg') }}" alt="">
                            </div>
                            <div class="steps clearfix">
                                <ul class="tablist multisteps-form__progress">
                                    <li class="multisteps-form__progress-btn js-active current">
                                        <span>1</span>
                                    </li>
                                    <li class="multisteps-form__progress-btn">
                                        <span>2</span>
                                    </li>
                                    <li class="multisteps-form__progress-btn">
                                        <span>3</span>
                                    </li>
                                    <li class="multisteps-form__progress-btn last">
                                        <span>4</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-10 overflow-auto">
                        <form action="{{ route('adv.store') }}" class="multisteps-form__form" id="wizard" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-area position-relative">
                                <!-- div 1 -->
                                <div class="multisteps-form__panel js-active" data-animation="slideHorz" id="fields-step-1">
                                    <div class="wizard-forms">
                                        <div class="inner clearfix">
                                            <div class="form-content pera-content">
                                                <div class="step-inner-content">
                                                    <div class="row">
                                                        <div class="col-12 pb-md-5">
                                                            <span class="step-no bottom-line">Step 1</span>
                                                            <div class="step-progress float-right">
                                                                <span>1 of 4 completed</span>
                                                                <div class="step-progress-bar">
                                                                    <div class="progress">
                                                                        <div class="progress-bar" style="width: 25%"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="step-box">
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Brand Name</label>
                                                                    <input type="text" id="brand_title" name="brand_title" placeholder="Enter Brand Name" class="form-control required"  value="{{ old('brand_title') }}" required>
                                                                    @if($errors->has('brand_title'))
                                                                        <p class="statusDanger text-danger error-msg">{{ $errors->first('brand_title') }}</p>
                                                                    @endif
                                                                </div>

                                                                @if (Auth::user()->role_id == 1)
                                                                <div class="form-group">
                                                                    <label class="control-label">User</label>
                                                                    <select class="form-control select2 required" data-placeholder="Choose one" id="user_id" name="user_id" required>
                                                                        <option label="Select User"></option>
                                                                        @if (count($CadUsers) > 0)
                                                                            @foreach($CadUsers as $CadUser)
                                                                                <option value="{{ $CadUser->id }}" {{ old('user_id') == $CadUser->id  ? 'selected' : ''}}>{{ $CadUser->business_name}}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                    @if($errors->has('user_id'))
                                                                        <p class="statusDanger text-danger error-msg">{{ $errors->first('user_id') }}</p>
                                                                    @endif
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="control-label">Active Status</label>
                                                                    <select class="form-control select2 required" data-placeholder="Choose one" id="is_active" name="is_active" required>
                                                                        <option value="">Select Active Status</option>
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
                                                                        {{--  {{ old('is_active') == 'pending'  ? 'selected' : ''}}  --}}
                                                                            <option
                                                                                value="pending" selected>
                                                                                pending
                                                                            </option>
                                                                        @endif
                                                                    </select>
                                                                    @if($errors->has('user_id'))
                                                                        <p class="statusDanger text-danger error-msg">{{ $errors->first('user_id') }}</p>
                                                                    @endif
                                                                </div>
                                                                @endif
                                                            </div>
                                                            <div class="col-sm-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Brand Logo</label>
                                                                    <input type="file" class="dropify form-control required" data-height="185" accept="image/*" value="{{ old('brand_logo') }}" id="brand_logo" name="brand_logo" required />
                                                                    @if($errors->has('brand_logo'))
                                                                        <p class="statusDanger text-danger error-msg">{{ $errors->first('brand_logo') }}</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">Advertisement Type</label>
                                                                    <div class="controls">
                                                                        <select class="form-control select2 required" data-placeholder="Choose one" name="adv_type" id="adv_type">
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
                                                                {{-- <strong class="text-info">Available users: {{ $totalUsers }}</strong> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.inner -->
                                        <div class="actions">
                                            <ul>
                                                <li class="disable" aria-disabled="true"><span class="js-btn-next" title="NEXT">Backward <i class="fa fa-arrow-right"></i></span></li>
                                                <li><span class="js-btn-next" id="btn-next-1" title="NEXT">NEXT <i class="fa fa-arrow-right"></i></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- div 2 -->
                                <div class="multisteps-form__panel" data-animation="slideHorz">
                                    <div class="wizard-forms">
                                        <div class="inner clearfix">
                                            <div class="form-content pera-content">
                                                <div class="step-inner-content">
                                                    <div class="row">
                                                        <div class="col-12 pb-md-5">
                                                            <span class="step-no bottom-line">Step 2</span>
                                                            <div class="step-progress float-right">
                                                                <span>2 of 4 completed</span>
                                                                <div class="step-progress-bar">
                                                                    <div class="progress">
                                                                        <div class="progress-bar" style="width: 50%"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Campaign Name</label>
                                                                <input type="text" id="inputCampaignName" name="campaign_name" placeholder="Enter Campaign Name" class="form-control required"  value="{{ old('campaign_name') }}">
                                                                @if($errors->has('campaign_name'))
                                                                    <p class="statusDanger text-danger error-msg">{{ $errors->first('campaign_name') }}</p>
                                                                @endif
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">Campaign Type</label>
                                                                <select class="form-control select2 required" data-placeholder="Choose one" name="adv_campaign[]" data-placeholder="Choose one">
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
                                                                <label class="control-label">Daily Impression</label>
                                                                <input type="number" id="inputDailyImpression" name="daily_impression" class="form-control required" min="1" value="{{ old('daily_impression') }}">
                                                                @if($errors->has('daily_impression'))
                                                                    <span class="statusDanger text-danger error-msg">{{ $errors->first('daily_impression') }}</span>
                                                                @endif
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">Start Date</label>
                                                                <input id="inputStartDate" name="start_date" class="form-control required" value="{{ old('start_date') }}" placeholder="Please select start date">
                                                                @if($errors->has('start_date'))
                                                                    <span class="statusDanger text-danger error-msg">{{ $errors->first('start_date') }}</span>
                                                                @endif
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="label-control">Start Time</label>
                                                                <input type="text" id="inputStartTime" name="start_time" class="form-control timepicker timeKeydown required" value="{{ old('start_time') }}" placeholder="Please select start time" required>
                                                                @if($errors->has('start_time'))
                                                                    <span class="statusDanger text-danger error-msg">{{ $errors->first('start_time') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Title</label>
                                                                <input type="text" id="title" name="title" placeholder="Enter Advertisement Title" class="form-control required"  value="{{ old('title') }}">
                                                                @if($errors->has('title'))
                                                                    <p class="statusDanger text-danger error-msg">{{ $errors->first('title') }}</p>
                                                                @endif
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">Budget</label>
                                                                <div class="controls">
                                                                    <input type="number" id="inputBudget" name="budget" class="form-control number-input required" value="{{ old('budget') }}" min="1">
                                                                    <span class="help-inline alert-danger">{{ $errors->first('inputBudget') }}</span>
                                                                </div>
                                                                @if($errors->has('budget'))
                                                                    <p class="statusDanger text-danger error-msg">{{ $errors->first('budget') }}</p>
                                                                @endif
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">Lifetime Impression</label>
                                                                <input type="number" id="inputLifetimeImpression" name="lifetime_impression" class="form-control number-input required" min="1" value="{{ old('lifetime_impression') }}">
                                                                @if($errors->has('lifetime_impression'))
                                                                    <span class="statusDanger text-danger error-msg">{{ $errors->first('lifetime_impression') }}</span>
                                                                @endif
                                                                <span id="impressionValidation" class="statusDanger text-danger error-msg" style="display: none;">Daily impression & Lifetime impression can't be equal!</span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">End Date</label>
                                                                <input id="inputEndDate" name="end_date" class="form-control required" value="{{ old('end_date') }}" placeholder="Please select end date">
                                                                @if($errors->has('end_date'))
                                                                    <span class="statusDanger text-danger error-msg">{{ $errors->first('end_date') }}</span>
                                                                @endif
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">End Time</label>
                                                                <input type="text" id="inputEndTime" name="end_time" class="form-control  timepicker timeKeydown required" value="{{ old('end_time') }}" placeholder="Please select start time">
                                                                @if($errors->has('end_time'))
                                                                    <span class="statusDanger text-danger error-msg">{{ $errors->first('end_time') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label class="control-label">Description</label>
                                                                <textarea class="form-control required" rows="2" name="desc" style="height: 63px">{{ old('desc') }}</textarea>
                                                                @if($errors->has('desc'))
                                                                    <p class="statusDanger text-danger error-msg">{{ $errors->first('desc') }}</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.inner -->
                                        <div class="actions">
                                            <ul>
                                                <li><span class="js-btn-prev" title="BACK"><i class="fa fa-arrow-left"></i> BACK </span></li>
                                                <li><span class="js-btn-next" title="NEXT">NEXT <i class="fa fa-arrow-right"></i></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- div 3 -->
                                <div class="multisteps-form__panel" data-animation="slideHorz">
                                    <div class="wizard-forms">
                                        <div class="inner clearfix">
                                            <div class="form-content pera-content">
                                                <div class="step-inner-content">
                                                    <div class="row">
                                                        <div class="col-12 pb-md-5">
                                                            <span class="step-no bottom-line">Step 3</span>
                                                            <div class="step-progress float-right">
                                                                <span>3 of 4 completed</span>
                                                                <div class="step-progress-bar">
                                                                    <div class="progress">
                                                                        <div class="progress-bar" style="width:75%"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Select Country</label>
                                                                <div class="controls">
                                                                    <select class="form-control select2 required" data-placeholder="Choose one" name="country_id" id="adv_country">
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

                                                            <div class="form-group">
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

                                                        <div class="col-sm-12 col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Favorite Store</label>
                                                                <select class="multi-select" id="favorite_store" name="favorite_store_ids[]" multiple>
                                                                    @foreach($favoriteStores as $store)
                                                                        <option value="{{ $store->id}}"
                                                                            {{ !empty(old('favorite_store_ids')) ? (in_array($store->id, old('favorite_store_ids')) ? 'selected' : '') : 'selected'}}
                                                                            >{{ $store->name}}</option>
                                                                    @endforeach
                                                                </select>
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
                                                                    <div class="col-6 col-md-6 mb-3">
                                                                        <input type="number" id="inputAgeMin" name="min_age" class="form-control required" placeholder="Min age" max="100" value="{{ old('min_age', 0) }}">
                                                                        @if($errors->has('min_age'))
                                                                            <p class="statusDanger text-danger error-msg">{{ $errors->first('min_age') }}</p>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-6 col-md-6 mb-3">
                                                                        <input type="number" id="inputAgeMax" name="max_age" class="form-control required" placeholder="Max age" max="100" value="{{ old('max_age', 99) }}">
                                                                        @if($errors->has('max_age'))
                                                                            <p class="statusDanger text-danger error-msg">{{ $errors->first('max_age') }}</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <span id="ageValidation" class="statusDanger text-danger error-msg" style="display: none;">Max age must be greater then min age.</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ./inner -->
                                        <div class="actions">
                                            <ul>
                                                <li><span class="js-btn-prev" title="BACK"><i class="fa fa-arrow-left"></i> BACK </span></li>
                                                <li><span class="js-btn-next" title="NEXT">NEXT <i class="fa fa-arrow-right"></i></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- div 4 -->
                                <div class="multisteps-form__panel" data-animation="slideHorz">
                                    <div class="wizard-forms">
                                        <div class="inner clearfix">
                                            <div class="form-content pera-content">
                                                <div class="step-inner-content">
                                                    <div class="row">
                                                        <div class="col-12 pb-md-5">
                                                            <span class="step-no bottom-line">Step 4</span>
                                                            <div class="step-progress float-right">
                                                                <span>4 of 4 completed</span>
                                                                <div class="step-progress-bar">
                                                                    <div class="progress">
                                                                        <div class="progress-bar" style="width:100%"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="form-group ">
                                                                <label class="form-label">Category</label>
                                                                <div class="selectgroup selectgroup-pills">
                                                                    @if (count($CadAdvertisementCategories) > 0)
                                                                        @foreach($CadAdvertisementCategories as $key => $CadAdvertisementCategorie)
                                                                        <label class="selectgroup-item">
                                                                            <input type="checkbox" name="adv_cat[]"
                                                                            class="selectgroup-input form-control" id="advCat_{{ $key }}" value="{{ $CadAdvertisementCategorie->advertisement_category_id }}" {{ !empty(old('adv_cat')) ? (in_array($CadAdvertisementCategorie->advertisement_category_id, old('adv_cat')) ? 'checked' : '') : ''}} onClick="fnCategoryClick(this)">

                                                                            <span class="selectgroup-button">{{ $CadAdvertisementCategorie->advertisement_categories_name}}</span>
                                                                        </label>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

        <div class="col-12">
            <div id="feedMediaParent">
                <h5 style="cursor: context-menu;" class="text-center">Native Ad</h5>
                <div class="feedMediaSection p-0">
                    <div class="form-group" id="imageSectionFeed">
                        @if(!empty(old('native_ad_type')))
                        <div class="row">
                            @for($i = 0; $i < count(old('native_ad_type')); $i++)
                            <div class="col-sm-12 col-md-8" id="native_ads">
                                <div class="count_native_ads gradient-box p-md-2 p-sm-1" style="border: 1px solid rgba(83, 16, 240, 0.57);" id="nativeAd_{{ $i }}">

                                    <a href="javascript:void(0)" class="float-right native_remove_btn" onclick="fnRemoveNativeAd({{ $i }})" style="display: none"><i class="fa fa-close"></i></a>

                                    <div class="form-group">
                                        <label class="control-label">Upload Image</label>
                                        <input type="file" class="dropify form-control required" data-height="185" accept="image/*" id="native_ad_img{{ $i }}" name="nativeAdImg[]" onchange="validateNative({{ $i }})" required />
                                        @if($errors->has('nativeAdImg'))
                                            <p class="statusDanger text-danger error-msg">{{ $errors->first('nativeAdImg') }}</p>
                                        @endif
                                    </div>

                                    <div class="form-row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Ad Type</label>
                                                <div class="controls">
                                                    <select class="form-control nativeAdType native_ad_type required" name="native_ad_type[]" id="native_ad_type{{ $i }}" required onchange="percentCheckByAdTypeNative({{ $i }}, this.value);validateNative({{ $i }});">
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
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="">Reference Url</label>
                                                <input type="text" id="nativeAdRefLink{{ $i }}" name="nativeAdRefLink[]" placeholder="Enter Referal Link" class="form-control required" value="{{ old('nativeAdRefLink')[$i] }}" onblur="validateNative({{ $i }});">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Percent</label>
                                                <input type="number" id="nativeAdPercent{{ $i }}" name="nativeAdPercent[]" placeholder="Enter time percent" class="form-control required inputAdvFeedShowTime nativeAdPercent" min="1" value="{{ old('native_ad_type')[$i] }}"
                                                onkeyup="nativeAdPercentCalculation(this, {{ $i }});validateNative({{ $i }});" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="control-label">Position</label>
                                                <div class="controls">
                                                    <input type="number" id="adv_position_slot{{ $i }}" name="nativeAdPosition[]" class="form-control nativeAdPosition required" min="1" placeholder="Ad position" value="{{ old('nativeAdPosition')[$i] }}" onkeyup="validateNative({{ $i }})" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor
                            <div class="col-sm-12 col-md-4 m-auto">
                                <div class="phone view_3" id="phoneNative">
                                    <div class="loader" id="previewLoaderNative" style="display: none"></div>
                                    <iframe id="phone-iframe-native-ad"></iframe>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="row">
                            <div class="col-sm-12 col-md-8" id="native_ads">
                                <div class="count_native_ads gradient-box p-md-2 p-sm-1" style="border: 1px solid rgba(83, 16, 240, 0.57);" id="nativeAd_0">

                                    <a href="javascript:void(0)" class="float-right native_remove_btn" onclick="fnRemoveNativeAd(0)" style="display: none"><i class="fa fa-close"></i></a>

                                    <div class="form-group">
                                        <label class="control-label">Upload Image</label>
                                        <input type="file" class="dropify form-control required" data-height="185" accept="image/*" value="{{ old('brand_logo') }}" id="native_ad_img0" name="nativeAdImg[]" onchange="validateNative(0)" required />
                                        @if($errors->has('brand_logo'))
                                            <p class="statusDanger text-danger error-msg">{{ $errors->first('brand_logo') }}</p>
                                        @endif
                                    </div>

                                    <div class="form-row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Ad Type</label>
                                                <div class="controls">
                                                    <select class="form-control nativeAdType native_ad_type required" name="native_ad_type[]" id="native_ad_type0" required onchange="percentCheckByAdTypeNative(0, this.value);validateNative(0);">
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
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="">Reference Url</label>
                                                <input type="text" id="nativeAdRefLink0" name="nativeAdRefLink[]" placeholder="Enter Referal Link" class="form-control required" value="" onblur="validateNative(0)">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="">Percent</label>
                                                <input type="number" id="nativeAdPercent0" name="nativeAdPercent[]" placeholder="Enter time percent" class="form-control required inputAdvFeedShowTime nativeAdPercent" min="1" value="100"
                                                onkeyup="nativeAdPercentCalculation(this, 0);validateNative(0);" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="control-label">Position</label>
                                                <div class="controls">
                                                    <input type="number" id="adv_position_slot0" name="nativeAdPosition[]" class="form-control nativeAdPosition required" min="1" placeholder="Ad position" onkeyup="validateNative(0)" required>
                                                    {{-- onkeyup="fnCheckNativeAdPosition(0)" --}}
                                                </div>
                                                <span class="mt-1 text-danger" id="positionError0"></span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label-control">Start Time</label>
                                                <input type="text" id="nativeStartTime0" name="start_time_native[]" class="form-control timepicker timeKeydown required" value="{{ old('start_time') }}" placeholder="Please select start time" required>
                                                @if($errors->has('start_time'))
                                                    <span class="statusDanger text-danger error-msg">{{ $errors->first('start_time') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">End Time</label>
                                                <input type="text" id="nativeEndTime0" name="end_time_native[]" class="form-control timepicker timeKeydown required" value="{{ old('end_time') }}" placeholder="Please select start time" required>
                                                @if($errors->has('end_time'))
                                                    <span class="statusDanger text-danger error-msg">{{ $errors->first('end_time') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 m-auto">
                                <div class="phone view_3" id="phoneNative">
                                    <div class="loader" id="previewLoaderNative" style="display: none"></div>
                                    <iframe id="phone-iframe-native-ad"></iframe>
                                </div>
                            </div>
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

            <div id="storyMediaParent">
                <h5 style="cursor: context-menu;" class="text-center">Story Ad</h5>
                <div class="storyMediaSection">
                    <div class="form-group" id="imageSectionStory">
                        @if(!empty(old('storyAdRefLink')))
                        <div class="row">
                            @for($i = 0; $i < count(old('storyAdRefLink')); $i++)
                            <div class="col-sm-12 col-md-8" id="story_ads">

                                <div class="count_story_ads p-md-2 p-sm-1" style="border: 1px solid rgba(83, 16, 240, 0.57)" id="storyBlock_{{ $i }}">

                                    <a href="javascript:void(0)" class="story_remove_btn float-right" onclick="fnRemoveStory({{ $i }})" style="display: none"><i class="fa fa-close"></i></a>

                                    <div class="form-group">
                                        <label class="control-label">Upload Image/Video</label>
                                        <input type="file" class="dropify form-control required" data-height="185" accept="image/*" value="" id="story_ad_img{{ $i }}" name="storyAdMedia[]"
                                        onchange="validateStory({{ $i }})" />
                                    </div>

                                    <div class="form-group">
                                        <label for="">Reference Url</label>
                                        <input type="text" id="storyLinkId{{ $i }}" name="storyAdRefLink[]" placeholder="Enter Referal Link" class="form-control required" value="{{ old('storyAdRefLink')[$i] }}" onkeyup="validateStory({{ $i }})">
                                    </div>
                                </div>
                            </div>
                            @endfor
                            <div class="col-sm-12 col-md-4 m-auto">
                                <div class="phone view_3" id="phoneStory">
                                    <div class="loader" id="previewLoaderStory"></div>
                                    <iframe id="phone-iframe-story-ad"></iframe>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="row">
                            <div class="col-sm-12 col-md-8" id="story_ads">

                                <div class="count_story_ads p-md-2 p-sm-1" style="border: 1px solid rgba(83, 16, 240, 0.57)" id="storyBlock_0">

                                    <a href="javascript:void(0)" class="story_remove_btn float-right" onclick="fnRemoveStory(0)" style="display: none"><i class="fa fa-close"></i></a>

                                    <div class="form-group">
                                        <label class="control-label">Upload Image/Video</label>
                                        <input type="file" class="dropify form-control required" data-height="185" accept="image/*" value="" id="story_ad_img0" name="storyAdMedia[]"
                                        onchange="validateStory(0)" />
                                    </div>

                                    <div class="form-group">
                                        <label for="">Reference Url</label>
                                        <input type="text" id="storyLinkId0" name="storyAdRefLink[]" placeholder="Enter Referal Link" class="form-control required" onkeyup="validateStory(0)">
                                    </div>

                                    {{-- <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label-control">Start Time</label>
                                                <input type="text" id="inputStartTime" name="start_time" class="form-control timepicker timeKeydown required" value="{{ old('start_time') }}" placeholder="Please select start time">
                                                @if($errors->has('start_time'))
                                                    <span class="statusDanger text-danger error-msg">{{ $errors->first('start_time') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">End Time</label>
                                                <input type="text" id="inputEndTime" name="end_time" class="form-control  timepicker timeKeydown required" value="{{ old('end_time') }}" placeholder="Please select start time">
                                                @if($errors->has('end_time'))
                                                    <span class="statusDanger text-danger error-msg">{{ $errors->first('end_time') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 m-auto">
                                <div class="phone view_3" id="phoneStory">
                                    <div class="loader" id="previewLoaderStory"></div>
                                    <iframe id="phone-iframe-story-ad"></iframe>
                                </div>
                            </div>
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
                <h5 style="cursor: context-menu;" class="text-center">Banner Ad</h5>
                <div class="bannnerMediaSection">
                    <div class="form-group" id="imageSectionStory">
                        @if(!empty(old('banner_ad_type')))
                        <div class="row">
                            @for($i = 0; $i < count(old('banner_ad_type')); $i++)
                            <div class="col-sm-12 col-md-8" id="banner_ads">
                                <div class="count_banner_ads p-md-2 p-sm-1" style="border: 1px solid rgba(83, 16, 240, 0.57)" id="bannerBlock_{{ $i }}">

                                    <a href="javascript:void(0)" class="banner_remove_btn float-right" onclick="fnRemoveBanner({{ $i }})" style="display: none"><i class="fa fa-close"></i></a>

                                    <div class="form-group">
                                        <label class="control-label">Upload Image</label>
                                        <input type="file" class="dropify banner_ad_img required" data-height="185" accept="image/*" value="" id="banner_ad_img{{ $i }}" name="bannerAdImg[]"
                                        onchange="validateBanner({{ $i }})" />

                                        @if($errors->has('bannerAdImg'))
                                            <p class="statusDanger text-danger error-msg">{{ $errors->first('bannerAdImg')[$i] }}</p>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="">Reference Url</label>
                                        <input type="text" id="bannerAdRefLink{{ $i }}" name="bannerAdRefLink[]" placeholder="Enter Referal Link" class="form-control required" value="{{ old('bannerAdRefLink')[$i] }}" onblur="validateBanner({{ $i }})">
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Ad Type</label>
                                                <div class="controls">
                                                    <select class="form-control bannerAdType banner_ad_type" name="banner_ad_type[]" id="banner_ad_type{{ $i }}" onchange="percentCheckByAdType({{ $i }}, this.value);validateBanner({{ $i }});">
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
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Percent</label>
                                                <input type="number" id="bannerAdPercent{{ $i }}" name="bannerAdPercent[]" placeholder="Enter time percent" class="form-control bannerAdPercent required" min="1" value="{{ old('bannerAdPercent')[$i] }}" onkeyup="bannerAdPercentCalculation(this, {{ $i }});validateBanner({{ $i }});">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor
                            <div class="col-sm-12 col-md-4 m-auto">
                                <div class="phone view_3" id="phoneBanner">
                                    <div class="loader" id="previewLoaderBanner" ></div>
                                    <iframe id="phone-iframe-banner-ad"></iframe>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="row">
                            <div class="col-sm-12 col-md-8" id="banner_ads">
                                <div class="count_banner_ads p-md-2 p-sm-1" style="border: 1px solid rgba(83, 16, 240, 0.57)" id="bannerBlock_0">

                                    <a href="javascript:void(0)" class="banner_remove_btn float-right" onclick="fnRemoveBanner(0)" style="display: none"><i class="fa fa-close"></i></a>

                                    <div class="form-group">
                                        <label class="control-label">Upload Image</label>
                                        <input type="file" class="dropify banner_ad_img required" data-height="185" accept="image/*" value="" id="banner_ad_img0" name="bannerAdImg[]"
                                        onchange="validateBanner(0)" />

                                        @if($errors->has('bannerAdImg'))
                                            <p class="statusDanger text-danger error-msg">{{ $errors->first('bannerAdImg') }}</p>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="">Reference Url</label>
                                        <input type="text" id="bannerAdRefLink0" name="bannerAdRefLink[]" placeholder="Enter Referal Link" class="form-control required" value=""
                                        onblur="validateBanner(0)">
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Ad Type</label>
                                                <div class="controls">
                                                    <select class="form-control bannerAdType banner_ad_type" name="banner_ad_type[]" id="banner_ad_type0" onchange="percentCheckByAdType(0, this.value);validateBanner(0);">
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
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Percent</label>
                                                <input type="number" id="bannerAdPercent0" name="bannerAdPercent[]" placeholder="Enter time percent" class="form-control bannerAdPercent required" min="1" value="100" onkeyup="bannerAdPercentCalculation(this, 0);validateBanner(0);">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label-control">Start Time</label>
                                                <input type="text" id="inputStartTime" name="start_time" class="form-control timepicker timeKeydown required" value="{{ old('start_time') }}" placeholder="Please select start time">
                                                @if($errors->has('start_time'))
                                                    <span class="statusDanger text-danger error-msg">{{ $errors->first('start_time') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">End Time</label>
                                                <input type="text" id="inputEndTime" name="end_time" class="form-control timepicker timeKeydown required" value="{{ old('end_time') }}" placeholder="Please select start time">
                                                @if($errors->has('end_time'))
                                                    <span class="statusDanger text-danger error-msg">{{ $errors->first('end_time') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 m-auto">
                                <div class="phone view_3" id="phoneBanner">
                                    <div class="loader" id="previewLoaderBanner" ></div>
                                    <iframe id="phone-iframe-banner-ad"></iframe>
                                </div>
                            </div>
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
                <h5 style="cursor: context-menu;" class="text-center">Home Banner Ad</h5>
                <div class="homeBannerSection">
                    <div class="form-group" id="imageSectionStory">
                        @if(!empty(old('storyAdRefLink')))
                        <div class="row">
                            @for($i = 0; $i < count(old('storyAdRefLink')); $i++)
                            <div class="col-sm-12 col-md-8" id="homeBanner_ads">

                                <div class="count_homeBanner_ads p-md-2 p-sm-1" style="border: 1px solid rgba(83, 16, 240, 0.57)" id="homeBannerBlock_0">

                                    <a href="javascript:void(0)" class="home_banner_remove_btn float-right" onclick="fnRemoveHomeBanner({{ $i }})" style="display: none"><i class="fa fa-close"></i></a>

                                    <div class="form-group">
                                        <label class="control-label">Upload Image</label>
                                        <input type="file" class="dropify form-control required" data-height="185" accept="image/*" value="" id="home_banner_img{{ $i }}" name="homeBannerMedia[]" onchange="validateHomeBanner({{ $i }})" />
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="">Reference Url</label>
                                                    <input type="text" id="homeBannerRefLinkId{{ $i }}" name="homeBannerRefLink[]" placeholder="Enter Referal Link" class="form-control required" value="{{ old('homeBannerRefLink')[$i] }}" onblur="validateHomeBanner({{ $i }})">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Position</label>
                                                <input type="number" id="homeBannerAdPosition{{ $i }}" name="homeBannerAdPosition[]" class="form-control homeBannerAdPosition required" min="1" placeholder="Ad position" value="{{ old('homeBannerAdPosition')[$i] }}" onkeyup="validateHomeBanner({{ $i }})">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor
                            <div class="col-sm-12 col-md-4 m-auto">
                                <div class="phone view_3" id="phoneHomeBanner">
                                    <div class="loader" id="previewLoaderHomeBanner"></div>
                                    <iframe id="phone-iframe-homeBanner-ad"></iframe>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="row">
                            <div class="col-sm-12 col-md-8" id="homeBanner_ads">

                                <div class="count_homeBanner_ads p-md-2 p-sm-1" style="border: 1px solid rgba(83, 16, 240, 0.57)" id="homeBannerBlock_0">

                                    <a href="javascript:void(0)" class="home_banner_remove_btn float-right" onclick="fnRemoveHomeBanner(0)" style="display: none"><i class="fa fa-close"></i></a>

                                    <div class="form-group">
                                        <label class="control-label">Upload Image</label>
                                        <input type="file" class="dropify form-control required" data-height="185" accept="image/*" value="" id="home_banner_img0" name="homeBannerMedia[]"
                                        onchange="validateHomeBanner(0)" />
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="">Reference Url</label>
                                                    <input type="text" id="homeBannerRefLinkId0" name="homeBannerRefLink[]" placeholder="Enter Referal Link" class="form-control required" value="{{ old('homeBannerRefLink') }}"
                                                    onblur="validateHomeBanner(0)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Position</label>
                                                <input type="number" id="homeBannerAdPosition0" name="homeBannerAdPosition[]" class="form-control homeBannerAdPosition required" min="1" placeholder="Ad position"
                                                onkeyup="validateHomeBanner(0)">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label-control">Start Time</label>
                                                <input type="text" id="inputStartTime" name="start_time" class="form-control timepicker timeKeydown required" value="{{ old('start_time') }}" placeholder="Please select start time">
                                                @if($errors->has('start_time'))
                                                    <span class="statusDanger text-danger error-msg">{{ $errors->first('start_time') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">End Time</label>
                                                <input type="text" id="inputEndTime" name="end_time" class="form-control  timepicker timeKeydown required" value="{{ old('end_time') }}" placeholder="Please select start time">
                                                @if($errors->has('end_time'))
                                                    <span class="statusDanger text-danger error-msg">{{ $errors->first('end_time') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4 m-auto">
                                <div class="phone view_3" id="phoneHomeBanner">
                                    <div class="loader" id="previewLoaderHomeBanner"></div>
                                    <iframe id="phone-iframe-homeBanner-ad"></iframe>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="addButton" id="homeBannerAddButton">
                        <a  class="btn btn-info text-white" id="addInputHomeBannerField">
                            <i class="icon-plus"></i> Add more link
                        </a>
                    </div>
                </div>
            </div>
        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.inner -->
                                        <div class="actions">
                                            <ul>
                                                <li><span class="js-btn-prev" title="BACK"><i class="fa fa-arrow-left"></i> BACK </span></li>
                                                <li><button type="submit" title="NEXT">SUBMIT <i class="fa fa-arrow-right"></i></button></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script src="{{ asset('assets/form-wizard/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/form-wizard/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/form-wizard/js/conditionize.flexible.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/form-wizard/js/main.js') }}"></script>

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

        // $(document).ready(function() {
        //     // display_serverTime();

        //     $('.select2').focusOut();
        //     $('.selectgroup-button').focusOut();
        // });

        @if (!empty(old('adv_cat')))
            @foreach (old('adv_cat') as $cat)
                fnCategoryShow({{ $cat }});
            @endforeach
        @endif

        //date picker
        $('#inputEndDate').bootstrapMaterialDatePicker({ weekStart : 0, time: false, minDate: moment(), format : 'DD-MM-YYYY' });
        $('#inputStartDate').bootstrapMaterialDatePicker({ weekStart : 0, time: false, minDate: moment(), format : 'DD-MM-YYYY' }).on('change', function(e, date)
        {
            $('#inputEndDate').bootstrapMaterialDatePicker('setMinDate', date);
        });

        // $('#inputStartTime').blur(function () {
        //     checkTimeSlot("{{ route('adv.check.timeslot') }}");
        // });

        // $('#inputEndTime').blur(function () {
        //     checkTimeSlot("{{ route('adv.check.timeslot') }}");
        // });


    </script>
@endsection
