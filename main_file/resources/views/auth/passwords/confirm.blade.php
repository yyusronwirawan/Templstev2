@extends('layouts.app')
@section('title', __('Forgot password'))

@section('content')
    <div class="mx-3 mx-md-5 mb-5" style="margin-top:195px;">
        <img src="{{ Utility::getpath('logo/app-dark-logo.png') }}" alt="logo" class="app-logo mt-5" width="175">
    </div>
    <div class="card">
        <div class="card-body mx-auto">
            <div class="">
                <h4 class="text-primary mt-2 mb-3">{{ __('Confirm Password') }}</h4>
            </div>
            {{ __('Please confirm your password before continuing.') }}
            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn form-control btn-primary ">
                            {{ __('Confirm Password') }}
                        </button>
                        @if (Route::has('password.request'))
                            <a class="btn form-control btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
