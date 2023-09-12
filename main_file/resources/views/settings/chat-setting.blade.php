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
                                    class="list-group-item list-group-item-action active">{{ __('Chat') }}</a>
                                <a href="{{ route('setting', 'general-setting') }}"
                                    class="list-group-item list-group-item-action">{{ __('General') }}</a>
                                @if (\Auth::user()->type == 'Super Admin')
                                    <a href="{{ route('setting', 'stripe-setting') }}"
                                        class="list-group-item list-group-item-action">{{ __('Stripe') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <form id="setting-form" action="{{ route('settings/pusher-setting/update') }}"
                            enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="card" id="settings-card">
                                <div class="card-header">
                                    <h5> {{ $t }}</h5>
                                </div>
                                <div class="card-body">
                                    <p class="text-muted"> {{ __('Pusher Setting') }} <a href="https://pusher.com/"
                                            class="m-2" target="_blank">{{ __('Document') }}</a> </p>
                                    <div class="">
                                        <div class=" row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="name">{{ __('Pusher App ID') }}</label>
                                                    <input type="text" name="pusher_id" class="form-control"
                                                        value="{{ Utility::getsettings('pusher_id') }}" required
                                                        placeholder="{{ __('Pusher App ID') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="name">{{ __('Pusher Key') }}</label>
                                                    <input type="text" name="pusher_key" class="form-control"
                                                        value="{{ Utility::getsettings('pusher_key') }}" required
                                                        placeholder="{{ __('Pusher Key') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="name">{{ __('Pusher Secret') }}</label>
                                                    <input type="text" name="pusher_secret" class="form-control"
                                                        value="{{ Utility::getsettings('pusher_secret') }}" required
                                                        placeholder="{{ __('Pusher Secret') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="name">{{ __('Pusher Cluster') }}</label>
                                                    <input type="text" name="pusher_cluster" class="form-control"
                                                        value="{{ Utility::getsettings('pusher_cluster') }}" required
                                                        placeholder="{{ __('Pusher Cluster') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-md-8">
                                                        <label for="status_toggle">{{ __('Status') }}</label>
                                                    </div>
                                                    <div class="col-md-4 form-check form-switch custom-switch-v1">
                                                        <label class="custom-switch mt-2 custom-left float-end">
                                                            <input name="pusher_status" class="form-check-input input-primary"
                                                                type="checkbox"
                                                                {{ Utility::getsettings('pusher_status') ? 'checked' : 'unchecked' }}>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <hr>
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
