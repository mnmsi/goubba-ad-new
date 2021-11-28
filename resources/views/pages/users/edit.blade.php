@extends('layouts.base')
@section('title', 'Edit advertiser')

@section('breadcrumb')
    <h1 class="page-title">Edit Advertiser</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Advertiser Manager</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Advertiser</li>
    </ol>
@endsection

@section('content')
<section>
    <form action="{{ route('users.update', $user->id) }}" method="post" class="user">
        @csrf
        <div class="card">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Brand Name</label>
                            <input type="text" id="inputBusinessName" name="business_name" placeholder="Enter your brand name" class="form-control" value="{{ old('business_name', $user_info['business_name']) }}">
                            @if($errors->has('business_name'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('business_name') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <input type="email" id="inputEmail" name="email" placeholder="Enter your email" class="form-control" value="{{ old('email', $user_info['email']) }}">
                            @if($errors->has('email'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('email') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Website</label>
                            <input type="text" id="inputWebsite" name="website" placeholder="Enter your website" class="form-control" value="{{ old('website', $user_info['website']) }}">

                            @if($errors->has('website'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('website') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Phone</label>
                            <input type="text" id="inputPhone" name="phone" placeholder="Enter your phone" class="form-control" value="{{ old('phone', $user_info['phone']) }}">

                            @if($errors->has('phone'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('phone') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Address</label>
                            <input type="text" id="inputAddress" name="address" placeholder="Enter your address" class="form-control" value="{{ old('address', $user_info['address']) }}">
                            @if($errors->has('address'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('address') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Approve Status</label>
                            <select class="form-control select2 custom-select" data-placeholder="Choose one" name="is_approved">
                                <option label="Choose one"></option>
                                <option value="1" {{ old('is_approved', $user_info['is_approved']) == '1' ? 'selected' : '' }}>Approve</option>
                                <option value="0" {{ old('is_approved', $user_info['is_approved']) == '0' ? 'selected' : '' }}>Disapprove</option>
                            </select>

                            @if($errors->has('is_approved'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('is_approved') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Active Status</label>
                            <select class="form-control select2 custom-select" data-placeholder="Choose one" name="is_active">
                                <option label="Choose one"></option>
                                <option value="1" {{ old('is_active', $user_info['is_active']) == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active', $user_info['is_active']) == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>

                            @if($errors->has('is_active'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('is_active') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label">Bank Details</label>
                            <input type="text" id="inputBankDetails" name="bank_details" placeholder="Enter your bank details" class="form-control" value="{{ old('bank_details', $user_info['bank_details']) }}">
                            @if($errors->has('bank_details'))
                                <p class="statusDanger text-danger error-msg">{{ $errors->first('bank_details') }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="expanel expanel-default">
                            <div class="expanel-heading text-center font-weight-bold">Contact Person</div>
                            <div class="expanel-body p-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Contact Name</label>
                                            <input type="text" id="inputContact" name="key_contact_name" placeholder="Enter contact name" class="form-control" value="{{ old('key_contact_name', $user_info['key_contact_name']) }}">
                                            @if($errors->has('key_contact_name'))
                                                <p class="statusDanger text-danger error-msg">{{ $errors->first('key_contact_name') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Contact Phone</label>

                                            <input type="text" id="inputContact" name="key_contact_phone" placeholder="Enter contact phone" class="form-control" value="{{ old('key_contact_phone', $user_info['key_contact_phone']) }}">
                                            @if($errors->has('key_contact_phone'))
                                                <p class="statusDanger text-danger error-msg">{{ $errors->first('key_contact_phone') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Contact Address</label>
                                    <input type="text" id="inputContact" name="key_contact_address" placeholder="Enter contact address" class="form-control" value="{{ old('key_contact_address', $user_info['key_contact_address']) }}">
                                    @if($errors->has('key_contact_address'))
                                        <p class="statusDanger text-danger error-msg">{{ $errors->first('key_contact_address') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('users.list') }}" class="btn btn-default mr-2">Back</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</section>
@endsection
