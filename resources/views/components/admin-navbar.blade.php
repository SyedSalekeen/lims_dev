<?php
$value = \App\User::where(['id' => auth()->id()])->first();
?>
<nav
    class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-lg-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                        href="{{ route('dashboard') }}"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ route('dashboard') }}">
                        @if (@$value->type == '1')

                            <h1 class="brand-text">LIMS</h1>
                        @endif
                        @if (@$value->type == '2')
                            @if ($value->laboratory_logo)
                                <img src="{{ asset('uploads/logo/' . $value->laboratory_logo) }}" width="60px"
                                    height="60px">
                            @else
                            <h3 class="brand-text">{{ $value->laboratory_name }}</h3>
                            @endif

                        @endif
                    </a></li>
                <!-- <li class="nav-item d-none d-lg-block nav-toggle"><a class="nav-link modern-nav-toggle pr-0"
                        data-toggle="collapse"><i class="toggle-icon ft-toggle-right font-medium-3 white"
                            data-ticon="ft-toggle-right"></i></a></li> -->
                <li class="nav-item d-lg-none"><a class="nav-link open-navbar-container" data-toggle="collapse"
                        data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand" href="#"><i
                                class="ficon ft-maximize"></i></a></li>
                    <li class="dropdown nav-item mega-dropdown d-none d-lg-block"><a class="dropdown-toggle nav-link"
                            href="#" data-toggle="dropdown">Lims</a>

                    </li>
                    <li class="nav-item nav-search"><a class="nav-link nav-link-search" href="#"><i
                                class="ficon ft-search"></i></a>
                        <div class="search-input">
                            <input class="input" type="text" placeholder="Search" tabindex="0"
                                data-search="template-list">
                            <div class="search-input-close"><i class="ft-x"></i></div>
                            <ul class="search-list"></ul>
                        </div>
                    </li>
                </ul>
                {{-- <div id="google_translate_element"></div> --}}
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <span class="mr-1 user-name text-bold-700 text-dark">
                                {{-- {{ Auth::user()->name ? ucfirst(Auth::user()->name) : '' }} --}}
                            </span>
                            <span class="avatar avatar-online">
                                <img src="{{ asset('app-assets/images/portrait/small/avatar-s-1.png') }}"
                                    alt="avatar">
                                <i></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            {{-- <a class="dropdown-item" href="#">
                                <i class="ft-user"></i> Edit Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="ft-clipboard"></i> Todo
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="ft-check-square"></i> Task
                            </a> --}}
                            @if (@$value->id == '1')
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            @endif

                            @if (@$value->id != '1')

                                <a class="dropdown-item" href="{{ route('user_logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('user-logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            @endif
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                            <form id="user-logout-form" action="{{ route('user_logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- END: Header-->
