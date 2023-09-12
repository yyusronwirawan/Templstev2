@if ($requestdomain->is_approved == 0)
    <div class="btn-group me-2">
        <button class="custom_btn btn  btn-primary  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">{{ __('Action') }}</button>
        <div class="dropdown-menu table-dropdown p-0">
            <a class="dropdown-item" href="{{ route('requestdomain.edit', $requestdomain->id) }}">
                <i class="ti ti-edit"></i>{{ __('Edit') }}</a>
            <a class="dropdown-item" href="{{ route('approverequestdomain.status', $requestdomain->id) }}">
                <i class="ti ti-access-point"></i>{{ __('Approved') }}
            </a>
            <a class="dropdown-item" href="javascript:void(0)"
                data-action="/request-domain/disapprove/{{ $requestdomain->id }}">
                <i class="ti ti-access-point-off"></i>{{ __('Disapprove') }}
            </a>
            {!! Form::open(['method' => 'DELETE', 'route' => ['requestdomain.destroy', $requestdomain->id], 'id' => 'delete-form-' . $requestdomain->id]) !!}
            <a class="dropdown-item  show_confirm text-danger" data-toggle="tooltip" href="#!">
                <i class="ti ti-trash text-danger"></i>{{ __('Delete') }}</a>
            {!! Form::close() !!}
        </div>
    </div>
@endif
