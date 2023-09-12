@component('mail::message')
<div class="section-body">
    <div class="row">
    <div class="card col-md-6 mx-auto">
    <div class="card-body">
<h3>Hi {{$domain_details->name}},</h3>
<br>

<p{{ __('>Your Domain <b>$domain_deta') }}ils->domain_name}}</b> {{__("is Verified By SuperAdmin
Please Check with by click below button")}}</p>

</div>
</div>
</div>

@component('mail::button', ['url' => $domain_details->domain_name])
    {{ __('Login') }}
@endcomponent


{{__('Thanks,')}}<br>
{{ config('app.name') }}
@endcomponent
