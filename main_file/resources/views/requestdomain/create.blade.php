@extends('layouts.app')
@section('title', __('Register'))
@section('content')
    <div class="mx-3 mx-md-5 mb-5">
        <img src="{{ Utility::getpath('logo/app-dark-logo.png') }}" alt="logo" class="app-logo mt-5" width="175">
    </div>
    <div class="card">
        <div class="card-body mx-auto">
            <div class="">
                <h4 class="text-primary mt-2 mb-3">{{ __('Register') }}</h4>
            </div>
            <div class="text-start">
                <form method="POST" id="request_form" action="{{ route('requestdomain.store') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input id="name" type="text" placeholder="{{ __('Enter name') }}" class="form-control" name="name" required autocomplete="name"
                            autofocus>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input id="email" type="email" class="form-control" placeholder="{{ __('Enter email') }}" name="email" required autocomplete="email">
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="d-block  form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" placeholder="{{ __('Enter password') }}" class="form-control pwstrength" data-indicator="pwindicator"
                            name="password" required>
                        <div id="pwindicator" class="pwindicator">
                            <div class="bar"></div>
                            <div class="label"></div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password2" class="d-block">{{ __('Password Confirmation') }}</label> <input
                            id="password-confirm" type="password" class="form-control" placeholder="{{ __('Enter confirm password') }}" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>
                    <div class="form-group mb-3">
                        {{ Form::label('domains', __('Domain configration')) }}
                        {!! Form::text('domains', null, ['class' => 'form-control', 'required','placeholder' => __('Enter domain name')]) !!}
                        <span>{{ __('how to add-on domain in your hosting panel.') }}<a
                                href="{{ Storage::url('pdf/adddomain.pdf') }}" class="m-2"
                                target="_blank">{{ __('Document') }}</a></span>
                    </div>
                    <div class="form-group mb-4">
                        <div class="form-check">
                            <input type="checkbox" required name="agree" class="form-check-input" id="agree">
                            <label class="form-check-label" for="agree">{{ __('I agree with the') }}<a
                                    href="{{ route('termsandconditions') }}" class="m-2"
                                    target="_blank">{{ __('terms and conditions') }}</a></label>
                        </div>
                    </div>
                    @if ($plan_id == 1)
                        <div class="form-group d-grid">
                            <input type="hidden" id="plan_id" name="plan_id" value="{{ $plan_id }}">
                            <button type="submit" class="btn btn-primary  btn-block mt-2">
                                {{ __('Submit') }}
                            </button>
                        </div>
                    @else
                        <div class="form-group d-grid ">
                            <input type="hidden" class="" id="plan_id" name="plan_id"
                                value="{{ $plan_id }}">
                            <button type="button" class="subscribe_plan btn btn-primary  btn-block mt-2">
                                {{ __('Sign Up') }}
                            </button>
                        </div>
                    @endif
                </form>
                {{-- <p class="my-4">or register with</p>
            <div class="row mb-4">
                <div class="col-4">
                    <div class="d-grid"><button class="btn btn-light"><img
                                src="../assets/images/auth/img-facebook.svg" alt=""
                                class="img-fluid wid-25"></button></div>
                </div>
                <div class="col-4">
                    <div class="d-grid"><button class="btn btn-light"><img
                                src="../assets/images/auth/img-apple.svg" alt=""
                                class="img-fluid wid-25"></button></div>
                </div>
                <div class="col-4">
                    <div class="d-grid"><button class="btn btn-light"><img
                                src="../assets/images/auth/img-google.svg" alt=""
                                class="img-fluid wid-25"></button></div>
                </div>
            </div>
        </div> --}}

            </div>
        </div>
    @endsection
    @push('javascript')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');
        $(document).on('click', '.subscribe_plan', function(evt) {
            checked = $('#agree').is(':checked');
                if (!checked) {
                notifier.show('Error!', 'Please check terms and conditions', 'danger',
                    '{{ asset('assets/images/notification/high_priority-48.png') }}', 4000);
                return false;
            }
            var plan_id = $('#plan_id').val()
            var formdata = $('#request_form').serialize();
            $.ajax({
                url: "{{ route('requestdomain.store') }}",
                method: 'POST',
                data: formdata,
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    createCheckoutSession(plan_id, data.domainrequest_id, data.order_id).then(function(
                        data) {
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
        });
        const handleResult = function(result) {
            if (result.error) {
                showMessage(result.error.message);
            }

            setLoading(false);
        };


        function setLoading(isLoading) {
            if (isLoading) {

            } else {

            }
        }

        function showMessage(messageText) {
            const messageContainer = document.querySelector("#paymentResponse");

            messageContainer.classList.remove("hidden");
            messageContainer.textContent = messageText;

            setTimeout(function() {
                messageContainer.classList.add("hidden");
                messageText.textContent = "";
            }, 5000);
        }
        const createCheckoutSession = function(plan_id, domainrequest_id, order_id) {
            return fetch("{{ route('pre.stripe.session') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: JSON.stringify({
                    createCheckoutSession: 1,
                    plan_id: plan_id,
                    order_id: order_id,
                    domain_id: domainrequest_id
                }),
            }).then(function(result) {
                console.log(result);
                return result.json();
            });
        };
    </script>
@endpush
