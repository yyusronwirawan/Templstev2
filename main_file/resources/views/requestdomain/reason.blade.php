{!! Form::model($requestdomain, ['route' => ['requestdomain.disapprove', $requestdomain->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
<div class="form-group ">
    {{ Form::label('disapprove_reason', __('Disapprove Reason')) }}
        <div class="input-group-prepend">

        </div>
        {!! Form::textarea('disapprove_reason', null, ['class' => 'form-control', ' required', 'placeholder' => __('Enter Disapprove Reason')]) !!}
</div>
<a href="{{ route('requestdomain.index') }}" class="btn btn-secondary ">{{ __('Cancel') }}</a>
<button type="submit" class="btn btn-primary ">{{ __('Send') }}</button>
</div>
{!! Form::close() !!}
