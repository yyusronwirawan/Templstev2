{!! Form::open(['route' => 'test.send.mail', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
<div class="row">
    <div class="form-group col-12 ">
        <label class="form-control-label" class="form-label" for="email">{{ __('Email') }}</label>
        <div class="input-group ">
            <input type="text" name="email" class="form-control" placeholder="{{ __('Enter Email') }} " required>
            @error('email')
                <span class="invalid-email" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
<hr>
<div class="float-right">
    <button class="btn btn-primary" type="submit" id="save-btn">{{ __('Send Email') }}</button>
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
</div>
{!! Form::close() !!}
