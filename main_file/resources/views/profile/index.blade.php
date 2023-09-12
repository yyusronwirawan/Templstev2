@extends('layouts.main')
@section('title', __('Profile'))
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-b-10">{{ __('Profile') }}</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item">{{ __('Profile') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="row">
                <div class="col-xl-3">
                    <div class="card sticky-top">
                        <div clwss="list-group list-group-flush" id="useradd-sidenav">
                            <a href="#useradd-1"
                                class="list-group-item list-group-item-action active useradd-1">{{ __('Profile') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#useradd-2"
                                class="list-group-item list-group-item-action useradd-2">{{ __('Basic Info') }} <div
                                    class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            <a href="#useradd-3"
                                class="list-group-item list-group-item-action useradd-3">{{ __('Update Login') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            @if (Utility::getsettings('2fa'))
                                <a href="#useradd-4"
                                    class="list-group-item list-group-item-action useradd-4">{{ __('2FA') }} <div
                                        class="float-end"><i class="ti ti-chevron-right"></i></div></a>
                            @endif
                            <a href="#useradd-5"
                                class="list-group-item list-group-item-action useradd-5">{{ __('Delete Account') }}
                                <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div id="useradd-1" class="card bg-primary text-white">

                        <div class="card-body pt-2">
                            <div class="d-flex align-items-center">
                                <div class="avatar me-3">
                                    @if (tenant('id') == null)
                                        <img src="{{ $user->avatar ? Storage::url($user->avatar) : asset('assets/img/avatar/avatar-1.png') }}"
                                            alt="kal" class="img-user wid-80 rounded-circle">
                                    @else
                                        @if (config('filesystems.default') == 'local')
                                            <img src="{{ $user->avatar ? Storage::url(tenant('id') . '/' . $user->avatar) : asset('assets/img/avatar/avatar-1.png') }}"
                                                alt="kal" class="img-user wid-80 rounded-circle">
                                        @else
                                            <img src="{{ $user->avatar ? Storage::url($user->avatar) : asset('assets/img/avatar/avatar-1.png') }}"
                                                alt="kal" class="img-user wid-80 rounded-circle">
                                        @endif
                                    @endif
                                </div>
                                <div class="d-block d-sm-flex align-items-center justify-content-between w-100">
                                    <div class="mb-3 mb-sm-0">
                                        <h4 class="mb-1 text-white">{{ $user->name }}</h4>
                                        <p class="mb-0 text-sm">{{ $user->email }}</p>
                                        <p class="mb-0 text-sm">{{ $user->name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="useradd-2" class="card">
                        <div class="card-header">
                            <h5>{{ __('Basic info') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Name') }}</label>
                                        <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Role') }}</label>
                                        <input type="text" class="form-control"
                                            value="{{ $role ? $role->name : 'Role Not Set' }}" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Joined') }}</label>
                                        <input type="text" class="form-control" value="{{ $user->created_at }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-label">{{ __('Email') }}</label>
                                        <input type="text" class="form-control" value="{{ $user->email }}" readonly>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="useradd-3" class="card">
                        <div class="card-header">
                            <h5>{{ __('Update Login') }}</h5>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="{{ route('update-login', $user->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <div><label class="label-block">{{ __('email') }}</label></div>
                                        <input type="text" name="email" value="{{ $user->email }}"
                                            class="form-control">
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div><label class="label-block">{{ __('Choose file here') }}</label>
                                        </div>
                                        <input type="file" class="form-control" name="avatar" data-filename="avatar">
                                    </div>
                                    <div class="col-md-6 my-1">
                                        <div><label class="label-block">{{ __('password') }}</label>
                                        </div>
                                        <input type="password" name="password" value=""
                                            placeholder="{{ __('Leave blank if you donot want to change') }}"
                                            class="form-control" autocomplete="off">
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6 my-1">
                                        <div><label class="label-block">{{ __('Confirm password') }}</label>
                                        </div>
                                        <input type="password" name="password_confirmation"
                                            id="choices-multiple-remove-button" value=""
                                            placeholder="{{ __('Leave blank if you donot want to change') }}"
                                            class="form-control" autocomplete="off">
                                        @if ($errors->has('password_confirmation'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-end">
                                        <button type="submit"
                                            class="btn btn-primary  col-sm-2">{{ __('Update login') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if (Utility::getsettings('2fa'))
                        <div id="useradd-4" class="card">
                            <div class="card-header">
                                <h5>{{ __('Two-factor authentication') }}</h5>
                            </div>
                            <!--Google Two Factor Authentication card-->
                            @include('layouts.includes.alerts')
                            @if (empty(auth()->user()->loginSecurity))
                                <!--=============Generate QRCode for Google 2FA Authentication=============-->
                                <div class="card-body">
                                    <div class="row p-0">
                                        <div class="col-md-12">
                                            <p>{{ __('To activate Two factor Authentication Generate QRCode') }}
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            <form class="" action="" method="post">
                                                @csrf
                                                <button
                                                    class="btn btn-primary  col-md-6">{{ __('Activate 2fa') }}</button>
                                                <a class="btn btn-secondary  col-md-5" data-toggle="collapse"
                                                    href="#collapseExample" role="button" aria-expanded="false"
                                                    aria-controls="collapseExample">{{ __('Setup Instruction') }}</a>
                                            </form>
                                        </div>
                                        <div class="col-md-12 mt-3 collapse" id="collapseExample">
                                            <hr>
                                            <h3 class="">
                                                {{ __('Two Factor Authentication(2FA) Setup Instruction') }}
                                            </h3>
                                            <hr>
                                            <div class="
                                                        mt-4">
                                                <h4>{{ __('Below is a step by step instruction on setting up Two Factor Authentication') }}
                                                </h4>
                                                <p><label>{{ __('Step 1') }}:</label>
                                                    {{ __('download') }}
                                                    <strong>{{ __('Google Authenticator App') }}</strong>
                                                    {{ __('Application for Andriod or iOS') }}
                                                </p>
                                                <p class="text-center">
                                                    <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en"
                                                        target="_blank"
                                                        class="btn btn-success">{{ __('Download for Andriod') }}<i
                                                            class="ti ti-brand-android fa-2x ml-2"></i></a>
                                                    <a href="https://apps.apple.com/us/app/google-authenticator/id388497605"
                                                        target="_blank"
                                                        class="btn btn-dark ml-2">{{ __('Download for iPhones') }}<i
                                                            class="ti ti-brand-apple fa-2x ml-2"></i></a>
                                                </p>
                                                <p><label>{{ __('Step 2') }}:</label>
                                                    {{ __('Click on Generate Secret Key on the platform to generate a QRCode') }}
                                                </p>
                                                <p><label>{{ __('Step 3') }}:</label>
                                                    {{ __('Open the') }}
                                                    <strong>{{ __('Google Authenticator App') }}</strong>
                                                    {{ __('and clcik on') }}
                                                    <strong>{{ __('Begin') }}</strong>
                                                    {{ __('on the mobile app') }}
                                                </p>
                                                <p><label>{{ __('Step 4') }}:</label>
                                                    {{ __('After which click on') }}
                                                    <strong>{{ __('Scan a QRcode') }}</strong>
                                                </p>
                                                <p><label>{{ __('Step 5') }}:</label>
                                                    {{ __('Then scan the barcode on the platform') }}</p>
                                                <p><label>{{ __('Step 6') }}:</label>
                                                    {{ __('Enter the verification code generated on the platform and Enable 2FA') }}
                                                </p>
                                                <hr>
                                                <p><label>{{ __('Note') }}:</label>
                                                    {{ __('To disable 2FA enter code from the Google Authenticator App and account password to disable 2FA') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--=============Generate QRCode for Google 2FA Authentication=============-->
                            @elseif(!auth()->user()->loginSecurity->google2fa_enable)
                                <!--=============Enable Google 2FA Authentication=============-->
                                <form class="form-horizontal" method="POST" action="{{ route('enable2fa') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row form-group">
                                            <div class="col-md-12">
                                                <p><strong>{{ __('Scan the QRcode with') }}
                                                        <dfn>{{ __('Google Authenticator App') }}</dfn>
                                                        {{ __('Enter the generated code below') }}</strong>
                                                </p>
                                            </div>
                                            <div class="col-md-12"><img src="{{ $google2fa_url }}" />
                                            </div>
                                            <div class="col-md-12">
                                                <p>{{ __('To enable 2-Factor Authentication verify QRCode') }}
                                                </p>
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="address"
                                                    class="control-label">{{ __('Verification code') }}</label>
                                                <input type="password" name="secret" class="form-control" id="code"
                                                    placeholder="{{ __('Enter the verification code generated on the platform and Enable 2FA') }}">
                                                @if ($errors->has('verify-code'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('verify-code') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-end">
                                            <button type="submit"
                                                class="btn btn-primary  col-sm-2">{{ __('Enable 2FA') }}</button>
                                        </div>
                                    </div>
                                </form>
                                <!--=============Enable Google 2FA Authentication=============-->
                            @elseif(auth()->user()->loginSecurity->google2fa_enable)
                                <!--=============Disable Google 2FA Authentication=============-->
                                <form class="form-horizontal" method="POST" action="{{ route('disable2fa') }}">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row form-group">
                                            <div class="col-md-12"><img src="{{ $google2fa_url }}" />
                                            </div>
                                            <div class="col-md-12">
                                                <p>{{ __('To disable 2-Factor Authentication verify QRCode') }}
                                                </p>
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="address"
                                                    class="control-label">{{ __('current password') }}</label>
                                                <input id="password" type="password"
                                                    placeholder="{{ __('Current Password') }}"
                                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                    name="current-password" required>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $error('password') }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-end">
                                            <button type="submit"
                                                class="btn btn-danger col-sm-2">{{ __('Disable 2FA') }}</button>
                                        </div>
                                    </div>
                                </form>
                                <!--=============Disable Google 2FA Authentication=============-->
                            @endif
                        </div>
                    @endif
                    <div id="useradd-5" class="card">
                        <div class="card-header">
                            <h5>{{ __('Delete Account') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between mt-3">
                                <div class="col-sm-auto text-sm-end d-flex align-items-center">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="float-end d-flex">
                                @if ($user->active_status == 1)
                                    <a href="profile-status" class="btn btn-secondary  d-flex me-3 float-end">
                                        {{ __('Deactivate') }}
                                    </a>
                                @endif
                                {!! Form::open(['method' => 'DELETE', 'route' => ['profile.delete', $user->id], 'id' => 'delete-form-' . $user->id]) !!}
                                <a class="btn btn-danger show_confirm d-flex" data-toggle="tooltip"
                                    href="#!">{{ __('Delete Account') }}<i
                                        class="ti ti-chevron-right ms-1 ms-sm-2"></i></a>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('javascript')
    <script src="{{ asset('assets/js/plugins/choices.min.js') }}"></script>

    <script>
        $(document).on("click", ".useradd-1", function() {
            $('.useradd-2').removeClass('active');
            $('.useradd-3').removeClass('active');
            $('.useradd-4').removeClass('active');
            $('.useradd-5').removeClass('active');
            $('.useradd-1').addClass('active');
        });
        $(document).on("click", ".useradd-2", function() {
            $('.useradd-1').removeClass('active');
            $('.useradd-3').removeClass('active');
            $('.useradd-5').removeClass('active');
            $('.useradd-4').removeClass('active');
            $('.useradd-2').addClass('active');
        });
        $(document).on("click", ".useradd-3", function() {
            $('.useradd-2').removeClass('active');
            $('.useradd-1').removeClass('active');
            $('.useradd-5').removeClass('active');
            $('.useradd-4').removeClass('active');
            $('.useradd-3').addClass('active');
        });
        $(document).on("click", ".useradd-4", function() {
            $('.useradd-2').removeClass('active');
            $('.useradd-3').removeClass('active');
            $('.useradd-5').removeClass('active');
            $('.useradd-1').removeClass('active');
            $('.useradd-4').addClass('active');
        });
        $(document).on("click", ".useradd-5", function() {
            $('.useradd-2').removeClass('active');
            $('.useradd-3').removeClass('active');
            $('.useradd-4').removeClass('active');
            $('.useradd-1').removeClass('active');
            $('.useradd-5').addClass('active');
        });
    </script>
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 50
        })
    </script>
@endpush
