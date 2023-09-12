@component('mail::message')
<div class="section-body">
    <div class="row">
    <div class="card col-md-6 mx-auto">
    <div class="card-body">
<h3>Hi {{$domain_details->name}},</h3>
<br>

<p{{ __(">Your Domain <b>$domain_deta") }}ils->domain_name}}</b> {{ __("Is Disapprove By SuperAdmin") }} </p>
<p>Because {{$domain_details->disapprove_reason}}</p>
<p>{{ __('Please Contact to SuperAdmin') }}</p>

</div>
</div>
</div>



{{__('Thanks,')}}<br>
{{ config('app.name') }}
@endcomponent
