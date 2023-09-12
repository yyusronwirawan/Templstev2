@extends('layouts.app')
@section('title', __('Email verify'))

@section('content')
    <div class="mx-3 mx-md-5 mb-5" style="margin-top:195px;">
        <img src="{{ Utility::getpath('logo/app-dark-logo.png') }}" alt="logo" class="app-logo mt-5" width="175">
    </div>
    <div class="card">
        <div class="card-body mx-auto">
            <div class="">
                <h4 class="text-primary mt-2 mb-3">{{ __('Forgot Password') }}</h4>
                <p class="text-muted text-center">{{ __('We will send a link to reset your password') }}</p>
            </div>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group mb-3">
                    <label class="form-label" for="email">{{ __('Email') }}</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required
                        autocomplete="email" autofocus>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">{{ __('Forgot Password') }}</button>
                    <a href="{{ url('/home') }}" class="btn btn-secondary">{{ __('Back') }}</a>
                </div>
            </form>
        </div>
    @endsection
