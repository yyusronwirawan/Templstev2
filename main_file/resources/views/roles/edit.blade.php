@extends('layouts.main')
@section('title', __('Edit role'))

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-b-10">{{ __('Edit Role') }}</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('roles.index') }}">{{ __('Roles') }}</a>
                        </li>
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
                    <h5>{{ __('Edit roles') }}</h5>
                </div>
                <div class="card-body">
                    {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'Put', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group ">
                        {{ Form::label('name', __('First Name'), ['class' => 'form-label']) }}
                        {{ Form::text('name', null, ['class' => 'form-control ', 'placeholder' => __('Enter First Name'), ' required']) }}
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-end">
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary ">{{ __('Cancel') }}</a>
                        <button type="sub" class="btn btn-primary ">{{ __('Update ') }}</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
