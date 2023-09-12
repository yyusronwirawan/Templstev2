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
                                <a href="{{ route('setting', 'mail-setting') }}" class="list-group-item list-group-item-action">{{ __('Email') }}</a>
                                <a href="{{ route('setting', 'chat-setting') }}" class="list-group-item list-group-item-action">{{ __('Chat') }}</a>
                                <a href="{{ route('setting', 'general-setting') }}" class="list-group-item list-group-item-action">{{ __('General') }}</a>
                                @if (\Auth::user()->type == 'Super Admin')
                                <a href="{{ route('setting', 'stripe-setting') }}" class="list-group-item list-group-item-action active">{{ __('Stripe') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <form id="setting-form" action="{{ route('settings/stripe-setting/update') }}"
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
                                            <div class="form-group">
                                                <label for="name" class="form-label">{{ __('Stripe Key') }}</label>
                                                <input type="text" name="stripe_key" class="form-control"
                                                    value="{{ env('STRIPE_KEY') }}" required
                                                    placeholder="{{ __('Stripe key') }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="name" class="form-label">{{ __('Stripe Secret') }}</label>
                                                <input type="text" name="stripe_secret" class="form-control"
                                                    value="{{ env('STRIPE_SECRET') }}" required
                                                    placeholder="{{ __('Stripe Secret') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div><hr>
                            <div class="float-end">
                                <input type="hidden" name="tenant_id" value="{{ tenant('id') }}">
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
