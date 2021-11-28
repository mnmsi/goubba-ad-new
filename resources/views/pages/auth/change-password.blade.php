@extends('layouts.base')
@section('title', 'Profile')
{{-- @section('pageTitle', 'Change Password') --}}

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row justify-content-md-center">
            <div class="col-lg-8">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Change Password</h1>
                    </div>
                    <form action="{{ route('users.changePassword') }}" method="post" class="user">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <div class="form-group">
                            <label class="control-label">Old Password</label>
                            <div class="controls">
                                <input type="password" name="old_password" placeholder="Enter old password" class="form-control">

                                @if($errors->has('old_password'))
                                    <p class="statusDanger error-msg">{{ $errors->first('old_password') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">New Password</label>
                            <div class="controls">
                                <input type="password" name="password" placeholder="Enter new password" class="form-control">

                                @if($errors->has('password'))
                                    <p class="statusDanger error-msg">{{ $errors->first('password') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Confirm Password</label>
                            <div class="controls">
                                <input type="password" name="password_confirmation" placeholder="Enter password again.." class="form-control">

                                @if($errors->has('password_confirmation'))
                                    <p class="statusDanger error-msg">{{ $errors->first('password_confirmation') }}</p>
                                @endif
                            </div>
                        </div>


                        <div class="controls btn_submitBtn">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
