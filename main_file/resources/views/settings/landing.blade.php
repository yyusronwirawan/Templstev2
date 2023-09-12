@extends('layouts.main')
@section('title', __('Landing Page'))
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-b-10">{{ __('Landing Page') }}</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                        <li class="breadcrumb-item">{{ __('Landing Page') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('Landing Page') }}</h5>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'landing.page.store', 'method' => 'Post', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group ">
                        {{ Form::label('footer_page_content', __('Footer page Content')) }}
                        {!! Form::textarea('footer_page_content', Utility::getsettings('footer_page_content'), ['class' => 'form-control', 'placeholder' => __('Enter Footer page Content')]) !!}
                    </div>
                    <div class="form-group ">
                        {{ Form::label('privacy', __('Privacy Page Content'), ['class' => 'form-label']) }}
                        {!! Form::textarea('privacy', Utility::getsettings('privacy'), ['class' => 'form-control', 'placeholder' => __('Enter Privacy page Content')]) !!}
                    </div>
                    <div class="form-group ">
                        {{ Form::label('contact_us', __('Contact Us Page Content'), ['class' => 'form-label']) }}
                        {!! Form::textarea('contact_us', Utility::getsettings('contact_us'), ['class' => 'form-control', 'placeholder' => __('Contact Us Page Content')]) !!}
                    </div>
                    <div class="form-group ">
                        {{ Form::label('term_condition', __('Term & Condition page Content'), ['class' => 'form-label']) }}
                        {!! Form::textarea('term_condition', Utility::getsettings('term_condition'), ['class' => 'form-control', 'placeholder' => __('Enter Term & condition page Content')]) !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('faq_page_content', __('FAQ'), ['class' => 'form-label']) }}

                        {!! Form::textarea('faq_page_content', Utility::getsettings('faq_page_content'), ['class' => 'form-control', 'placeholder' => __('Enter FAQ Content')]) !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('contact_email', __('Contact Email'), ['class' => 'form-label']) }}
                        {!! Form::text('contact_email', Utility::getsettings('contact_email'), ['class' => 'form-control', 'placeholder' => __('Enter Contact Email')]) !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('latitude', __('Latitude'), ['class' => 'form-label']) }}

                        {!! Form::text('latitude', Utility::getsettings('latitude'), ['class' => 'form-control', 'placeholder' => __('Enter Latitude')]) !!}
                    </div>
                    <div class="form-group">
                        {{ Form::label('longitude', __('Longitude'), ['class' => 'form-label']) }}

                        {!! Form::text('longitude', Utility::getsettings('longitude'), ['class' => 'form-control', 'placeholder' => __('Enter Longitude')]) !!}
                    </div>
                    <div class="form-group row">
                        <div class="col-md-8">
                            <label for="status_toggle">{{ __('Captcha Status') }}</label>
                        </div>
                        <div class="col-md-4 form-check form-switch custom-switch-v1">
                            <label class="form-label mt-2 custom-left float-end">
                                <input name="captcha_status" class="form-check-input input-primary" type="checkbox"
                                    {{ Utility::getsettings('captcha_status') == 0 ? 'unchecked' : 'checked' }}>
                            </label>
                        </div>
                    </div>
                    <div id="captcha_setting"
                        class="{{ Utility::getsettings('captcha_status') == 0 ? 'd-none' : 'block' }}">
                        <div class="form-group">
                            {{ Form::label('recaptcha_key', __('Recaptcha Key')) }}


                            {!! Form::text('recaptcha_key', Utility::getsettings('recaptcha_key'), ['class' => 'form-control', 'placeholder' => __('Enter recaptcha key')]) !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label('recaptcha_secret', __('Recaptcha Secret')) }}

                            {!! Form::text('recaptcha_secret', Utility::getsettings('recaptcha_secret'), ['class' => 'form-control', 'placeholder' => __('Enter recaptcha secret')]) !!}
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-end">
                        <a href="{{ route('home') }}" class="btn btn-secondary ">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-primary ">{{ __('Save') }}</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('javascript')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('footer_page_content', {
            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
    <script>
        CKEDITOR.replace('footer_page_content', {
            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
    <script>
        CKEDITOR.replace('privacy', {
            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
    <script>
        CKEDITOR.replace('contact_us', {
            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
    <script>
        CKEDITOR.replace('term_condition', {
            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
    <script>
        CKEDITOR.replace('faq_page_content', {
            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>
    <script>
        $(document).on('click', "input[name$='captcha_status']", function() {
            if (this.checked) {
                $('#captcha_setting').fadeIn(500);

                $("#captcha_setting").removeClass('d-none');
                $("#captcha_setting").addClass('d-block');
            } else {
                $('#captcha_setting').fadeOut(500);

                $("#captcha_setting").removeClass('d-block');
                $("#captcha_setting").addClass('d-none');

            }
        });
    </script>
@endpush
