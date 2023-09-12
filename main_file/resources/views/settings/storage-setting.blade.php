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
                                <a href="{{ route('setting', 'storage-setting') }}" class="list-group-item list-group-item-action active">{{ __('Storage') }}</a>
                                <a href="{{ route('setting', 'mail-setting') }}" class="list-group-item list-group-item-action">{{ __('Email') }}</a>
                                <a href="{{ route('setting', 'chat-setting') }}" class="list-group-item list-group-item-action">{{ __('Chat') }}</a>
                                <a href="{{ route('setting', 'general-setting') }}" class="list-group-item list-group-item-action">{{ __('General') }}</a>
                                @if (\Auth::user()->type == 'Super Admin')
                                <a href="{{ route('setting', 'stripe-setting') }}" class="list-group-item list-group-item-action">{{ __('Stripe') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <form id="setting-form" action="{{ route('settings/s3-setting/update') }}"
                            enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="card" id="settings-card">
                                <div class="card-header">
                                    <h5> {{ $t }}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="status_toggle" class="form-label">{{ __('Local') }}</label>
                                            <label class="custom-radio col-3 mt-2 ">
                                                <input name="settingtype" class="form-check-input input-light-primary pl-2" type="radio" data-toggle="switchbutton" checked data-onstyle="primary"
                                                    value="local" checked
                                                    {{ Utility::getsettings('settingtype') == 'local' ? 'checked' : 'unchecked' }}>
                                            </label>
                                            <label for="status_toggle" class="form-label">{{ __('S3 setting') }}</label>
                                            <label class="custom-radio col-3 mt-2 ">
                                                <input name="settingtype" class="form-check-input input-light-primary pl-2" type="radio" data-toggle="switchbutton" checked data-onstyle="primary"
                                                    value="s3"
                                                    {{ Utility::getsettings('settingtype') == 's3' ? 'checked' : 'unchecked' }}>
                                            </label>
                                    </div>
                                    <div id="s3"
                                        class="desc {{ Utility::getsettings('settingtype') == 's3' ? 'block' : 'd-none' }}">
                                        <p class="text-muted"> {{ __('S3 Setting') }}</p>
                                        <div class="">
                                        <div class=" row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="s3_key">{{ __('S3 Key') }}</label>
                                                    <input type="text" name="s3_key" class="form-control"
                                                        value="{{ Utility::getsettings('s3_key') }}"
                                                        placeholder="{{ __('S3 Key') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="s3_secret">{{ __('S3 Secret') }}</label>
                                                    <input type="text" name="s3_secret" class="form-control"
                                                        value="{{ Utility::getsettings('s3_secret') }}"
                                                        placeholder="{{ __('S3 Secret') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="s3_region">{{ __('S3 Region') }}</label>
                                                    <input type="text" name="s3_region" class="form-control"
                                                        value="{{ Utility::getsettings('s3_region') }}"
                                                        placeholder="{{ __('S3 Region') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="s3_bucket">{{ __('S3 Bucket') }}</label>
                                                    <input type="text" name="s3_bucket" class="form-control"
                                                        value="{{ Utility::getsettings('s3_bucket') }}"
                                                        placeholder="{{ __('S3 Bucket') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="s3_url">{{ __('S3 URL') }}</label>
                                                    <input type="text" name="s3_url" class="form-control"
                                                        value="{{ Utility::getsettings('s3_url') }}"
                                                        placeholder="{{ __('S3 URL') }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="s3_endpoint">{{ __('S3 Endpoint') }}</label>
                                                    <input type="text" name="s3_endpoint" class="form-control"
                                                        value="{{ Utility::getsettings('s3_endpoint') }}"
                                                        placeholder="{{ __('S3 Endpoint') }}">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div><hr>
                            <div class="float-end">
                                <button class="btn btn-primary " type="submit"
                                    id="save-btn">{{ __('Save Changes') }}</button>
                                <a href="{{ route('settings') }}" class="btn btn-secondary ">{{ __('Cancel') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('javascript')
    <script>
        $(document).on('click', "input[name='settingtype']", function() {
            var test = $(this).val();
            if (test == 's3') {
                $("#s3").fadeIn(500);
                $("#s3").removeClass('d-none');
            } else {
                $("#s3").fadeOut(500);
            }
        });
    </script>
@endpush
