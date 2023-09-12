@extends('layouts.app')
@section('title', __('Register'))

@section('content')
        <div class="mx-3 mx-md-5 mb-5">
            <img src="{{ Utility::getpath('logo/app-dark-logo.png') }}" alt="logo" class="app-logo mt-5" width="175">
        </div>
        <div class="card">
            <div class="card-body mx-auto">
                <div class="">
                    <h4 class="text-primary mt-2 mb-3">{{ __('Sign up') }}</h4>
                </div>
                <div class="text-start">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group ">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control" name="name" placeholder="{{__('Name')}}" required autocomplete="name"
                                autofocus>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control" name="email" required placeholder="{{__('Email address')}}"
                                autocomplete="email">
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" placeholder="{{__('Password')}}" class="form-control pwstrength"
                                data-indicator="pwindicator" name="password" required>
                            <div id="pwindicator" class="pwindicator">
                                <div class="bar"></div>
                                <div class="label"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password2" class="form-label">{{ __('Password Confirmation') }}</label> <input
                                id="password-confirm" type="password" placeholder="{{__('Password Confirmation')}}" class="form-control" name="password_confirmation"
                                required autocomplete="new-password">
                        </div>
                        <div class="form-group">
                            <label for="roles" class="form-label">{{ __('Role') }}</label>
                            {!! Form::select('roles', $roles, [], ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" name="agree" class="form-check-input" id="agree" style="margin-right: 5px;">
                                <label class="form-check-label"
                                    for="agree">{{ __('I agree with the terms and conditions') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn form-control btn-primary  btn-lg btn-block">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
    @endsection
