{{-- user info and avatar --}}
<div class="avatar av-l">

        @if (tenant('id') == null)
            <img alt="image"
                src="{{ Auth::user()->avatar ? Storage::url(Auth::user()->avatar) : asset('assets/img/avatar/avatar-1.png') }}"
                class="rounded-circle mr-1">
        @else
            @if (config('filesystems.default') == 'local')

                <img id="avatar-img " class="rounded-circle mr-1 imgs"
                    src="{{ Auth::user()->avatar ? Storage::url(tenant('id') . '/' . Auth::user()->avatar) : asset('assets/img/avatar/avatar-1.png') }}"
                    alt="User profile picture">
            @else
                <img id="avatar-img " class="rounded-circle mr-1 imgs"
                    src="{{ Auth::user()->avatar ? Storage::url(Auth::user()->avatar) : asset('assets/img/avatar/avatar-1.png') }}"
                    alt="User profile picture">
            @endif
        @endif
</div>
<p class="info-name">{{ config('chatify.name') }}</p>
<div class="messenger-infoView-btns">
    {{-- <a href="#" class="default"><i class="ti ti-camera"></i> default</a> --}}
    <a href="#" class="danger delete-conversation"><i class="ti ti-trash-alt"></i> {{ __('Delete Conversation') }}</a>
</div>
{{-- shared photos --}}
<div class="messenger-infoView-shared">
    <p class="messenger-title">{{ __('shared photos') }}</p>
    <div class="shared-photos-list"></div>
</div>
