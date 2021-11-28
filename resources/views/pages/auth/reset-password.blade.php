@extends('layouts.auth')
@section('title', 'Setup Password')

@section('signUp')
    <div class="card-body">
        <div class="row justify-content-md-center">
            <div class="col-lg-8">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Setup Password</h1>
                    </div>
                    <form action="{{ route('reset.password') }}" method="post" class="user">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="token" value="{{$token}}">

                        @include('incl.pages.adminAlert')

                        @if ($errors->any())
                            @foreach($errors->all() as $error)
                                <div class="alert alert-error">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif

                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <div class="controls">
                                <input type="text" name="email" placeholder="Enter email" class="form-control" value="{{old('email', $email)}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">New Password</label>
                            <div class="controls">
                                <input type="password" name="password" placeholder="Enter new password" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Confirm Password</label>
                            <div class="controls">
                                <input type="password" name="password_confirmation" placeholder="Enter password again.." class="form-control">
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


@endsection
