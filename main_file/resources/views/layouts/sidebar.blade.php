@php
$users = \Auth::user();
$currantLang = $users->currentLanguage();
$languages = Utility::languages();
@endphp

<ul class="dash-navbar">
    <li class="dash-item dash-hasmenu {{ request()->is('home*') ? 'active' : '' }}">
        <a href="{{ route('home') }}" class="dash-link"><span class="dash-micon"><i
                    class="ti ti-home"></i></span><span class="dash-mtext">{{ __('Dashboard') }}</span> </a>
    </li>
    @can('manage-user')
        @if ($users->type == 'Super Admin')
            <li class="dash-item dash-hasmenu {{ request()->is('users*') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}" class="dash-link"><span class="dash-micon"><i
                            class="ti ti-user"></i></span><span class="dash-mtext">{{ __('Admins') }}</span> </a>
            </li>
        @else
            <li class="dash-item dash-hasmenu {{ request()->is('users*') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}" class="dash-link"><span class="dash-micon"><i
                            class="ti ti-users"></i></span><span class="dash-mtext">{{ __('Users') }}</span> </a>
            </li>
        @endif
    @endcan
    @can('manage-role')
        <li class="dash-item dash-hasmenu {{ request()->is('roles*') ? 'active' : '' }}">
            <a href="{{ route('roles.index') }}" class="dash-link"><span class="dash-micon"><i
                        class="ti ti-key"></i></span><span class="dash-mtext">{{ __('Roles') }}</span> </a>
        </li>
    @endcan
    @hasrole('Super Admin')
        <li class="dash-item dash-hasmenu {{ request()->is('request-domain*') ? 'active' : '' }}">
            <a href="{{ route('requestdomain.index') }}" class="dash-link"><span class="dash-micon"><i
                        class="ti ti-arrow-big-right"></i></span><span
                    class="dash-mtext">{{ __('Domain Request') }}</span> </a>
        </li>
    @endhasrole

    @can('manage-module')
        <li class="dash-item dash-hasmenu {{ request()->is('modules*') ? 'active' : '' }}">
            <a href="{{ route('modules.index') }}" class="dash-link"><span class="dash-micon"><i
                        class="ti ti-box-model-2"></i></span><span class="dash-mtext">{{ __('Modules') }}</span> </a>
        </li>
    @endcan
    @hasrole('Admin')
        <li class="dash-item dash-hasmenu {{ request()->is('category*') ? 'active' : '' }}">
            <a href="{{ route('category.index') }}" class="dash-link"><span class="dash-micon"><i
                        class="ti ti-layout-list"></i></span><span class="dash-mtext">{{ __('Category') }}</span>
            </a>
        </li>
        <li class="dash-item dash-hasmenu {{ request()->is('blogs*') ? 'active' : '' }}">
            <a href="{{ route('blogs.index') }}" class="dash-link"><span class="dash-micon"><i
                        class="ti ti-blockquote"></i></span><span class="dash-mtext">{{ __('Blog') }}</span>
            </a>
        </li>
    @endhasrole

    @can('manage-plan')
        <li class="dash-item dash-hasmenu {{ request()->is('plans*') ? 'active' : '' }}">
            <a href="{{ route('plans.index') }}" class="dash-link"><span class="dash-micon"><i
                        class="ti ti-businessplan"></i></span><span class="dash-mtext">{{ __('Plans') }}</span> </a>
        </li>
    @endcan
    @can('manage-transaction')
        @if (Auth::user()->type == 'Super Admin')
            <li class="dash-item dash-hasmenu {{ request()->is('sales*') ? 'active' : '' }}">
                <a href="{{ route('sales.index') }}" class="dash-link"><span class="dash-micon"><i
                            class="ti ti-transfer-in "></i></span><span
                        class="dash-mtext">{{ __('Transactions') }}</span> </a>
            </li>
        @endif
    @endcan
    @can('manage-setting')
        <li class="dash-item dash-hasmenu {{ request()->is('settings*') ? 'active' : '' }}">
            <a href="{{ route('settings') }}" class="dash-link"><span class="dash-micon"><i
                        class="ti ti-settings"></i></span><span class="dash-mtext">{{ __('Settings') }}</span> </a>
        </li>
    @endcan
    @can('manage-chat')
        @if (Utility::getsettings('pusher_status') == '1')
            <li class="dash-item dash-hasmenu {{ request()->is('chat*') ? 'active' : '' }}">
                <a href="{{ route('chat') }}" class="dash-link"><span class="dash-micon"><i
                            class="ti ti-brand-hipchat"></i></span><span class="dash-mtext">{{ __('Chats') }}</span>
                </a>
            </li>
        @endif
    @endcan
    @if (Auth::user()->type == 'Super Admin' || Auth::user()->type == 'Admin')
        <li class="dash-item dash-hasmenu {{ request()->is('landing-page*') ? 'active' : '' }}">
            <a href="{{ route('landing.page') }}" class="dash-link"><span class="dash-micon"><i
                        class="ti ti-clipboard-list"></i></span><span
                    class="dash-mtext">{{ __('Landing Page') }}</span> </a>
        </li>
    @endif
    @can('manage-language')
        <li class="dash-item dash-hasmenu {{ request()->is('create-language*') ? 'active' : '' }}">
            <a href="{{ route('manage.language', [$currantLang]) }}" class="dash-link"><span
                    class="dash-micon"><i class="ti ti-world"></i></span><span
                    class="dash-mtext">{{ __('Manage Language') }}</span> </a>
        </li>
    @endcan
</ul>
