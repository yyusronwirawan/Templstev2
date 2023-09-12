@extends('layouts.app')
@section('title', __('2FA'))
@section('content')

    <div class="card card-primary">
        <div class="card-header">
            {{ __('Two Factor Authentication') }}
        </div>
        <div class="card-body">
            <form class="form-horizontal" method="POST" action="{{ route('2fa') }}">
                {{ csrf_field() }}
                <div class="form-group mb-3">
                    <div class="form-group">
                        <label for="email">{{ __('One time Password') }}</label>
                        <input class="form-control {{ __('One time Password') }}"
                            placeholder="{{ __('One Time Password') }}" type="text" name="one_time_password"
                            id="one_time_password" value="{{ old('one_time_password') }}" onfocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback d-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    @if ($errors->has('one_time_password'))
                        <span class="invalid-feedback d-block">
                            <strong>{{ $errors->first('one_time_password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="text-center">
                    <button type="submit" class="btn form-control btn-primary  my-4">{{ __('app.sign_in') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
