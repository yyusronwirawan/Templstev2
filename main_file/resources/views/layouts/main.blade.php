<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ \App\Facades\UtilityFacades::getsettings('rtl') == '1' ? 'rtl' : '' }}">

<head>
    @php
        $primary_color = \App\Facades\UtilityFacades::getsettings('color');
        if (isset($primary_color)) {
            $color = $primary_color;
        } else {
            $color = 'theme-1';
        }
    @endphp
    <title>@yield('title') | {{ Utility::getsettings('app_name') }}</title>

      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('vendor/img/favicon.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/notifier.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <!-- font css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('assets/css/customizer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/bootstrap-switch-button.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/modules/summernote/summernote-bs4.css') }}">

    @if (Utility::getsettings('rtl') == '1')
        <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}" id="main-style-link">
    @else
        @if (Utility::getsettings('dark_mode') == 'on')
            <link rel="stylesheet" href="{{ asset('assets/css/style-dark.css') }}">
        @else
            <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
        @endif
    @endif
    <link rel="stylesheet" href="{{ asset('vendor/css/custom.css') }}">
    @stack('css')

</head>

<body class="{{ $color }}">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Mobile header ] start -->
    <div class="dash-mob-header dash-header">
        <div class="pcm-logo">
            <img src="{{ asset('vendor/img/tenancy-white.png') }}" alt="" class="logo logo-lg" />
        </div>
        <div class="pcm-toolbar">
            <a href="#!" class="dash-head-link" id="mobile-collapse">
                <div class="hamburger hamburger--arrowturn">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
                <!-- <i data-feather="menu"></i> -->
            </a>
            <a href="#!" class="dash-head-link" id="header-collapse">
                <i data-feather="more-vertical"></i>
            </a>
        </div>
    </div>
    <!-- [ Mobile header ] End -->

    <!-- [ navigation menu ] start -->
    <nav class="dash-sidebar light-sidebar transprent-bg">
        <div class="navbar-wrapper">
            <div class="m-header text-center">
                <a href="{{ route('home') }}" class="b-brand">
                    <!-- ========   change your logo hear   ============ -->

                    @if (Utility::getsettings('dark_mode') == 'on')
                    <img src="{{ Utility::getpath('logo/app-logo.png') }}" alt="" class="logo logo-lg w-50" />
                    @else
                    <img src="{{ Utility::getpath('logo/app-dark-logo.png') }}" alt="" class="logo logo-lg w-50" />
                    @endif
                </a>
            </div>
            <div class="navbar-content active dash-trigger">
                @include('layouts.sidebar')
            </div>
        </div>
    </nav>
    @include('layouts.header')


<div class="dash-container">
    <div class="dash-content">
        @yield('content')
    </div>
</div>
<div class="modal fade" id="common_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
@include('layouts.footer')

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>

<script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/dash.js') }}"></script>
<script src="{{ asset('assets/js/plugins/notifier.js') }}"></script>
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('vendor/chart.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/choices.min.js') }}"></script>
<script src="{{ asset('vendor/modules/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('vendor/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('vendor/js/custom.js') }}"></script>
<script src="{{asset('assets/js/plugins/sweetalert2.all.min.js') }}"></script>

@include('layouts.includes.alerts')

@stack('javascript')

<script src="{{ asset('assets/js/plugins/bootstrap-switch-button.min.js') }}"></script>

<script>
    feather.replace();
    var pctoggle = document.querySelector("#pct-toggler");
    if (pctoggle) {
        pctoggle.addEventListener("click", function() {
            if (
                !document.querySelector(".pct-customizer").classList.contains("active")
            ) {
                document.querySelector(".pct-customizer").classList.add("active");
            } else {
                document.querySelector(".pct-customizer").classList.remove("active");
            }
        });
    }

    var themescolors = document.querySelectorAll(".themes-color > a");
    for (var h = 0; h < themescolors.length; h++) {
        var c = themescolors[h];

        c.addEventListener("click", function(event) {
            var targetElement = event.target;
            if (targetElement.tagName == "SPAN") {
                targetElement = targetElement.parentNode;
            }
            var temp = targetElement.getAttribute("data-value");
            removeClassByPrefix(document.querySelector("body"), "theme-");
            document.querySelector("body").classList.add(temp);
        });
    }


    function removeClassByPrefix(node, prefix) {
        for (let i = 0; i < node.classList.length; i++) {
            let value = node.classList[i];
            if (value.startsWith(prefix)) {
                node.classList.remove(value);
            }
        }
    }
</script>

</body>

</html>
