@extends('layouts.main')
@section('title', __('Domain Request'))

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-b-10">{{ __('Approve User') }}</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active"><a
                                href="{{ route('requestdomain.index') }}">{{ __('Domain Request') }}</a></li>
                        <li class="breadcrumb-item">{{ __('Approve') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 m-auto">
            <div class="card ">
                <div class="card-header">
                    <h5>{{ __('Approve User') }}</h5>
                </div>
                <div class="card-body">
                    {!! Form::model($requestdomain, ['route' => ['create.user'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group ">
                        {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
                        {!! Form::text('name', null, ['class' => 'form-control', ' required', 'placeholder' => __('Enter Name')]) !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('email', __('Email'), ['class' => 'form-label']) }}

                        {!! Form::text('email', null, ['class' => 'form-control', ' required', 'placeholder' => __('Enter Email Address')]) !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('domains', __('Domain configration'), ['class' => 'form-label']) }}
                        {!! Form::text('domains', isset($requestdomain->domain_name) ? $requestdomain->domain_name : '', ['class' => 'form-control', ' required', 'placeholder' => __('Enter domain name')]) !!}
                        <span>{{ __('how to add-on domain in your hosting panel.') }}<a
                                href="{{ Storage::url('pdf/adddomain.pdf') }}" class="m-2"
                                target="_blank">{{ __('Document') }}</a></span>
                    </div>
                </div>
                <input type="hidden" name="type" value="{{ $requestdomain->type }}">
                <input type="hidden" name="password" value="{{ $requestdomain->password }}">
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
