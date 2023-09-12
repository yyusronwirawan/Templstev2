@extends('layouts.main')
@section('title', 'Chat')
@push('css')
    @include('Chatify::layouts.headLinks')
@endpush
@section('content')
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h4 class="m-b-10">{{ __('Messanger') }}</h4>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active"><a
                                        href="{{ route('home') }}">{{ __('Dashboard') }}</a></li>
                                <li class="breadcrumb-item">{{ __('Messanger') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
                <div class="row chat">
                    <div class="messenger">
                        {{-- ----------------------Users/Groups lists side---------------------- --}}
                        <div class="messenger-listView">
                            {{-- Header and search bar --}}
                            <div class="m-header">
                                <nav>
                                    <a href="#"><i class="ti ti-inbox"></i> <span
                                            class="messenger-headTitle">{{ __('MESSAGES') }}</span> </a>
                                    {{-- header buttons --}}
                                    <nav class="m-header-right">
                                        <a href="#"><i class="ti ti-world settings-btn"></i></a>
                                        <a href="#" class="listView-x"><i class="ti ti-x"></i></a>
                                    </nav>
                                </nav>
                                {{-- Search input --}}
                                <input type="text" class="messenger-search" placeholder="Search" />
                                {{-- Tabs --}}
                                <div class="messenger-listView-tabs">
                                    <a href="#" @if ($route == 'user') class="active-tab" @endif data-view="users">
                                        <span class="ti ti-user"></span> {{ __('People') }}</a>
                                </div>
                            </div>
                            {{-- tabs and lists --}}
                            <div class="m-body">
                                {{-- Lists [Users/Group] --}}
                                {{-- ---------------- [ User Tab ] ---------------- --}}
                                <div class="@if ($route == 'user') show @endif messenger-tab app-scroll" data-view="users">

                                    {{-- Favorites --}}
                                    <div class="favorites-section">
                                        <p class="messenger-title">{{ __('Favorites') }}</p>
                                        <div class="messenger-favorites app-scroll-thin"></div>
                                    </div>

                                    {{-- Saved Messages --}}
                                    {!! view('Chatify::layouts.listItem', ['get' => 'saved', 'id' => $id])->render() !!}

                                    {{-- Contact --}}
                                    <div class="listOfContacts"
                                        style="width: 100%;height: calc(100% - 200px);position: relative;"></div>

                                </div>

                                {{-- ---------------- [ Group Tab ] ---------------- --}}
                                <div class="@if ($route == 'group') show @endif messenger-tab app-scroll" data-view="groups">
                                    {{-- items --}}
                                    <p style="text-align: center;color:grey;">{{ __('Soon will be available') }}</p>
                                </div>

                                {{-- ---------------- [ Search Tab ] ---------------- --}}
                                <div class="messenger-tab app-scroll" data-view="search">
                                    {{-- items --}}
                                    <p class="messenger-title">{{ __('Search') }}</p>
                                    <div class="search-records">
                                        <p class="message-hint center-el"><span>{{ __('Type to search..') }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ----------------------Messaging side---------------------- --}}
                        <div class="messenger-messagingView">
                            {{-- header title [conversation name] amd buttons --}}
                            <div class="m-header m-header-messaging">
                                <nav>
                                    {{-- header back button, avatar and user name --}}
                                    <div style="display: inline-flex;">
                                        <a href="#" class="show-listView"><i class="ti ti-arrow-left"></i></a>
                                        <div class="avatar av-s header-avatar"
                                            style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;">
                                        </div>
                                        <a href="#" class="user-name">{{ config('chatify.name') }}</a>
                                    </div>
                                    {{-- header buttons --}}
                                    <nav class="m-header-right">
                                        <a href="#" class="add-to-favorite"><i class="ti ti-star"></i></a>
                                        <a href="/"><i class="ti ti-home"></i></a>
                                        <a href="#" class="show-infoSide"><i class="ti ti-info-circle"></i></a>
                                    </nav>
                                </nav>
                            </div>
                            {{-- Internet connection --}}
                            <div class="internet-connection">
                                <span class="ic-connected">{{ __('Connected') }}</span>
                                <span class="ic-connecting">{{ __('Connecting...') }}</span>
                                <span class="ic-noInternet">{{ __('No internet access') }}</span>
                            </div>
                            {{-- Messaging area --}}
                            <div class="m-body app-scroll">
                                <div class="messages">
                                    <p class="message-hint center-el"><span>{{ __('Please select a chat to start messaging') }}</span>
                                    </p>
                                </div>
                                {{-- Typing indicator --}}
                                <div class="typing-indicator">
                                    <div class="message-card typing">
                                        <p>
                                            <span class="typing-dots">
                                                <span class="dot dot-1"></span>
                                                <span class="dot dot-2"></span>
                                                <span class="dot dot-3"></span>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                {{-- Send Message Form --}}
                                @include('Chatify::layouts.sendForm')
                            </div>
                        </div>
                        {{-- ---------------------- Info side ---------------------- --}}
                        <div class="messenger-infoView app-scroll text-center">
                            {{-- nav actions --}}
                            <nav class="text-left">
                                <a href="#"><i class="ti ti-x"></i></a>
                            </nav>
                            {!! view('Chatify::layouts.info')->render() !!}
                        </div>
                    </div>

                    @include('Chatify::layouts.modals')
                </div>
@endsection
@push('javascript')

    @include('Chatify::layouts.footerLinks')
@endpush
