@extends('layouts.main')
@section('title', __('Create Category'))

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-b-10">{{ __('Create Category') }}</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active"><a
                                href="{{ route('category.index') }}">{{ __('Category') }}</a>
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
                    <h5>{{ __('Create Category') }}</h5>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'category.store', 'method' => 'Post', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group  ">
                        {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
                        {!! Form::text('name', null, ['placeholder' => __('Enter name'), 'class' => 'form-control', 'required']) !!}
                    </div>

                    <div class="form-group">
                        {{ Form::label('status', __('Status'), ['class' => 'form-label']) }}
                        {!! Form::select('status', ['1' => 'Active', '0' => 'Deactive'], 'Active', ['class' => 'form-select']) !!}
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-end">
                        <a href="{{ route('category.index') }}" class="btn btn-secondary ">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-primary ">{{ __('Save') }} </button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('javascript')
    <script>
        $(document).ready(function() {
            $('.custom_select').select2();
        });
    </script>
@endpush
