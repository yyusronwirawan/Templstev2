@extends('layouts.main')
@section('title', __('Create role'))

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-b-10">{{ __('Create Role') }}</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('roles.index') }}">{{ __('Roles') }}</a>
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
                    <h5>{{ __('Create Role') }}</h5>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'roles.store', 'method' => 'Post', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group  ">
                        {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
                        {!! Form::text('name', null, ['placeholder' => __('Name'), 'class' => 'form-control', 'required']) !!}
                    </div>
                </div>
                    <div class="card-footer">
                        <div class="btn-flt float-end">
                            <a href="{{ route('roles.index') }}" class="btn btn-secondary ">{{ __('Cancel') }}</a>
                            <button type="submit" class="btn btn-primary ">{{ __('Save') }}</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
