@extends('layouts.app')
@section('title', __('Reset password'))

@section('content')
    <div class="mx-3 mx-md-5 mb-5" style="margin-top:195px;">
        <img src="{{ Utility::getpath('logo/app-dark-logo.png') }}" alt="logo" class="app-logo mt-5" width="175">
    </div>
    <div class="card">
        <div class="card-body mx-auto">
            <div class="">
                <h4 class="text-primary mt-2 mb-3">{{ __('Reset Password') }}</h4>
            </div>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <div class="">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <div class="">
                        <input id=" password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group ">
                    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                    <div class="">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn form-control btn-primary  btn-lg btn-block" tabindex="4">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
@endsection
