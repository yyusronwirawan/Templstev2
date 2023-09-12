@extends('layouts.main')
@section('title', __('Edit plan'))
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-b-10">{{ __('Edit Plan') }}</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('plans.index') }}">{{ __('Plans') }}</a>
                        </li>
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
                    <h5>{{ __('Edit Plan') }}</h5>
                </div>
                <div class="card-body">
                    {!! Form::model($plan, ['route' => ['plans.update', $plan->id], 'method' => 'put', 'enctype' => 'multipart/form-data']) !!}

                    <div class="form-group  ">
                        {{ Form::label('name', __('Name')) }}
                        {!! Form::text('name', null, ['placeholder' => __('Name'), 'class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="form-group  ">
                        {{ Form::label('price', __('Price')) }}
                        {!! Form::text('price', null, ['placeholder' => __('Price'), 'class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="form-group ">
                        {{ Form::label('duration', __('Duration')) }}
                        <div class="row">
                            <div class="col-6">
                                {!! Form::number('duration', null, ['placeholder' => __('duration'), 'class' => 'form-control', 'required']) !!}
                            </div>
                            <div class="col-6">
                                <select class="form-select" size="1" name="durationtype" data-trigger>
                                    <option selected value="Month">{{ __('Month') }}</option>
                                    <option value="Year">{{ __('Year') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group  ">
                        {{ Form::label('max_users', __('Maximum users')) }}
                        {!! Form::number('max_users', null, ['placeholder' => __('Maximum users'), 'class' => 'form-control', 'required']) !!}
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-end">
                        <a href="{{ route('plans.index') }}" class="btn btn-secondary ">{{ __('Cancel') }}</a>
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
        $(document).on('change', '#role', function() {
            var roles = $(this).val();
            if (roles == 'Super Admin') {
                $('#domain').hide();
                $('#domain').val('');
            } else {
                $('#domain').show();
            }
        });

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var genericExamples = document.querySelectorAll('[data-trigger]');
            for (i = 0; i < genericExamples.length; ++i) {
                var element = genericExamples[i];
                new Choices(element, {
                    placeholderValue: 'This is a placeholder set in the config',
                    searchPlaceholderValue: 'This is a search placeholder',
                });
            }
        });
    </script>
@endpush
