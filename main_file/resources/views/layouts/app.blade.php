<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ \App\Facades\UtilityFacades::getsettings('rtl') == '1' ? 'rtl' : '' }}">

<head>
    @php
        $lang = \App\Facades\UtilityFacades::getValByName('default_language');
        $primary_color = \App\Facades\UtilityFacades::getsettings('color');
        if (isset($primary_color)) {
            $color = $primary_color;
        } else {
            $color = 'theme-4';
        }
    @endphp
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ Utility::getsettings('app_name') }}</title>

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
 <!-- Meta -->


 <!-- Favicon icon -->
 <link rel="icon" href="{{ asset('vendor/img/favicon.png') }}" type="image/x-icon" />

 <!-- font css -->
 <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
 <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
 <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
 <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">

 <!-- vendor css -->
 <link rel="stylesheet" href="{{ asset('assets/css/plugins/notifier.css') }}">
 <link rel="stylesheet" href="{{ asset('assets/css/customizer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
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
 <!-- [ auth-signup ] start -->
 <div class="auth-wrapper auth-v1">
  <div class="bg-auth-side bg-primary"></div>
  <div class="auth-content">

   <div class="row align-items-center justify-content-center text-start">
    <div class="col-xl-6 text-center">

     @yield('content')
     </div>
    </div>
</div>
     <div class="auth-footer" >
         <div class="container-fluid">
             <div class="row d-flex align-items-center" >
                 <div class="col-6">
                    @if (Utility::getsettings('dark_mode') == 'on')
                    <img src="{{ Utility::getpath('logo/app-logo.png') }}" alt="" class="text-center" style="width: 18%"/>
                    @else
                    <img src="{{ Utility::getpath('logo/app-dark-logo.png') }}" alt="" class="text-center" style="width: 18%" />
@endif
                    </div>
                    <div class="col-6 text-end">
                        © 2022, {{ config('app.name') }}
                    </div>
      </div>
  </div>
  </div>
 </div>
</div>
 <!-- [ auth-signup ] end -->

 <!-- Required Js -->
 {{-- <script src="{{ asset('assets/js/vendor-all.js') }}"></script>
 <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
 <script src="{{ asset('assets/js/plugins/notifier.js') }}"></script>
 <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
 <script src="{{ asset('assets/js/.3.js') }}"></script> --}}



 <script src="{{ asset('assets/js/vendor-all.js') }}"></script>
 <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
 <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
 <script src="{{ asset('vendor/modules/jquery.min.js') }}"></script>
 <script src="{{ asset('vendor/modules/popper.js') }}"></script>
 <script src="{{ asset('vendor/modules/tooltip.js') }}"></script>
 <script src="{{ asset('vendor/modules/bootstrap/js/bootstrap.min.js') }}"></script>
 <script src="{{ asset('vendor/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
 <script src="{{ asset('vendor/modules/moment.min.js') }}"></script>
 <script src="{{ asset('assets/js/scripts.js') }}"></script>
 <script src="{{ asset('assets/js/plugins/notifier.js') }}"></script>



    @include('layouts.includes.alerts')
    @stack('javascript')
 <script>
     feather.replace();
 </script>

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

     // var custsidebrand = document.querySelector("#cust-sidebrand");
     // custsidebrand.addEventListener('click', function () {
     //     if (custsidebrand.checked) {
     //         document.querySelector(".m-header").classList.add("bg-dark");
     //         document.querySelector(".theme-color.brand-color").classList.remove("d-none");
     //     } else {
     //         removeClassByPrefix(document.querySelector(".m-header"), 'bg-');
     //         // document.querySelector(".m-header > .b-brand > .logo-lg").setAttribute('src', '../assets/images/logo-dark.svg');
     //         document.querySelector(".theme-color.brand-color").classList.add("d-none");
     //     }
     // });

     // var brandcolor = document.querySelectorAll(".brand-color > a");
     // for (var t = 0; t < brandcolor.length; t++) {
     //     var c = brandcolor[t];
     //     c.addEventListener('click', function (event) {
     //         var targetElement = event.target;
     //         if (targetElement.tagName == "SPAN") {
     //             targetElement = targetElement.parentNode;
     //         }
     //         var temp = targetElement.getAttribute('data-value');
     //         if (temp == "bg-default") {
     //             removeClassByPrefix(document.querySelector(".m-header"), 'bg-');
     //         } else {
     //             removeClassByPrefix(document.querySelector(".m-header"), 'bg-');
     //             document.querySelector(".m-header > .b-brand > .logo-lg").setAttribute('src', '../assets/images/logo.svg');
     //             document.querySelector(".m-header").classList.add(temp);
     //         }
     //     });
     // }

     // var headercolor = document.querySelectorAll(".header-color > a");
     // for (var h = 0; h < headercolor.length; h++) {
     //     var c = headercolor[h];

     //     c.addEventListener('click', function (event) {
     //         var targetElement = event.target;
     //         if (targetElement.tagName == "SPAN") {
     //             targetElement = targetElement.parentNode;
     //         }
     //         var temp = targetElement.getAttribute('data-value');
     //         if (temp == "bg-default") {
     //             removeClassByPrefix(document.querySelector(".dash-header:not(.dash-mob-header)"), 'bg-');
     //         } else {
     //             removeClassByPrefix(document.querySelector(".dash-header:not(.dash-mob-header)"), 'bg-');
     //             document.querySelector(".dash-header:not(.dash-mob-header)").classList.add(temp);
     //         }
     //     });
     // }

     // var custside = document.querySelector("#cust-sidebar");
     // custside.addEventListener('click', function () {
     //     if (custside.checked) {
     //         document.querySelector(".dash-sidebar").classList.add("light-sidebar");
     //     } else {
     //         document.querySelector(".dash-sidebar").classList.remove("light-sidebar");
     //     }
     // });

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
