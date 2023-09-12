<div class="btn-group me-2">
    <button class="custom_btn btn  btn-primary  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">{{ __('Action') }}</button>
    <div class="dropdown-menu table-dropdown p-0">
        <a class="dropdown-item"  href="{{ route('category.edit', $category->id) }}" >
            <i class="ti ti-edit"></i>{{ __(' Edit') }}
        </a>
        {!! Form::open(['method' => 'DELETE', 'route' => ['category.destroy', $category->id], 'id' => 'delete-form-' . $category->id]) !!}
        <a class="dropdown-item  show_confirm text-danger" data-toggle="tooltip" href="#!"  ><i
            class="ti ti-trash text-danger"></i>{{ __('Delete') }}</a>
            {!! Form::close() !!}
    </div>
</div>
