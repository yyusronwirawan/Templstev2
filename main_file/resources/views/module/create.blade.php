@extends('layouts.main')
@section('title', __('Create module'))
@section('title')
    {{ __('Create Module') }}
@endsection
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-b-10">{{ __('Create Module') }}</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('modules.index') }}">{{ __('Modules') }}</a>
                        </li>
                        <li class="breadcrumb-item">{{ __('Create') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 m-auto">
            <div class="card ">
                <div class="card-header">
                    <h5>{{ __('Create Module') }}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('modules.store') }}">
                        @csrf
                        <div class="form-group ">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input type="text" name="name" class="form-control" id="password"
                                placeholder="{{ __('Name') }}" required>
                            @if ($errors->has('module'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('module') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="name" class="form-label">{{ __('Permission') }}</label>
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <div class="custom-control form-check form-check  custom-control-inline">
                                <input type="checkbox" name="permissions[]" class="form-check-input" id="managepermission"
                                    value="M">
                                <label class="form-label" for="managepermission">
                                    {{ __('Manage') }}
                                </label>
                            </div>
                            <div class="custom-control form-check  custom-control-inline ">
                                <input type="checkbox" name="permissions[]" class="form-check-input" id="createpermission"
                                    value="C">
                                <label class="form-label" for="createpermission">
                                    {{ __('Create') }}
                                </label>
                            </div>
                            <div class="custom-control form-check  custom-control-inline">
                                <input type="checkbox" name="permissions[]" class="form-check-input" id="editpermission"
                                    value="E">
                                <label class="form-label" for="editpermission">
                                    {{ __('Edit') }}
                                </label>
                            </div>
                            <div class="custom-control form-check  custom-control-inline">
                                <input type="checkbox" name="permissions[]" class="form-check-input" id="deletepermission"
                                    value="D">
                                <label class="form-label" for="deletepermission">
                                    {{ __('Delete') }}
                                </label>
                            </div>
                            <div class="custom-control form-check  custom-control-inline">
                                <input type="checkbox" name="permissions[]" class="form-check-input" id="showpermission"
                                    value="S">
                                <label class="form-label" for="showpermission">
                                    {{ __('Show') }}
                                </label>
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <div class="float-end">
                        <a href="{{ route('modules.index') }}" class="btn btn-secondary ">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-primary ">{{ __('Save') }} </button>
                        {!! Form::close() !!}
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
