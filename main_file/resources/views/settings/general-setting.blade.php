@php
$lang = \App\Facades\UtilityFacades::getValByName('default_language');
@endphp
@extends('layouts.main')
@section('title', __($t))
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h4 class="m-b-10">{{ $t }}</h4>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('settings') }}">{{ __('Settings') }}</a>
                                </li>
                                <li class="breadcrumb-item">{{ $t }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-body">
                <div id="output-status"></div>
                <div class="row">
                    <div class="col-xl-3">
                        <div class="card sticky-top">
                            <div class="list-group list-group-flush" id="useradd-sidenav">
                                <a href="{{ route('setting', 'app-setting') }}"
                                    class="list-group-item list-group-item-action ">{{ __('App Setting') }}</a>
                                <a href="{{ route('setting', 'storage-setting') }}"
                                    class="list-group-item list-group-item-action">{{ __('Storage') }}</a>
                                <a href="{{ route('setting', 'mail-setting') }}"
                                    class="list-group-item list-group-item-action">{{ __('Email') }}</a>
                                <a href="{{ route('setting', 'chat-setting') }}"
                                    class="list-group-item list-group-item-action">{{ __('Chat') }}</a>
                                <a href="{{ route('setting', 'general-setting') }}"
                                    class="list-group-item list-group-item-action active">{{ __('General') }}</a>
                                @if (\Auth::user()->type == 'Super Admin')
                                    <a href="{{ route('setting', 'stripe-setting') }}"
                                        class="list-group-item list-group-item-action">{{ __('Stripe') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <form id="setting-form" action="{{ route('settings/auth-settings/update') }}"
                            enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="card" id="settings-card">
                                <div class="card-header">
                                    <h5> {{ $t }}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <div class=" row">
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-md-8">
                                                        <strong
                                                            class="d-block">{{ __('Two Factor Authentication') }}</strong>
                                                        {{ !Utility::getsettings('2fa') ? 'Activate' : 'Deactivate' }}
                                                        {{ __('Two Factor Authentication') }}
                                                    </div>
                                                    <div class="col-md-4 form-check form-switch custom-switch-v1">
                                                        <label class="custom-switch mt-2  form-label custom-left float-end">
                                                            <input name="two_factor_auth" class="form-check-input input-primary" type="checkbox"
                                                                {{ Utility::getsettings('2fa') ? 'checked' : 'unchecked' }}>
                                                        </label>
                                                    </div>
                                                    @if (!extension_loaded('imagick'))
                                                        <small>
                                                            {{ __('Note: for 2FA your server must have Imagick.') }} <a
                                                                href="https://www.php.net/manual/en/book.imagick.php"
                                                                target="_new">{{ __('Imagick Document') }}</a>
                                                        </small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-8">
                                            <strong class="d-block">{{ __('RTL Setting') }}</strong>
                                            {{ Utility::getsettings('rtl') == '0' ? __('Activate') : __('Deactivate') }}
                                            {{ __('RTL setting for application.') }}
                                        </div>
                                        <div class="col-md-4 form-check form-switch custom-switch-v1">
                                            <label class="custom-switch custom-left form-label mt-2 float-end">
                                                <input name="rtl_setting" type="checkbox" class="form-check-input input-primary" id="cust-rtllayout" {{ Utility::getsettings('rtl') == '1' ? 'checked' : 'unchecked' }}>
                                                {{--  <input name="rtl_setting" class="form-check-input input-primary"
                                                    type="checkbox"
                                                    {{ Utility::getsettings('rtl') == '1' ? 'checked' : 'unchecked' }}>  --}}
                                            </label>
                                        </div>
                                    </div>
                                        <div class="form-group">
                                            <label for="name" class="form-label">{{ __('Default Language') }}</label>
                                            <select name="default_language" id="default_language"
                                                class="form-control select2">
                                                @foreach (\App\Facades\UtilityFacades::languages() as $language)
                                                    <option @if ($lang == $language) selected @endif
                                                        value="{{ $language }}">
                                                        {{ Str::upper($language) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    <div class="form-group">
                                        <label for="date_format" class="form-label">{{ __('Date Format') }}</label>
                                        <select name="date_format" class="form-control">
                                            <option value="M j, Y"
                                                {{ Utility::getsettings('date_format') == 'M j, Y' ? 'selected' : '' }}>
                                                {{ __('Jan 1, 2020') }}</option>
                                            <option value="d-M-y"
                                                {{ Utility::getsettings('date_format') == 'd-M-y' ? 'selected' : '' }}>
                                                {{ __('01-Jan-20') }}</option>
                                        </select>
                                    </div>
                                    @if (\Auth::user()->type == 'Super Admin')
                                        <div class="form-group">
                                            <label for="name" class="form-label">{{ __('Approved Domain Request') }}</label>
                                            <select name="approve_type" class="form-control">
                                                <option value="Manually"
                                                    {{ Utility::getsettings('approve_type') == 'Manually' ? 'selected' : '' }}>
                                                    {{ __('Manually') }}</option>
                                                <option value="Auto"
                                                    {{ Utility::getsettings('approve_type') == 'Auto' ? 'selected' : '' }}>
                                                    {{ __('Auto') }}</option>
                                            </select>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="time_format" class="form-label">{{ __('Time Format') }}</label>
                                        <select name="time_format" class="form-control">
                                            <option value="g:i A"
                                                {{ Utility::getsettings('time_format') == 'g:i A' ? 'selected' : '' }}>
                                                {{ __('hh:mm AM/PM') }}</option>
                                            <option value="H:i:s"
                                                {{ Utility::getsettings('time_format') == 'H:i:s' ? 'selected' : '' }}>
                                                {{ __('HH:mm:ss') }}</option>
                                        </select>
                                    </div>
                                    @if (\Auth::user()->type == 'Super Admin')
                                        <div class="form-group">
                                            <label for="name" class="form-label">{{ __('Currency Name') }}</label>
                                            <input type="text" name="currency" class="form-control"
                                                value="{{ Utility::getsettings('currency') }}" required
                                                placeholder="{{ __('Currency name') }}">
                                            <p>{{ __('The name of currency is to be taken frome this document.') }} <a
                                                    href="https://stripe.com/docs/currencies" class="m-2"
                                                    target="_blank">{{ __('Document') }}</a> </p>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="form-labell">{{ __('Currency Symbol') }}</label>
                                            <input type="text" name="currency_symbol" class="form-control"
                                                value="{{ Utility::getsettings('currency_symbol') }}" required
                                                placeholder="{{ __('currency Symbol') }}">
                                </div>
                                    @endif<hr>
                                <div class="float-end">
                                    <button class="btn btn-primary " type="submit"
                                        id="save-btn">{{ __('Save Changes') }}</button>
                                    <a href="{{ route('settings') }}" class="btn btn-secondary ">{{ __('Cancel') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
    
