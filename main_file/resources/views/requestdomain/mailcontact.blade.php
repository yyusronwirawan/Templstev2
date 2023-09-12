@component('mail::message')
<div class="section-body">
    <div class="row">
    <div class="card col-md-6 mx-auto">
    <div class="card-body">
<h3><b>{{__('Name')}}:</b> {{$details['name']}}</h3>
<br>
<p><b>{{__('Email')}}:</b> {{$details['email']}}</p>
<p><b>{{__('Contact No')}}:</b> {{$details['contact_no']}}</p>
<p><b>{{__('Message')}}:</b> {{$details['message']}}</p>


</div>
</div>
</div>

{{__('Contact,')}}<br>
{{ config('app.name') }}
@endcomponent
