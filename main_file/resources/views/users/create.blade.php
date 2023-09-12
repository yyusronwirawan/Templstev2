@extends('layouts.main')
@section('title', __('Create user'))

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-b-10">{{ __('Create Users') }}</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">{{ __('Users') }}</a>
                        </li>
                        <li class="breadcrumb-item">{{ __('Create') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 m-auto">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('Create Users') }}</h5>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'users.store', 'method' => 'Post', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group ">
                        {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}

                        {!! Form::text('name', null, ['class' => 'form-control', ' required', 'placeholder' => __('Enter Name')]) !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('email', __('Email'), ['class' => 'form-label']) }}

                        {!! Form::text('email', null, ['class' => 'form-control', ' required', 'placeholder' => __('Enter Email Address')]) !!}
                    </div>
                    <div class="form-group ">
                        {{ Form::label('password', __('Password'), ['class' => 'form-label']) }}

                        {!! Form::password('password', ['class' => 'form-control', ' required', 'placeholder' => __('Enter Password')]) !!}
                    </div>
                    <div class="form-group ">
                        {{ Form::label('confirm-password', __('Confirm Password'), ['class' => 'form-label']) }}

                        {{ Form::password('confirm-password', ['class' => 'form-control',' required','placeholder' => __('Enter Confirm Password')]) }}
                    </div>
                    @if (tenant('id') != null)
                        <div class="form-group">
                            {{ Form::label('roles', __('Role'), ['class' => 'form-label']) }}
                            {!! Form::select('roles', $roles, null, ['class' => 'form-control']) !!}
                        </div>
                    @endif
                    @hasrole('Super Admin')
                        <div class="form-group">
                            {{ Form::label('domains', __('Domain'), ['class' => 'form-label']) }}
                            {!! Form::text('domains', null, ['class' => 'form-control', ' required', 'placeholder' => __('Enter domain name')]) !!}
                            <span>{{ __('how to add-on domain in your hosting panel.') }}<a
                                    href="{{ Storage::url('pdf/adddomain.pdf') }}" class="m-2"
                                    target="_blank">{{ __('Document') }}</a></span>
                        </div>
                    </div>
                @endhasrole
                <div class="card-footer">
                    <div class="float-end">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary ">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-primary ">{{ __('Save') }}</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
