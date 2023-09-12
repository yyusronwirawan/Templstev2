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
                                <li class="breadcrumb-item"><a href="{{ route('settings') }}">{{ __('Settings') }}</a></li>
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
                                <a href="{{ route('setting', 'app-setting') }}" class="list-group-item list-group-item-action ">{{ __('App Setting') }}</a>
                                <a href="{{ route('setting', 'storage-setting') }}" class="list-group-item list-group-item-action">{{ __('Storage') }}</a>
                                <a href="{{ route('setting', 'mail-setting') }}" class="list-group-item list-group-item-action active">{{ __('Email') }}</a>
                                <a href="{{ route('setting', 'chat-setting') }}" class="list-group-item list-group-item-action">{{ __('Chat') }}</a>
                                <a href="{{ route('setting', 'general-setting') }}" class="list-group-item list-group-item-action">{{ __('General') }}</a>
                                @if (\Auth::user()->type == 'Super Admin')
                                <a href="{{ route('setting', 'stripe-setting') }}" class="list-group-item list-group-item-action">{{ __('Stripe') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <form id="setting-form" action="{{ route('settings/email-setting/update') }}"
                            enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="card" id="settings-card">
                                <div class="card-header">
                                    <h5> {{ $t }}</h5>
                                </div>
                                <div class="card-body">
                                        <div class=" row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="name" class="form-label">{{ __('Mail Mailer') }}</label>
                                                <input type="text" name="mail_mailer" class="form-control"
                                                    value="{{ Utility::getsettings('mail_mailer') }}" required
                                                    placeholder="{{ __('Mail Mailer') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="name" class="form-label">{{ __('Mail Host') }}</label>
                                                <input type="text" name="mail_host" class="form-control"
                                                    value="{{ Utility::getsettings('mail_host') }}" required
                                                    placeholder="{{ __('Mail Host') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="name" class="form-label">{{ __('Mail Port') }}</label>
                                                <input type="text" name="mail_port" class="form-control"
                                                    value="{{ Utility::getsettings('mail_port') }}" required
                                                    placeholder="{{ __('Mail Port') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="name" class="form-label">{{ __('Mail Username') }}</label>
                                                <input type="email" name="mail_username" class="form-control"
                                                    value="{{ Utility::getsettings('mail_username') }}" required
                                                    placeholder="{{ __('Mail Username') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="name" class="form-label">{{ __('Mail Password') }}</label>
                                                <input type="password" name="mail_password" class="form-control"
                                                    value="{{ Utility::getsettings('mail_password') }}" required
                                                    placeholder="{{ __('Mail Password') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="name" class="form-label">{{ __('Mail Encryption') }}</label>
                                                <input type="text" name="mail_encryption" class="form-control"
                                                    value="{{ Utility::getsettings('mail_encryption') }}" required
                                                    placeholder="{{ __('Mail Encryption') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="name" class="form-label">{{ __('Mail From Address') }}</label>
                                                <input type="text" name="mail_from_address" class="form-control"
                                                    value="{{ Utility::getsettings('mail_from_address') }}" required
                                                    placeholder="{{ __('Mail From Address') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="name" class="form-label">{{ __('Mail From Name') }}</label>
                                                <input type="text" name="mail_from_name" class="form-control"
                                                    value="{{ Utility::getsettings('mail_from_name') }}" required
                                                    placeholder="{{ __('Mail From Name') }}">
                                            </div>
                                        </div>
                                    </div>
                            <hr>
                            <div class="float-end">
                                <input type="hidden" name="tenant_id" value="{{ tenant('id') }}">
                                <button class="btn btn-primary " type="submit"
                                    id="save-btn">{{ __('Save Changes') }}</button>
                                    <a class="btn  btn-info" href="{{ route('setting', 'test-mail') }}">
                                        {{ __('Send Test Mail') }}</a>

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
