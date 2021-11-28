@extends('layouts.auth')
@section('title', 'Forgot Password')

@section('signUp')

    <!-- Nested Row within Card Body -->
    <div class="row">
        <div class="col-lg-3 d-none d-lg-block bg-"></div>
        <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Change Your Password</h1>
                </div>
                <form class="form-vertical row-fluid" action="{{ route('forgot.password') }}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
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
                        <input class="form-control form-control-user" type="email" 
                            name="email" placeholder="Enter Email Address" 
                            value="{{old('email', request('email'))}}"/>
                    </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block">Send reset link</button>
                    <hr>
                    <a href="{{url('login')}}" class="btn btn-facebook btn-user btn-block">
                        Back To Login !
                    </a>

                </form>
            </div>
        </div>
    </div>


    {{-- <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="module module-login span6 offset3">
                    <div class="module-head">
                        <h3>Forgot Password</h3>
                    </div>

                    <div class="module-body">
                        <form class="form-vertical row-fluid" action="{{ route('forgot.password') }}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            @include('incl.pages.adminAlert')

                            @if ($errors->any())
                                @foreach($errors->all() as $error)
                                    <div class="alert alert-error">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        {{ $error }}
                                    </div>
                                @endforeach
                            @endif


                            <div class="control-group">
                                <label class="control-label">Email</label>
                                <div class="controls">
                                    <input type="text" class="span12" name="email" value="{{old('email', request('email'))}}" >
                                </div>
                            </div>


                            <div class="control-group">
                                <div class="controls clearfix">
                                    <button type="submit" class="btn btn-primary pull-right">Send reset link</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div> --}}




@endsection
