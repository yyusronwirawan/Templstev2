@extends('layouts.main')
@section('title', __('Language'))
@php
$users = \Auth::user();
$currantLang = $users->currentLanguage();
@endphp
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-b-10">{{ __('Create Language') }}</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('manage.language', [$currantLang]) }}">{{ __('Languages') }}</a></li>
                        <li class="breadcrumb-item">{{ __('Create') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <form class="form-horizontal" method="POST" action="{{ route('store.language') }}">
        @csrf
        <div class="row">
            <div class="col-xl-6 mx-auto order-xl-1">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ __('Create Language') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        {{ Form::label('code', __('Language Code'), ['class' => 'form-label']) }}
                                        {{ Form::text('code', '', ['class' => 'form-control', 'required' => 'required']) }}
                                        @if ($errors->has('code'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-end">
                            <button type="
                                        submit" class="btn btn-primary  btns">
                                {{ __('Create Language') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
