@extends('layouts.main')
@section('title', __('Languages'))
@section('content')
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h4 class="m-b-10">{{ __('Manage Language') }}</h4>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                                <li class="breadcrumb-item">{{ __('Languages') }}</li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                    <div id="output-status"></div>
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header d-inline-flex align-items-center">
                                <div class="col-lg-6  custom_left">
                                    <h5 style="left: -14px;">{{ __('Language') }}</h5>
                                </div>
                                <div class="col-lg-6  custom_right d-flex justify-content-end">

                                    {!! Form::open(['method' => 'DELETE', 'route' => ['lang.destroy', $currantLang], 'id' => 'delete-form-' . $currantLang]) !!}
                                    {!! Form::close() !!}
                                    <a href="{{ route('create.language', [$currantLang]) }}"
                                    class="btn custom-left float-right btn-primary  text-light btn-lg mr-1"
                                    id="create"> {{ __('Create') }}</a>
                                    <a href="#!" class="btn float-right custom-left btn-danger show_confirm text-light btn-lg "
                                        data-toggle="tooltip" data-original-title="{{ __('Delete') }}"
                                        data-confirm="{{ __('Are You Sure?') . ' | ' . __('This action can not be undone. Do you want to continue?') }}"
                                        data-confirm-yes="document.getElementById('delete-form-{{ $currantLang }}').submit();">
                                        <i class="ti ti-trash"></i> {{ __('Delete') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="row">

                        <div class="col-md-3 pt-3">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="nav nav-pills flex-column">
                                        @foreach ($languages as $lang)
                                            <li class="nav-item">
                                                <a href="{{ route('manage.language', [$lang]) }}"
                                                    class="nav-link {{ $currantLang == $lang ? 'active' : '' }}">{{ Str::upper($lang) }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        {{--  --}}
                        <div class="col-md-9 pt-3">
                            <div class="card" id="settings-card">

                                <div class="card-body">
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="account-details-tab" data-bs-toggle="pill"
                                                href="#account-details" role="tab" aria-controls="account-details"
                                                aria-selected="true">{{ __('Labels') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="login-details-tab" data-bs-toggle="pill"
                                                href="#login-details" role="tab" aria-controls="login-details"
                                                aria-selected="false">{{ 'Message' }}</a>
                                        </li>

                                    </ul>

                                    <div class="tab-content mt-3 mx-0">
                                        <div class="tab-pane active" id="account-details" role="tabpanel"
                                            aria-labelledby="account-details-tab">
                                            <form method="post" class="form-horizontal"
                                                action="{{ route('store.language.data', [$currantLang]) }}">
                                                @csrf
                                                <div class="row form-group">
                                                    @foreach ($arrLabel as $label => $value)
                                                        <div class="col-md-6">
                                                            <div class="mt-3">
                                                                <label class="form-label"
                                                                    for="example3cols1Input">{{ $label }}
                                                                </label>
                                                                <input type="text" class="form-control"
                                                                    name="label[{{ $label }}]"
                                                                    value="{{ $value }}">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="mt-4">
                                                    </div>
                                                    {{-- <hr />
                                                    <span class="float-end">
                                                        <div class="float-end">
                                                            <button type="submit"
                                                                class="btn btn-primary">{{ __('Save Changes') }}</button>
                                                        </div>
                                                    </span> --}}
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane" id="login-details" role="tabpanel"
                                            aria-labelledby="login-details-tab">
                                            <form method="post"
                                                action="{{ route('store.language.data', [$currantLang]) }}">
                                                @csrf
                                                <div class="row form-group">
                                                    @foreach ($arrMessage as $fileName => $fileValue)
                                                        <div class="col-lg-12">
                                                            <h3>{{ ucfirst($fileName) }}</h3>
                                                        </div>
                                                        @foreach ($fileValue as $label => $value)
                                                            @if (is_array($value))
                                                                @foreach ($value as $label2 => $value2)
                                                                    @if (is_array($value2))
                                                                        @foreach ($value2 as $label3 => $value3)
                                                                            @if (is_array($value3))
                                                                                @foreach ($value3 as $label4 => $value4)
                                                                                    @if (is_array($value4))
                                                                                        @foreach ($value4 as $label5 => $value5)
                                                                                            <div class="col-md-6">
                                                                                                <div
                                                                                                    class="mt-3">
                                                                                                    <label
                                                                                                        class="form-label">{{ $fileName }}.{{ $label }}.{{ $label2 }}.{{ $label3 }}.{{ $label4 }}.{{ $label5 }}</label>
                                                                                                    <input type="text"
                                                                                                        class="form-control"
                                                                                                        name="message[{{ $fileName }}][{{ $label }}][{{ $label2 }}][{{ $label3 }}][{{ $label4 }}][{{ $label5 }}]"
                                                                                                        value="{{ $value5 }}">
                                                                                                </div>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    @else
                                                                                        <div class="col-lg-6">
                                                                                            <div class="mt-3">
                                                                                                <label
                                                                                                    class="form-label">{{ $fileName }}.{{ $label }}.{{ $label2 }}.{{ $label3 }}.{{ $label4 }}</label>
                                                                                                <input type="text"
                                                                                                    class="form-control"
                                                                                                    name="message[{{ $fileName }}][{{ $label }}][{{ $label2 }}][{{ $label3 }}][{{ $label4 }}]"
                                                                                                    value="{{ $value4 }}">
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                @endforeach
                                                                            @else
                                                                                <div class="col-lg-6">
                                                                                    <div class="mt-1">
                                                                                        <label
                                                                                            class="form-label">{{ $fileName }}.{{ $label }}.{{ $label2 }}.{{ $label3 }}</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="message[{{ $fileName }}][{{ $label }}][{{ $label2 }}][{{ $label3 }}]"
                                                                                            value="{{ $value3 }}">
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        <div class="col-lg-6">
                                                                            <div class="mt-1">
                                                                                <label
                                                                                    class="form-label">{{ $fileName }}.{{ $label }}.{{ $label2 }}</label>
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    name="message[{{ $fileName }}][{{ $label }}][{{ $label2 }}]"
                                                                                    value="{{ $value2 }}">
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                <div class="col-lg-6">
                                                                    <div class="mt-1">
                                                                        <label
                                                                            class="form-label">{{ $fileName }}.{{ $label }}</label>
                                                                        <input type="text" class="form-control"
                                                                            name="message[{{ $fileName }}][{{ $label }}]"
                                                                            value="{{ $value }}">
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <form method="post" class="form-horizontal"
                                action="{{ route('store.language.data', [$currantLang]) }}">
                                @csrf
                                <div class="card-footer">
                                    <div class="float-end mb-3">
                                        <button type="submit"
                                            class="btn btn-primary float-end">{{ __('Save Changes') }}</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
@endsection
@push('style')
    <link href="{{ asset('assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
@endpush


@push('script')
    <script src="{{ asset('assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script>
        $(".inputtags").tagsinput('items');
        $(".custom_select").select2();
    </script>
@endpush
