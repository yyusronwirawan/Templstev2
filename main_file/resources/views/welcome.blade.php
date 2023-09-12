@php
$currency = tenancy()->central(function ($tenant) {
    return Utility::getsettings('currency_symbol');
});
@endphp
@section('title')
    {{ __('Home') }}
@endsection
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ \App\Facades\UtilityFacades::getsettings('rtl') == '1' ? 'rtl' : '' }}">

    @include('layouts.front_header')
    <!-- [ Nav ] start -->


    <header id="home" class="bg-primary">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-sm-5">
                    <h1 class="text-white mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.2s">
                        {{ Utility::getsettings('app_name') }}
                    </h1>

                    <h2 class="text-white mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.4s">
                        {{ __('Tenancy for Laravel') }}<br />
                    </h2>
                    <p class="mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.6s">
                        {{__('A flexible multi-tenancy package for Laravel. Single & multi-database tenancy, automatic & manual
                        mode, event-based architecture. Integrates perfectly with other packages.')}}
                    </p>
                </div>
                <div class="col-sm-5">
                    <img src="{{ asset('assets/images/front/header-mokeup.svg') }}" alt="Datta Able Admin Template"
                        class="img-fluid header-img wow animate__fadeInRight" data-wow-delay="0.2s" />
                </div>
            </div>
        </div>
    </header>
    <!-- [ Header ] End -->
    <!-- [ dashboard ] start -->
    <section class="">
        <div class="container">
            <div class="row align-items-center justify-content-end mb-5">
                <div class="col-sm-4">
                    <h1 class="mb-sm-4 f-w-600 wow animate__fadeInLeft" data-wow-delay="0.2s">
                        {{ __('Dashboard') }}
                    </h1>
                    <h2 class="mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.4s">
                        {{__("All in one place")}} <br />{{ __("CRM system") }}
                    </h2>
                    <p class="mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.6s">
                        {{__('these awesome forms to login or create new account in your
                        project for free.')}}
                    </p>
                
                </div>
                <div class="col-sm-6">
                    <img src="{{ asset('vendor/img/dashboard.png')}}" alt="Datta Able Admin Template"
                        class="img-fluid header-img wow animate__fadeInRight" data-wow-delay="0.2s" />
                </div>
            </div>
            <div class="row align-items-center justify-content-start">
                <div class="col-sm-6">
                    <img src="{{ asset('assets/images/front/img-crm-dash-2.svg')}}" alt="Datta Able Admin Template"
                        class="img-fluid header-img wow animate__fadeInLeft" data-wow-delay="0.2s" />
                </div>
                <div class="col-sm-4">
                    <h1 class="mb-sm-4 f-w-600 wow animate__fadeInRight" data-wow-delay="0.2s">
                        {{ __('Dashboard') }}
                    </h1>
                    <h2 class="mb-sm-4 wow animate__fadeInRight" data-wow-delay="0.4s">
                        {{ __('All in one place') }} <br />{{ __('CRM system') }}
                    </h2>
                    <p class="mb-sm-4 wow animate__fadeInRight" data-wow-delay="0.6s">
                        {{__('These awesome forms to login or create new account in your
                        project for free.')}}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- [ dashboard ] End -->
    @if (tenant('id') != null)
    <section id="feature" class="feature" >
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-9 title">
                    <h2>
                        <span class="d-block mb-3">{{ __('Posts') }}</span>
                    </h2>
                    <p class="m-0">
                        {{__('These awesome forms to login or create new account in your
                        project for free.')}}
                    </p>
                </div>
            </div>

            <div class="row all_posts">
             @foreach ($posts as $post)
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <img class="img-fluid card-img-top card-img-custom"
                        src="{{ Storage::url(tenant('id') . '/' . $post->photo) }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">
                            {{ substr($post->short_description, 0, 75) . (strlen($post->short_description) > 75 ? '...' : '') }}
                        </p>
                        <a href="{{ route('post.details', $post->slug) }}">{{ __('Read More') }} <i
                                class="ti ti-chevron-right"></i></a>
                    </div>
                </div>
            </div>
             @endforeach
            </div>

           
        </div>
    </section>
    @endif
    <!-- [ feature ] End -->
    <!-- [ dashboard ] start -->
   

    @if (tenant('id') == null)

    <section id="price" class="price-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-9 title">
                    <h2>
                        <span class="d-block mb-3">{{ __('Price') }}</span> {{__('All in one place CRM
                        system')}}
                    </h2>
                    <p class="m-0">
                        {{__('These awesome forms to login or create new account in your
                        project for free.')}}
                    </p>
                </div>
            </div>
            <div class="row justify-content-center" id="pricing">
                @foreach ($plans as $plan)
                    <div class="col-lg-4 col-md-6">
                        <div class="card price-card price-1 wow animate__fadeInUp" data-wow-delay="0.2s"
                            style="visibility: visible;animation-delay: 0.2s;animation-name: fadeInUp;overflow: inherit;">
                            <div class="card-body">
                                @if ($plan->id == 1)
                                    <span class="price-badge bg-primary">{{ __('Free') }}</span>
                                @elseif ($plan->id != 1)
                                    <span class="price-badge bg-primary">{{ __('Subscribe') }}</span>
                                @endif
                                <span class="mb-4 f-w-600 p-price">{{ $currency . '' . $plan->price }}<small
                                        class="text-sm"></small></span>
                                <p class="mb-0">
                                    {{ $plan->duration . ' ' . $plan->durationtype }}
                                </p>
                                <ul class="list-unstyled my-5">
                                    <li>
                                        <span class="theme-avtar">
                                            <i class="text-primary ti ti-circle-plus"></i></span>
                                        {{ $plan->max_users . ' ' . __('Users') }}
                                    </li>
                                    
                                </ul>
                                @if ($plan->id == 1)
                                    <div class="d-grid text-center justify-content-center">
                                        <a href="{{ route('requestdomain.create', Crypt::encrypt(['plan_id' => $plan->id])) }}"
                                            class="subscribe_plan" data-id="{{ $plan->id }}"
                                            data-amount="{{ $plan->price }}"> <button
                                                class="btn mb-3 btn-primary d-flex justify-content-center align-items-center mx-sm-5">{{ __('Free') }}<i
                                                    class="ti ti-chevron-right ms-2"></i></button>
                                        </a>
                                    </div>
                                @elseif ($plan->id != 1)
                                    <div class="d-grid text-center justify-content-center">
                                        <a href="{{ route('requestdomain.create', Crypt::encrypt(['plan_id' => $plan->id])) }}"
                                            class="subscribe_plan" data-id="{{ $plan->id }}"
                                            data-amount="{{ $plan->price }}"> <button
                                                class="btn mb-3 btn-primary d-flex justify-content-center align-items-center mx-sm-5">{{
                                                __('Subscribe') }}<i class="ti ti-chevron-right ms-2"></i></button>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- [ price ] End -->
    <!-- [ faq ] start -->
    <section class="faq">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-9 title">
                    <h2><span>{{ __("Frequently") }}</span>{{ __("Asked Questions") }}</h2>
                    <p class="m-0">
                        {{__("These awesome forms to login or create new account in your
                        project for free.")}}
                    </p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-10 col-xxl-8">
                    <div class="accordion accordion-flush" id="accordionExample">
                        <div class="accordion-item card">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <span class="d-flex align-items-center">
                                        <i class="ti ti-info-circle text-primary"></i> {{__('How do I
                                        order?')}}
                                    </span>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>{{ __("Lorem Ipsum") }}</strong> {{__("It
                                    is shown by until the collapse plugin adds the
                                    appropriate classes that we to style each element. These
                                    classes control the overall appearance,well the
                                    showing and hiding via CSS transitions. You can modify any
                                    of this with custom CSS or overriding our variables.
                                    Its also worth noting that just about any HTML can go
                                    within the <code>.accordion-body</code>, though the
                                    transition does limit overflow.")}}
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item card">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span class="d-flex align-items-center">
                                        <i class="ti ti-info-circle text-primary"></i> {{__("How do I
                                        order?")}}
                                    </span>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>{{ __("This is the second items accordion body.") }}</strong>
                                    {{__("It is hidden by , until the collapse plugin adds the
                                    appropriate classes that we to style each element. These
                                    classes control the overall appearance, as well as the
                                    showing and hiding via CSS transitions. You can modify any
                                    of this with custom CSS or overriding our default variables.
                                    Its also worth noting that just about any HTML can go
                                    within the <code>.accordion-body</code>, though the
                                    transition does limit overflow.")}}
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item card">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <span class="d-flex align-items-center">
                                        <i class="ti ti-info-circle text-primary"></i> {{__("How do I
                                        order?")}}
                                    </span>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>{{ __("This is the third items accordion body.") }}</strong> {{__("It
                                    is hidden by default, until the collapse plugin adds the
                                    appropriate classes that we to style each element. These
                                    classes control the overall appearance, as well as the
                                    showing and hiding via CSS transitions. You can modify any
                                    of this with custom CSS or overriding our default variables.
                                    Its also worth noting that just about any HTML can go
                                    within the <code>.accordion-body</code>, though the
                                    transition does limit overflow.")}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ faq ] End -->
    <!-- [ dashboard ] start -->
    <section class="side-feature">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-3">
                    <h1 class="mb-sm-4 f-w-600 wow animate__fadeInLeft" data-wow-delay="0.2s">
                        {{ __("Dashboard") }}
                    </h1>
                    <h2 class="mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.4s">
                        {{ __("All in one place") }} <br />{{ __("CRM system") }}
                    </h2>
                    <p class="mb-sm-4 wow animate__fadeInLeft" data-wow-delay="0.6s">
                        {{__("These awesome forms to login or create new account in your
                        project for free.")}}
                    </p>
                </div>
                <div class="col-sm-9">
                    <div class="row feature-img-row">
                        <div class="col-3">
                            <img src="{{ asset('vendor/img/dash1.png')}}"
                                class="img-fluid header-img wow animate__fadeInRight" data-wow-delay="0.2s"
                                alt="Admin" />
                        </div>
                        <div class="col-3">
                            <img src="{{ asset('vendor/img/profile.png')}}"
                                class="img-fluid header-img wow animate__fadeInRight" data-wow-delay="0.4s"
                                alt="Admin" />
                        </div>
                        <div class="col-3">
                            <img src="{{ asset('vendor/img/users.png')}}"
                                class="img-fluid header-img wow animate__fadeInRight" data-wow-delay="0.6s"
                                alt="Admin" />
                        </div>
                        <div class="col-3">
                            <img src="{{ asset('vendor/img/roles.png')}}"
                                class="img-fluid header-img wow animate__fadeInRight" data-wow-delay="0.8s"
                                alt="Admin" />
                        </div>
                        <div class="col-3">
                            <img src="{{ asset('vendor/img/settings.png')}}"
                                class="img-fluid header-img wow animate__fadeInRight" data-wow-delay="0.3s"
                                alt="Admin" />
                        </div>
                        <div class="col-3">
                            <img src="{{ asset('vendor/img/modules.png')}}"
                                class="img-fluid header-img wow animate__fadeInRight" data-wow-delay="0.5s"
                                alt="Admin" />
                        </div>
                        <div class="col-3">
                            <img src="{{ asset('vendor/img/transaction.png')}}"
                                class="img-fluid header-img wow animate__fadeInRight" data-wow-delay="0.7s"
                                alt="Admin" />
                        </div>
                        <div class="col-3">
                            <img src="{{ asset('vendor/img/manage-language.png')}}"
                                class="img-fluid header-img wow animate__fadeInRight" data-wow-delay="0.9s"
                                alt="Admin" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ dashboard ] End -->
    <!-- [ dashboard ] start -->
    @include('layouts.front_footer')
    <!-- [ dashboard ] End -->
    <!-- Required Js -->

</body>
</html>
