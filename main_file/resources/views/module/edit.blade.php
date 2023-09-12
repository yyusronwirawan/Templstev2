@extends('layouts.main')
@section('title', __('Edit module'))
@section('title')
    {{ __('Edit Module') }}
@endsection
@section('content')
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h4 class="m-b-10">{{ __('Edit Module') }}</h4>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active"><a
                                        href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                                <li class="breadcrumb-item active"><a
                                        href="{{ route('modules.index') }}">{{ __('Modules') }}</a></li>
                                <li class="breadcrumb-item">{{ __('Edit') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-4 m-auto">
                        <div class="card">
                            <div class="card-header">
                                <h5>{{ __('Edit Module') }}</h5>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" method="POST"
                                    action="{{ route('modules.update', $module->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name" class="form-label">{{ __('Name') }}</label>
                                        <input type="text" name="name" class="form-control" value="{{ $module->name }}"
                                            placeholder="{{ __('Name') }}" required>
                                        @if ($errors->has('module'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('module') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="float-end">
                                        <a href="{{ route('modules.index') }}" class="btn btn-secondary ">{{ __('Cancel') }}</a>
                                        <button type="submit" class="btn btn-primary ">{{ __('Save') }} </button>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                                </form>
                        </div>
                    </div>
                </div>
@endsection
