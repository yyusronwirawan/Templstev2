@extends('layouts.app')
@section('title', __('Login'))

@section('content')
    <div class="mx-3 mx-md-5 mb-5" style="margin-top:95px;">
        <img src="{{ Utility::getpath('logo/app-logo.png') }}" alt="logo" class="app-logo mt-5" width="175">
    </div>
    <div class="card">
        <div class="card-body mx-auto">
            <div class="">
                <h4 class="text-primary mt-2 mb-3">{{ __('Sign in') }}</h4>
            </div>
            <div class="text-start">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control" placeholder="{{__('Email address')}}" name="email" tabindex="1" required
                            autocomplete="email" autofocus>
                        <div class="float-end ">
                            @if (Route::has('password.request'))
                                <a class="btn" href="{{ route('password.request') }}">
                                    {{ __('Forgot Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="d-block">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                        </div>
                        <input id="password" type="password" class="form-control" placeholder="{{__('Password')}}" name="password" tabindex="2" required
                            autocomplete="current-password">
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-check form-switch">
                            <input type="checkbox" name="remember" class="form-check-input" id="customswitch1">
                            <label class="form-check-label" for="remember">{{ __('Remember me') }}</label>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary  btn-block mt-2"
                            tabindex="4">{{ __('Sign In') }}</button>
                    </div>
                    <div class="mt-4 text-muted text-center">
                        {{ __('Donot have an account?') }} <a href="{{ route('register') }}">{{ __('Create One') }}</a>
                    </div>
                </form>
            </div>
        </div>
    @endsection
