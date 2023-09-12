@extends('layouts.main')
@section('title', __('Domain Request'))
@section('content')
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h4 class="m-b-10">{{ __('Domain Request List') }}</h4>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                                <li class="breadcrumb-item">{{ __('Domain Request') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table-responsive pb-4 dropdown_2">
                                <div class="container-fluid">
                                {{ $dataTable->table(['width' => '100%']) }}
                                </div>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
@endsection
@push('css')
    @include('layouts.includes.datatable_css')
@endpush
@push('javascript')
    @include('layouts.includes.datatable_js')
    {{ $dataTable->scripts() }}
    <script>
    $(function() {
        $('body').on('click', '.reason', function() {
            var action = $(this).data('action');
            var modal = $('#common_modal');
            $.get(action, function(response) {
                modal.find('.modal-title').html('{{ __('Disapprove Reason') }}');
                modal.find('.modal-body').html(response.html);
                modal.modal('show');
            })
        });
    });
</script>

@endpush
