<form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation" id="payment-form">
    @csrf

    <div id="card-element">
        <!-- a Stripe Element will be inserted here. -->
    </div>
    <span id="card-errors" class="payment-errors" style="color: red; font-size: 22px; "></span>
    <div class="row">
        <div>
            <input type="hidden" name="plan_id" id="plan_id">
            <button id="pay_btn" class="btn btn-primary  btn-lg btn-block" type="submit">{{ __('Pay Now') }}
            </button>
        </div>
    </div>
</form>
