 @php
     use Carbon\Carbon;
     use App\Models\Setting;
     
     $currency_symbol = tenancy()->central(function ($tenant) {
         return Setting::whereNull('tenant_id')
             ->where('key', 'currency_symbol')
             ->first()->value;
     });
 @endphp
 @extends('layouts.main')
 @if (Auth::user()->type == 'Super Admin')
     @section('title', __('Plans List'))
 @else
     @section('title', __('Pricing'))
 @endif
 @section('content')
     @hasrole('Super Admin')
         <div class="page-header">
             <div class="page-block">
                 <div class="row align-items-center">
                     <div class="col-md-12">
                         <div class="page-header-title">
                             <h4 class="m-b-10">{{ __('Plans List') }}</h4>
                         </div>
                         <ul class="breadcrumb">
                             <li class="breadcrumb-item active"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                             <li class="breadcrumb-item">{{ __('Plans') }}</li>
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
     @endhasrole
     @hasrole('Admin')
         <div class="page-header">
             <div class="page-block">
                 <div class="row align-items-center">
                     <div class="col-md-12">
                         <div class="page-header-title">
                             <h4 class="m-b-10">{{ __('Pricing') }}</h4>
                         </div>
                         <ul class="breadcrumb">
                             <li class="breadcrumb-item active"><a href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                             <li class="breadcrumb-item">{{ __('Plans') }}</li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
         <div class="card-body">
             <section id="price" class="row price-section">
                 <div class="container">
                     <div class="row ">
                         @foreach ($plans as $plan)
                             <div class="col-lg-3">
                                 <div class="card price-card price-1 wow animate__fadeInUp" data-wow-delay="0.2s"
                                     style=" visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                     <div class="card-body">
                                         <span class="price-badge bg-primary">{{ $plan->name }}</span>
                                         <span class="mb-4 f-w-600 p-price"> {{ $currency_symbol . '' . $plan->price }}<small
                                                 class="text-sm">/{{ $plan->duration . ' ' . $plan->durationtype }}</small></span>
                                         <p class="mb-0">
                                         </p>
                                         @if (Auth::user()->type != 'Supar Admin')
                                             <ul class="list-unstyled my-5">
                                                 <li>
                                                     <span class="theme-avtar">
                                                         <i class="text-primary ti ti-circle-plus"></i></span>
                                                     {{ $plan->max_users . ' ' . __('Users') }}
                                                 </li>
                                         @endif
                                         @if (Auth::user()->type != 'Admin')
                                             <li> <span class="theme-avtar"> <i
                                                         class="text-primary ti ti-circle-plus"></i></span>
                                                 {{ $plan->max_form . ' ' . __('Forms') }} </li>
                                         @endif
                                         </ul>
                                         <div class="d-grid text-center">
                                             @if ($plan->id != 1)
                                                 <div class="pricing-cta">
                                                     @if ($plan->id == $user->plan_id && !empty($user->plan_expired_date))
                                                         <a href="javascript:void(0)" data-id="{{ $plan->id }}"
                                                             class="btn mb-3 btn-primary d-flex justify-content-center align-items-center mx-sm-5"
                                                             data-amount="{{ $plan->price }}">{{ __('Expire at') }}
                                                             {{ Carbon::parse($user->plan_expired_date)->format('d/m/Y') }}</a>
                                                     @else
                                                         <a href="javascript:void(0)"
                                                             class="subscribe_plan  btn mb-3 btn-primary d-flex justify-content-center align-items-center mx-sm-5"
                                                             data-id="{{ $plan->id }}"
                                                             data-amount="{{ $plan->price }}">{{ __('Subscribe') }}
                                                             <i class="ti ti-chevron-right ms-2"></i></a>
                                                     @endif
                                                 </div>
                                             @endif
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         @endforeach
                     </div>
                 </div>
                </section>



         </div>
     @endhasrole
 @endsection
 @hasrole('Super Admin')
     @push('css')
         @include('layouts.includes.datatable_css')
     @endpush
     @push('javascript')
         @include('layouts.includes.datatable_js')
         {{ $dataTable->scripts() }}
     @endpush
 @endhasrole
 @hasrole('Admin')

     @push('javascript')
         <script src="https://js.stripe.com/v3/"></script>
         <script>
             const stripe = Stripe('{{ env('STRIPE_KEY') }}');
             $(document).on('click', '.subscribe_plan', function(evt) {


                 var price = $(this).data('amount');

                 var plan_id = $(this).data('id');

                 var data = {
                     "_token": "{{ csrf_token() }}",
                     'price': price,
                     'plan_id': plan_id,
                 }

                 $.ajax({
                     url: "{{ route('stripe.pending.pay') }}",
                     method: 'POST',
                     data: data,
                     dataType: "json",
                     success: function(data) {
                         setLoading(true);
                         createCheckoutSession(plan_id, data.order_id).then(function(data) {
                             if (data.sessionId) {
                                 stripe.redirectToCheckout({
                                     sessionId: data.sessionId,
                                 }).then(handleResult);
                             } else {
                                 handleResult(data);
                             }
                         });
                     }
                 });

                 // var modal = $('#common_modal');

             });

             const createCheckoutSession = function(plan_id, order_id) {
                 return fetch("{{ route('stripe.session') }}", {
                     method: "POST",
                     headers: {
                         "Content-Type": "application/json",
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     },
                     body: JSON.stringify({
                         createCheckoutSession: 1,
                         plan_id: plan_id,
                         order_id: order_id,
                     }),
                 }).then(function(result) {
                     return result.json();
                 });
             };

             // Handle any errors returned from Checkout
             const handleResult = function(result) {
                 if (result.error) {
                     showMessage(result.error.message);
                 }

                 setLoading(false);
             };

             // Show a spinner on payment processing
             function setLoading(isLoading) {
                 if (isLoading) {
                     // Disable the button and show a spinner
                     // payBtn.disabled = true;
                     // document.querySelector("#spinner").classList.remove("hidden");
                     // document.querySelector("#buttonText").classList.add("hidden");
                 } else {
                     // Enable the button and hide spinner
                     // payBtn.disabled = false;
                     // document.querySelector("#spinner").classList.add("hidden");
                     // document.querySelector("#buttonText").classList.remove("hidden");
                 }
             }

             // Display message
             function showMessage(messageText) {
                 const messageContainer = document.querySelector("#paymentResponse");

                 messageContainer.classList.remove("hidden");
                 messageContainer.textContent = messageText;

                 setTimeout(function() {
                     messageContainer.classList.add("hidden");
                     messageText.textContent = "";
                 }, 5000);
             }
         </script>
         <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
         <script>
             // Send Stripe Token to Server
             function stripeTokenHandler(token) {
                 // Insert the token ID into the form so it gets submitted to the server
                 var form = document.getElementById('payment-form');

                 // Add Stripe Token to hidden input
                 var hiddenInput = document.createElement('input');
                 hiddenInput.setAttribute('type', 'hidden');
                 hiddenInput.setAttribute('name', 'stripeToken');
                 hiddenInput.setAttribute('value', token.id);
                 form.appendChild(hiddenInput);

                 // Submit form
                 form.submit();
             }
         </script>
     @endpush
     @endif
