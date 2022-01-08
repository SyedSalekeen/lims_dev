<?php
$get_color = App\ChangeTheme::where('vendor_id', auth()->id())->first();
?>
@if ($get_color)
<style>
    :root {
        --main-bg-color: #fff;
        --main-text-color: {{ $get_color['sidebar_text'] }};
        --primary-bg-color: coral;
        --primary-text-color: {{ $get_color['sidebar_text'] }};
        --primary-sidebar-color: coral;
        --primary-sidebar-bg-color: rgb(80, 255, 133);
        --secondary-bg-color: {{ $get_color['navbar_color'] }};
        --secondary-text-color: coral;
        --secondary-text-color: coral;
        --secondary-sidebar-color: coral;
        --secondary-sidebar-bg-color: {{ $get_color['sidebar_color'] }};
        --secondary-navbar-text-color: {{ $get_color['navbar_text'] }};
        --secondary-navbar-bg-color: #fff;
        --secondary-button-text-color: {{ $get_color['button_text'] }};
        --secondary-button-bg-color: {{ $get_color['button_color'] }};
        --secondary-button-hover-text-color: {{ $get_color['button_text'] }};
        --secondary-button-hover-bg-color: {{ $get_color['button_color'] }};
        --secondary-button-border-color: {{ $get_color['button_color'] }};
    }

    .main-menu.menu-dark,
    .main-menu.menu-dark .navigation {
        background: var(--secondary-sidebar-bg-color) !important;
    }

    .navbar-semi-dark {
        background: var(--secondary-navbar-bg-color) !important;
    }

    .main-menu.menu-dark .navigation>li.hover>a,
    .main-menu.menu-dark .navigation>li:hover>a,
    .main-menu.menu-dark .navigation>li.active>a {
        color: var(--main-text-color) !important;
    }

    .main-menu.menu-dark .navigation li a {
        color: var(--primary-text-color) !important;
    }

    .navbar-semi-dark .navbar-nav .nav-link {
        color: var(--secondary-navbar-text-color) !important;
    }

    button,
    .btn-success,
    .btn-primary {
        background: var(--secondary-button-bg-color) !important;
        background-color: var(--secondary-button-bg-color) !important;
        color: var(--secondary-button-text-color) !important;
    }

</style>
@else
<style>
    :root {
        --main-bg-color: #ffff;
        --main-text-color: #ffff;
        --primary-bg-color: coral;
        --primary-text-color: #ffff;
        --primary-sidebar-color: coral;
        --primary-sidebar-bg-color: rgb(80, 255, 133);
        --secondary-bg-color: #25b1bb;
        --secondary-text-color: coral;
        --secondary-text-color: coral;
        --secondary-sidebar-color: coral;
        --secondary-sidebar-bg-color: #25b1bb;
        --secondary-navbar-text-color: #ffff;
        --secondary-navbar-bg-color: #fff;
        --secondary-button-text-color: #ffff;
        --secondary-button-bg-color: #25b1bb;
        --secondary-button-hover-text-color: #ffff;
        --secondary-button-hover-bg-color: #25b1bb;
        --secondary-button-border-color: #25b1bb;
    }

    .main-menu.menu-dark,
    .main-menu.menu-dark .navigation {
        background: var(--secondary-sidebar-bg-color) !important;
    }

    .navbar-semi-dark {
        background: var(--secondary-navbar-bg-color) !important;
    }

    .main-menu.menu-dark .navigation>li.hover>a,
    .main-menu.menu-dark .navigation>li:hover>a,
    .main-menu.menu-dark .navigation>li.active>a {
        color: var(--main-text-color) !important;
    }

    .main-menu.menu-dark .navigation li a {
        color: var(--primary-text-color) !important;
    }

    .navbar-semi-dark .navbar-nav .nav-link {
        color: var(--secondary-navbar-text-color) !important;
    }

    button,
    .btn-success,
    .btn-primary {
        background: var(--secondary-button-bg-color) !important;
        background-color: var(--secondary-button-bg-color) !important;
        color: var(--secondary-button-text-color) !important;
    }

</style>
@endif


<x-admin-header></x-admin-header>

<x-admin-navbar></x-admin-navbar>
<x-admin-sidebar></x-admin-sidebar>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">

        <x-admin-breadcrumb></x-admin-breadcrumb>

        <div class="content-body">
            @yield('content')
        </div>
    </div>
</div>

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->

<!-- END: Footer-->
@yield('scripts')
<x-admin-footer></x-admin-footer>
