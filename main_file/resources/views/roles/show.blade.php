@extends('layouts.main')
@section('title', __('All permission'))

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-b-10">{{ __('Add Permissions') }}</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('roles.index') }}">{{ __('Roles') }}</a>
                        </li>
                        <li class="breadcrumb-item">{{ __('Permissions') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h5>{{ __('Add Permission') }}</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('roles_permit', $role->id) }}">
                        @csrf

                            <table class="table table-flush permission-table">
                                <thead class="">
                                    <tr>
                                        <th width="200px">{{ __('Module') }}</th>
                                        <th>{{ __('Permissions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allmodules as $row)
                                        <tr>
                                            <td> {{ __(ucfirst($row)) }}</td>
                                            <td>
                                                <div class="row">
                                                    <?php $default_permissions = [__('manage'), __('create'), __('edit'), __('delete'), __('view'), __('impersonate')]; ?>
                                                    @foreach ($default_permissions as $permission)
                                                        @if (in_array($permission . '-' . $row, $allpermissions))
                                                            @php($key = array_search($permission . '-' . $row, $allpermissions))
                                                            <div class="col-3 form-check">
                                                                {{ Form::checkbox('permissions[]', $key, in_array($permission . '-' . $row, $permissions), ['class' => 'form-check-input','id' => 'permission_' . $key]) }}
                                                                {{ Form::label('permission_' . $key, ucfirst($permission), ['class' => 'form-check-label']) }}
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <?php $modules = []; ?>
                                    @foreach ($modules as $module)
                                        <?php $s_name = $module; ?>
                                        <tr>
                                            <td>
                                                {{ __(ucfirst($module)) }}
                                            </td>
                                            <td>
                                                <div class="row role-line">
                                                    @if (in_array('manage-' . $s_name, $allpermissions))
                                                        @php($key = array_search('manage-' . $s_name, $allpermissions))
                                                        <div class="col-3 form-check">
                                                            {{ Form::checkbox('permissions[]', $key, in_array($key, $permissions), ['class' => 'form-check-input','id' => 'permission_' . $key]) }}
                                                            {{ Form::label('permission_' . $key, 'Manage', ['class' => 'form-check-label']) }}
                                                        </div>
                                                    @endif
                                                    @if (in_array('create-' . $module, $allpermissions))
                                                        @php($key = array_search('create-' . $module, $allpermissions))
                                                        <div class="col-3 form-check">
                                                            {{ Form::checkbox('permissions[]', $key, in_array($key, $permissions), ['class' => 'form-check-input','id' => 'permission_' . $key]) }}
                                                            {{ Form::label('permission_' . $key, __('Create'), ['class' => 'form-check-label']) }}
                                                        </div>
                                                    @endif
                                                    @if (in_array('edit-' . $module, $allpermissions))
                                                        @php($key = array_search('edit-' . $module, $allpermissions))
                                                        <div class="col-3 form-check">
                                                            {{ Form::checkbox('permissions[]', $key, in_array($key, $permissions), ['class' => 'form-check-input','id' => 'permission_' . $key]) }}
                                                            {{ Form::label('permission_' . $key, __('Edit'), ['class' => 'form-check-label']) }}
                                                        </div>
                                                    @endif
                                                    @if (in_array('delete-' . $module, $allpermissions))
                                                        @php($key = array_search('delete-' . $module, $allpermissions))
                                                        <div class="col-3 form-check">
                                                            {{ Form::checkbox('permissions[]', $key, in_array($key, $permissions), ['class' => 'form-check-input','id' => 'permission_' . $key]) }}
                                                            {{ Form::label('permission_' . $key, __('Delete'), ['class' => 'form-check-label']) }}
                                                        </div>
                                                    @endif
                                                    @if (in_array('view-' . $module, $allpermissions))
                                                        @php($key = array_search('view-' . $module, $allpermissions))
                                                        <div class="col-3 form-check">
                                                            {{ Form::checkbox('permissions[]', $key, in_array($key, $permissions), ['class' => 'form-check-input','id' => 'permission_' . $key]) }}
                                                            {{ Form::label('permission_' . $key, __('View'), ['class' => 'form-check-label']) }}
                                                        </div>
                                                    @endif
                                                    @if (in_array('impersonate-' . $module, $allpermissions))
                                                        @php($key = array_search('impersonate-' . $module, $allpermissions))
                                                        <div class="col-3 form-check">
                                                            {{ Form::checkbox('permissions[]', $key, in_array($key, $permissions), ['class' => 'form-check-input','id' => 'permission_' . $key]) }}
                                                            {{ Form::label('permission_' . $key, __('Impersonate'), ['class' => 'form-check-label']) }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                </tbody>
                                @endforeach
                            </table>
                    </form>
                </div>
                <div class="card-footer">
                    <div class=" float-end">
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary ">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-primary  ">{{ __('Save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
