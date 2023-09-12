@extends('layouts.main')
@section('title', __('Domain Request'))
@section('content')
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h4 class="m-b-10">{{ __('Edit User') }}</h4>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                                <li class="breadcrumb-item active"><a href="{{ route('requestdomain.index') }}">{{ __('Domain Request') }}</a></li>
                                <li class="breadcrumb-item">{{ __('Edit') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-4 m-auto">
                        <div class="card ">
                            <div class="card-header">
                                <h5>{{ __('Edit User') }}</h5>
                            </div>
                            <div class="card-body">
                            {!! Form::model($requestdomain, ['route' => ['requestdomain.update', $requestdomain->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            <div class="form-group ">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input id="name" value="{{ $requestdomain->name }}" type="text" class="form-control"
                                    name="name" required autocomplete="name" placeholder="{{ __('Enter name') }}"
                                    autofocus>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input id="email" type="email" class="form-control" value="{{ $requestdomain->email }}"
                                    name="email" required placeholder="{{ __('Enter email') }}" autocomplete="email">
                            </div>
                            <div class="form-group">
                                <label for="password" class="d-block form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control pwstrength"
                                    placeholder="{{ __('Enter password') }}" data-indicator="pwindicator" name="password"
                                    >
                                <div id="pwindicator" class="pwindicator">
                                    <div class="bar"></div>
                                    <div class="label"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password2" class="d-block form-label">{{ __('Password Confirmation') }}</label>
                                <input id="password-confirm" type="password" class="form-control"
                                    placeholder="{{ __('Enter confirm password') }}" name="password_confirmation"
                                     autocomplete="new-password">
                            </div>
                            <div class="form-group">
                                {{ Form::label('domains', __('Domain configration'),['class' => 'form-label']) }}
                                    {!! Form::text('domains', $requestdomain->domain_name, ['class' => 'form-control', ' required', 'placeholder' => __('Enter domain name')]) !!}
                                <span>{{ __('how to add-on domain in your hosting panel.') }}<a
                                        href="{{ Storage::url('pdf/adddomain.pdf') }}" class="m-2"
                                        target="_blank">{{ __('Document') }}</a></span>
                            </div>
                        </div>
                            <div class="card-footer">
                                <div class="float-end">
                                    <a href="{{ route('requestdomain.index') }}" class="btn btn-secondary ">{{ __('Cancel') }}</a>
                                    <button type="submit" class="btn btn-primary ">{{ __('Save') }} </button>
                                    {!! Form::close() !!}
                                </div>
                        </div>
                    </div>
                </div>
                </div>
@endsection
