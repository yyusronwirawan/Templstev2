@extends('layouts.app')
@section('title', __('Send Link Mail'))
@section('content')
    <div class="mx-3 mx-md-5 mb-5">
        <img src="{{ Utility::getpath('logo/app-dark-logo.png') }}" alt="logo" class="app-logo mt-5" width="175">
    </div>
    <div class="card">
        <div class="card-body mx-auto">
            <div class="">
                <h4 class="text-primary mt-2 mb-3">{{ __('Verify Your Email Address') }}</h4>
            </div>
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif
            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit"
                    class="btn btn-link form-control p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
            </form>
        </div>
    </div>
@endsection
