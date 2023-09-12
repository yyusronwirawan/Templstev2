@extends('layouts.main')
@section('title', __('Edit user'))

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-b-10">{{ __('Edit Users') }}</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">{{ __('Users') }}</a>
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
                    <h5>{{ __('Edit Users') }}</h5>
                </div>
                <div class="card-body">
                    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'Put', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group ">
                        {{ Form::label('name', __('Name')) }}
                        {!! Form::text('name', null, ['class' => 'form-control', ' required', 'placeholder' => __('Enter Name')]) !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('email', __('Email')) }}
                        <div class="input-group">

                            {!! Form::text('email', null, ['class' => 'form-control', ' required', 'placeholder' => __('Enter Email Address')]) !!}
                        </div>
                    </div>
                    @if (tenant('id') != null && $user->type != 'Admin')
                        <div class="form-group">
                            {{ Form::label('roles', __('Role')) }}
                            {!! Form::select('roles', $roles, $user->type, ['class' => 'form-control', 'id' => 'role']) !!}
                        </div>
                    @endif
                    @hasrole('Super Admin')
                        <div class="form-group" id="domain">
                            {{ Form::label('domains', __('Domain')) }}
                            {!! Form::text('domains', isset($user_domain->domain) ? $user_domain->domain : '', ['class' => 'form-control', 'id' => 'domain', ' required', 'placeholder' => __('Enter domain name')]) !!}
                        </div>
                    @endhasrole
                </div>
                <div class="card-footer">
                    <div class="btn-flt float-end">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary ">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-primary ">{{ __('Save') }}</button>
                    </div>
                </div>
                {!! Form::close() !!}
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
@endpush
