<div class="btn-group me-2">
    <button class="custom_btn btn btn-primary  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">{{ __('Action') }}</button>
    <div class="dropdown-menu table-dropdown p-0">
        @if ($user->active_status != 1)
            <a class="dropdown-item" href="account-status/{{ $user->id }}"><i class="ti ti-user-off"></i>{{ __('Deactive') }}</a>
        @else
            <a class="dropdown-item" href="account-status/{{ $user->id }}"><i class="ti ti-user-check"></i>{{ __('Active') }}</a>
        @endif
        <a class="dropdown-item" href="users/{{ $user->id }}/edit">
            <i class="ti ti-edit"></i>{{ __('Edit') }}
        </a>
        <a class="dropdown-item" href="users/{{ $user->id }}/impersonate">
            <i class="ti ti-database-import"></i>{{ __('Impersonate') }}
        </a>
        {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'id' => 'delete-form-' . $user->id]) !!}
        <a class="dropdown-item  show_confirm text-danger" data-toggle="tooltip" href="#!"  ><i
            class="ti ti-trash text-danger"></i>{{ __('Delete') }}</a>
            {!! Form::close() !!}
    </div>
</div>
