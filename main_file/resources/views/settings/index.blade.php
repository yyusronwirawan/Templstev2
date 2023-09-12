@extends('layouts.main')
@section('title', __('Settings'))
@section('content')
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h4 class="m-b-10">{{ __('Settings') }}</h4>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                                <li class="breadcrumb-item">{{ __('Settings') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="ti ti-palette"></i>
                            </div>
                            <div class="card-body">
                                <h4>{{ __('App Setting') }}</h4>
                                <p>{{ __('Logo & App Name Setting') }}</p>
                                <a href="{{ route('setting', 'app-setting') }}"
                                    class="card-cta">{{ __('Change Setting') }} <i
                                        class="ti ti-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="ti ti-file-analytics"></i>
                            </div>
                            <div class="card-body">
                                <h4>{{ __('Storage Setting') }}</h4>
                                <p>{{ __('AWS,S3 Storage Configuration') }}</p>
                                <a href="{{ route('setting', 'storage-setting') }}"
                                    class="card-cta">{{ __('Change Setting') }} <i
                                        class="ti ti-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="ti ti-mail-opened"></i>
                            </div>
                            <div class="card-body">
                                <h4>{{ __('Email') }}</h4>
                                <p>{{ __('Email SMTP settings, notifications and others related to email.') }}</p>
                                <a href="{{ route('setting', 'mail-setting') }}"
                                    class="card-cta">{{ __('Change Setting') }} <i
                                        class="ti ti-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="ti ti-message-circle"></i>
                            </div>
                            <div class="card-body">
                                <h4>{{ __('Chat Setting') }}</h4>
                                <p>{{ __('Pusher Setting') }}</p>
                                <a href="{{ route('setting', 'chat-setting') }}"
                                    class="card-cta">{{ __('Change Setting') }} <i
                                        class="ti ti-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="ti ti-world"></i>
                            </div>
                            <div class="card-body">
                                <h4>{{ __('General') }}</h4>
                                <p>{{ __('General Setting') }}</p>
                                <a href="{{ route('setting', 'general-setting') }}"
                                    class="card-cta">{{ __('Change Setting') }} <i
                                        class="ti ti-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    @if (\Auth::user()->type == 'Super Admin')
                    <div class="col-lg-6">
                        <div class="card card-large-icons">
                            <div class="card-icon bg-primary text-white">
                                <i class="ti ti-brand-stripe"></i>
                            </div>
                            <div class="card-body">
                                <h4>{{ __('Stripe') }}</h4>
                                <p>{{ __('Stripe Setting') }}</p>
                                <a href="{{ route('setting', 'stripe-setting') }}"
                                    class="card-cta">{{ __('Change Setting') }} <i
                                        class="ti ti-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
@endsection
