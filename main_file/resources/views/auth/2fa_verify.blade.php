@extends('layouts.app')
@section('title', __('2FA'))
@section('content')
    <div class="mx-3 mx-md-5 mb-5" style="margin-top:195px;">
        <img src="{{ Utility::getpath('logo/app-dark-logo.png') }}" alt="logo" class="app-logo mt-5" width="175">
    </div>
    <div class="card">
        <div class="card-body mx-auto">
            <div class="">
                <h4 class="text-primary mt-2 mb-3">{{ __('Two Factor Authentication') }}</h4>
            </div>
            <form class="form-horizontal" action="{{ route('2faVerify') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('one_time_password-code') ? ' has-error' : '' }}">
                    <label for="one_time_password" class="control-label">{{ __('One Time Password') }}</label>
                    <input id="one_time_password" name="one_time_password" class="form-control col-md-4" type="text"
                        required />
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary  btn-block mt-2">{{ __('Authenticate') }}</button>
                </div>
            </form>
        </div>
    @endsection
    @push('javascript')
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

            var custthemebg = document.querySelector("#cust-theme-bg");
            custthemebg.addEventListener("click", function() {
                if (custthemebg.checked) {
                    document.querySelector(".dash-sidebar").classList.add("transprent-bg");
                    document
                        .querySelector(".dash-header:not(.dash-mob-header)")
                        .classList.add("transprent-bg");
                } else {
                    document.querySelector(".dash-sidebar").classList.remove("transprent-bg");
                    document
                        .querySelector(".dash-header:not(.dash-mob-header)")
                        .classList.remove("transprent-bg");
                }
            });

            var custdarklayout = document.querySelector("#cust-darklayout");
            custdarklayout.addEventListener("click", function() {
                if (custdarklayout.checked) {
                    document
                        .querySelector(".m-header > .b-brand > .logo-lg")
                        .setAttribute("src", "../assets/images/logo.svg");
                    document
                        .querySelector("#main-style-link")
                        .setAttribute("href", "../assets/css/style-dark.css");
                } else {
                    document
                        .querySelector(".m-header > .b-brand > .logo-lg")
                        .setAttribute("src", "../assets/images/logo-dark.svg");
                    document
                        .querySelector("#main-style-link")
                        .setAttribute("href", "../assets/css/style.css");
                }
            });

            function removeClassByPrefix(node, prefix) {
                for (let i = 0; i < node.classList.length; i++) {
                    let value = node.classList[i];
                    if (value.startsWith(prefix)) {
                        node.classList.remove(value);
                    }
                }
            }
        </script>
    @endpush
