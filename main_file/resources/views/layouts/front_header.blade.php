<head>
    <title>@yield('title') | {{ Utility::getsettings('app_name') }}</title>

    @php
        $primary_color = \App\Facades\UtilityFacades::getsettings('color');
        if (isset($primary_color)) {
            $color = $primary_color;
        } else {
            $color = 'theme-1';
        }
    @endphp
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Dashboard Template Description" />
    <meta name="keywords" content="Dashboard Template" />
    <meta name="author" content="Rajodiya Infotech" />

    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('vendor/img/favicon.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/animate.min.css') }}" />
    <!-- font css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">
    <!-- vendor css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('assets/css/customizer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/notifier.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}" />
    @if (Utility::getsettings('rtl') == '1')
        <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}" id="main-style-link">
    @else
        @if (Utility::getsettings('dark_mode') == 'on')
            <link rel="stylesheet" href="{{ asset('assets/css/style-dark.css') }}">
        @else
            <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
        @endif
    @endif
    <link rel="stylesheet" href="{{ asset('vendor/css/custom.css') }}" />
</head>

<body class="{{ $color }}">
    <nav class="navbar navbar-expand-md navbar-dark default top-nav-collapse">
        <div class="container">
            <a class="navbar-brand bg-transparent" href="{{ route('landingpage') }}">
                <img src="{{ Utility::getpath('logo/app-logo.png') }}" alt="logo-lg" class="w-49" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
                aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav align-items-center ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('landingpage') }}">{{ __('Home') }}</a>
                    </li>
                    @if (tenant('id') != null)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('view.post') }}">{{ __('Blogs') }}</a>
                        </li>
                    @endif
                    @if (tenant('id') == null)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}/#pricing">{{ __('Plans') }}</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/home') }}">{{ __('Login') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
