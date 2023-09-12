@extends('layouts.main')
@section('title', __('Create Blog'))
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-b-10">{{ __('Transaction') }}</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('blogs.index') }}">{{ __('Blogs') }}</a>
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
                    <h5>{{ __('Create Blog') }}</h5>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'blogs.store', 'method' => 'Post', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group">
                        {{ Form::label('title', __('Title'), ['class' => 'form-label']) }} *
                        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Enter title', 'required' => 'required']) !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('photo', __('Photo'), ['class' => 'form-label']) }} *
                        <input name="photo" type="file" id="photo" class="form-control">
                    </div>
                    <div class="form-group">
                        {{ Form::label('category_id', __('Category'), ['class' => 'form-label']) }} *
                        {!! Form::select('category_id', $category, null, ['class' => 'form-select']) !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('slug', __('Slug'), ['class' => 'form-label']) }} *
                        {!! Form::text('slug', null, ['class' => 'form-control ', 'placeholder' => 'Enter slug', 'required' => 'required']) !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('short_description', __('Short Description'), ['class' => 'form-label']) }} *
                        {!! Form::textarea('short_description', null, ['class' => 'form-control ', 'placeholder' => 'Enter short description', 'required' => 'required']) !!}
                    </div>

                    <div class="form-group">
                        {{ Form::label('description', __('Description'), ['class' => 'form-label']) }} *
                        {!! Form::textarea('description', null, ['class' => 'form-control ', 'placeholder' => 'Enter description', 'required' => 'required']) !!}
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-end">
                        <a href="{{ route('blogs.index') }}" class="btn btn-secondary ">{{ __('Cancel') }}</a>
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
        CKEDITOR.replace('description', {
            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endpush
