@php
$users = \Auth::user();
$currantLang = $users->currentLanguage();
$languages = Utility::languages();
@endphp
<header class="dash-header transprent-bg">
    <div class="header-wrapper">
        <div class="ms-auto">
            <ul class="list-unstyled">
                <li class="dropdown dash-h-item d-flex d-md-none">
                    <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ti ti-search"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dash-h-dropdown drp-search">
                        <form class="px-3">
                            <div class="form-group mb-0 d-flex align-items-center">
                                <i data-feather="search"></i>
                                <input type="search" class="form-control border-0 shadow-none"
                                    placeholder="{{ __('Search here. . .') }}" />
                            </div>
                        </form>
                    </div>
                </li>
                <li class="dropdown dash-h-item drp-language">
                    <a class="dash-head-link custom-headers dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown"
                        href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ti ti-world nocolor"></i>
                        <span class="drp-text hide-mob">{{ Str::upper($currantLang) }}</span>
                        <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                        @foreach ($languages as $language)
                            <a class="dropdown-item @if ($language == $currantLang) text-danger @endif"
                                href="{{ route('change.language', $language) }}">{{ Str::upper($language) }}</a>
                        @endforeach
                    </div>
                </li>
                <li class="dropdown dash-h-item drp-company">
                    <a class="dash-head-link custom-headers dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        @if (tenant('id') == null)
                            <img alt="image"
                                src="{{ Auth::user()->avatar ? Storage::url(Auth::user()->avatar) : asset('assets/img/avatar/avatar-1.png') }}"
                                class="user-avtar ms-2">
                        @else
                            @if (config('filesystems.default') == 'local')
                                <img id="avatar-img" class="user-avtar ms-2"
                                    src="{{ Auth::user()->avatar? Storage::url(tenant('id') . '/' . Auth::user()->avatar): asset('assets/img/avatar/avatar-1.png') }}"
                                    alt="User profile picture">
                            @else
                                <img id="avatar-img" class="user-avtar ms-2"
                                    src="{{ Auth::user()->avatar ? Storage::url(Auth::user()->avatar) : asset('assets/img/avatar/avatar-1.png') }}"
                                    alt="User profile picture">
                            @endif
                        @endif
                        <span>
                            <h6 class="f-w-500 fs-6 d-inline-flex mb-0">{{ Auth::user()->name }}</h6>
                        </span>
                        <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                    </a>
                    <div class="dropdown-menu  dash-h-dropdown arrow-none me-0">
                        <a href="{{ route('profile.index', Auth::user()->id) }}" class="dropdown-item">
                            <i class="ti ti-user"></i>
                            <span>{{ __('Profile') }}</span>
                        </a>
                        <a class="dropdown-item" href="javascript:void(0)"
                            onclick="document.getElementById('logout-form').submit()">
                            <i class="ti ti-power"></i>
                            <span> {{ __('Logout') }}</span>
                        </a>
                        <form action="{{ route('logout') }}" method="POST" id="logout-form"> @csrf </form>
                    </div>
                </li>
            </ul>
        </div>

    </div>
</header>
