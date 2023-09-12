@php
use Carbon\Carbon;
$users = \Auth::user();
$currantLang = $users->currentLanguage();
@endphp
@extends('layouts.main')
@section('title', __('Dashboard'))
@push('css')
    <link rel="stylesheet" href="{{ asset('vendor/jqvmap/dist/jqvmap.min.css') }}">
@endpush
@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h4 class="m-b-10">{{ __('Dashboard') }}</h4>
                    </div>
                    <ul class="breadcrumb">
                        <li class="section-header-breadcrumb"></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @if (tenant('id') == null)
            @if (!env('STRIPE_KEY') || !env('STRIPE_SECRET'))
                <div class="col-12">
                    <br>
                    <div class="alert alert-warning">{{ __('Please Set your Stripe key & Stripe Secret') }} - <a
                            href="{{ url('/settings') }}/#useradd-6">{{ __('Click') }}</a> </div>
                </div>
            @endif
            <div class="col-xl-3 col-6">
                <a href="users">
                    <div class="card comp-card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-b-20 text-muted">{{ __('Total Admin') }}</h6>
                                    <h3 class="">{{ $user }}</h3>
                                </div>
                                <div class="col-auto">
                                    <i class="ti ti-user bg-primary text-white text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endif
        @if (tenant('id') != null)
            @if ((!\App\Facades\UtilityFacades::getsettings('STRIPE_KEY') || !\App\Facades\UtilityFacades::getsettings('STRIPE_SECRET')) && Auth::user()->type == 'Super Admin')
                <div class="col-md-12">
                    <br>
                    <div class="alert alert-warning">{{ __('Please Set your Stripe key & Stripe Secret') }} - <a
                            href="{{ url('/settings') }}/#useradd-6">{{ __('Click') }}</a> </div>
                </div>
            @endif
            <div class="col-xl-3 col-6">
                <a href="users">

                    <div class="card comp-card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-b-20 text-muted">{{ __('Total Users') }}</h6>
                                    <h3 class="">{{ $user }}</h3>
                                </div>
                                <div class="col-auto">
                                    <i class="ti ti-users bg-primary text-white text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endif
        @if (tenant('id') == null)
            <div class="col-xl-3 col-6">
                <a href="plans">

                    <div class="card comp-card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-b-20 text-muted">{{ __('Plans') }}</h6>
                                    <h3 class="">{{ $plan }}</h3>
                                </div>
                                <div class="col-auto">
                                    <i class="ti ti-news bg-danger text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endif
        @if (tenant('id') != null)
            <div class="col-xl-3 col-6">
                <a href="roles">
                    <div class="card comp-card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-b-20 text-muted">{{ __('Roles') }}</h6>
                                    <h3 class="">{{ $role }}</h3>
                                </div>
                                <div class="col-auto">
                                    <i class="ti ti-shield-check bg-warning text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endif
        @if (tenant('id') == null)
            <div class="col-xl-3 col-6">
                <a href="{{ route('manage.language', [$currantLang]) }}">

                    <div class="card comp-card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-b-20 text-muted">{{ __('Language') }}</h6>
                                    <h3 class="">{{ $languages }}</h3>
                                </div>
                                <div class="col-auto">
                                    <i class="ti ti-world bg-success text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endif

        @if (tenant('id') == null)
            <div class="col-xl-3 col-6">
                <a href="sales">
                    <div class="card comp-card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-b-20 text-muted">{{ __('Earning') }}</h6>
                                    <h3 class="">{{ __('$') . ' ' . $earning }}</h3>
                                </div>
                                <div class="col-auto">
                                    <i class="ti ti-currency-dollar bg-warning text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endif
    </div>
    @if (tenant('id') == null)
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex;
                                                    justify-content: space-between;">
                        <h5>{{ __('Statistics') }}</h5>
                        <div class="btn-group" role="group">
                            <input type="radio" class="btn-check" autocomplete="off" name="btnradio1">
                            <label class="btn btn-light-primary active" id="option1"
                                for="btnradio1">{{ __('Week') }}</label>
                            <input type="radio" class="btn-check" autocomplete="off" name="btnradio2">
                            <label class="btn btn-light-primary" id="option2" for="btnradio2">{{ __('Month') }}</label>
                            <input type="radio" class="btn-check" autocomplete="off" name="btnradio3">
                            <label class="btn btn-light-primary" id="option3" for="btnradio3">{{ __('Year') }}</label>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" height="75"></canvas>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (tenant('id') != null)
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex;
                                                    justify-content: space-between;">
                        <h5>{{ __('Statistics') }}</h5  >
                        <div class="btn-group" role="group">
                            <input type="radio" class="btn-check" autocomplete="off" name="btnradio1">
                            <label class="btn btn-light-primary active" id="option1"
                                for="btnradio1">{{ __('Week') }}</label>
                            <input type="radio" class="btn-check" autocomplete="off" name="btnradio2">
                            <label class="btn btn-light-primary" id="option2" for="btnradio2">{{ __('Month') }}</label>
                            <input type="radio" class="btn-check" autocomplete="off" name="btnradio3">
                            <label class="btn btn-light-primary" id="option3" for="btnradio3">{{ __('Year') }}</label>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" height="75"></canvas>
                    </div>
                </div>
            </div>
        </div>
    @endif


@endsection
@push('javascript')

    @if (tenant('id') == null)
        <script>
            "use strict";

            var statistics_chart = document.getElementById("myChart").getContext('2d');

            var myChart = new Chart(statistics_chart, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: '{{ __('Total Earning') }}',
                        data: [],
                        borderWidth: 5,
                        borderColor: '#51459d',
                        backgroundColor: 'transparent',
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#51459d',
                        pointRadius: 4
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: false,
                                drawBorder: false,
                            },
                            // ticks: {
                            //     stepSize: 5
                            // }
                        }],
                        xAxes: [{
                            gridLines: {
                                color: '#fbfbfb',
                                lineWidth: 2
                            }
                        }]
                    },
                }
            })
            getChartData('week');

            $(document).on("click", "#option3", function() {

                getChartData('year');
                $('#option1').removeClass('active');
                $('#option2').removeClass('active');
                $('#option3').addClass('active');
            });

            $(document).on("click", "#option2", function() {
                getChartData('month');
                $('#option1').removeClass('active');
                $('#option3').removeClass('active');
                $('#option2').addClass('active');

            });
            $(document).on("click", "#option1", function() {
                getChartData('week');
                $('#option2').removeClass('active');
                $('#option3').removeClass('active');
                $('#option1').addClass('active');

            });


            function getChartData(type) {
                $.ajax({
                    url: "{{ route('get.chart.data') }}",
                    type: 'POST',
                    data: {
                        type: type,
                        "_token": "{{ csrf_token() }}",
                    },

                    success: function(result) {
                        myChart.data.labels = result.lable;
                        myChart.data.datasets[0].data = result.value;
                        myChart.update()
                    },
                    error: function(data) {
                        console.log(data.responseJSON);
                    }

                });
            }
        </script>
    @endif
    @if (tenant('id') != null)
        <script>
            "use strict";

            var statistics_chart = document.getElementById("myChart").getContext('2d');

            var myChart = new Chart(statistics_chart, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: '{{ __('Total Users') }}',
                        data: [],
                        borderWidth: 5,
                        borderColor: '#51459d',
                        backgroundColor: 'transparent',
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#51459d',
                        pointRadius: 4
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: false,
                                drawBorder: false,
                            },
                            ticks: {
                                stepSize: 5
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                color: '#fbfbfb',
                                lineWidth: 2
                            }
                        }]
                    },
                }
            })
            getChartData('week');
            $(document).on("click", "#option3", function() {
                getChartData('year');
                $('#option1').removeClass('active');
                $('#option2').removeClass('active');
                $('#option3').addClass('active');
            });

            $(document).on("click", "#option2", function() {
                getChartData('month');
                $('#option1').removeClass('active');
                $('#option3').removeClass('active');
                $('#option2').addClass('active');

            });
            $(document).on("click", "#option1", function() {
                getChartData('week');
                $('#option2').removeClass('active');
                $('#option3').removeClass('active');
                $('#option1').addClass('active');

            });

            function getChartData(type) {
                $.ajax({
                    url: "{{ route('get.chart.data') }}",
                    type: 'POST',
                    data: {
                        type: type,
                        "_token": "{{ csrf_token() }}",
                    },

                    success: function(result) {
                        myChart.data.labels = result.lable;
                        myChart.data.datasets[0].data = result.value;
                        myChart.update()
                    },
                    error: function(data) {
                        console.log(data.responseJSON);
                    }

                });
            }
        </script>
    @endif
@endpush
