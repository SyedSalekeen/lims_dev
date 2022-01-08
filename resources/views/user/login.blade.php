<?php

$ses_url = session()->get('url_current_for_user_logout');
// echo $ses_url;
$vendor_branch_find = \App\VendorBranch::where('branch_url', $ses_url)->first();
$get_branch_logo = \App\User::find($vendor_branch_find->vendor_id);
?>

@if ($get_color)
    <style>
        :root {
            --secondary-sidebar-bg-color: {{ $get_color['sidebar_color'] }};
            --secondary-button-text-color: {{ $get_color['button_text'] }};
        }

        .login-box h2 {
            color: var(--secondary-sidebar-bg-color)!important;

        }

        .login-box h1 {
            color: var(--secondary-sidebar-bg-color)!important;

        }

        .login-box label {
            color: var(--secondary-sidebar-bg-color)!important;

        }

        .log-font {
            color: var(--secondary-sidebar-bg-color)!important;
        }
        .log-in-button button{
            color: var(--secondary-button-text-color)!important;
            background: var(--secondary-sidebar-bg-color)!important;
        }
          .log-in-button button:hover{
            color: var(--secondary-button-text-color)!important;
            background: var(--secondary-sidebar-bg-color)!important;
        }
        html body.fixed-navbar {
    padding-top: 0 !important;
        }

    </style>
    @else
    <style>
     .log-in-button button{
           color: #ffff!important;
            background: #12a2ce !important;
        }
        
        .log-in-button button:hover {
            color: #ffff!important;
            background: #12a2ce !important;
        }
 html body.fixed-navbar {
    padding-top: 0 !important;
        }
       

    </style>
@endif

<x-admin-header></x-admin-header>

<section class="row flexbox-container for-width-g">
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="login-box">
            @if ($message = Session::get('success'))
            <div class="text-center alert my-2 alert-danger">
                <p>{{ $message }}</p>
            </div>
        @endif
            <div class="d-flex justify-content-center">
                <div class="img-log">
                    @if ($get_branch_logo->laboratory_logo)
                        <img src="{{ asset('uploads/logo/' . $get_branch_logo->laboratory_logo) }}">

                    @else
                        <h1>{{ $get_branch_logo->laboratory_name }}</h1>
                    @endif
                </div>
            </div>

            <h2>LOG IN</h2>
            <form class="form-horizontal" method="POST" action="{{ route('login_submit') }}" novalidate>
                @csrf
                <div class="email-log-input  @error('email') is-invalid @enderror">
                    <label>Email Address</label>
                    <input type="text" name="email" placeholder="Your Email" value="{{ old('email') }}" required
                        autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="password-log-input ">
                    <label>Password</label>
                    <input type="password" class="@error('password') is-invalid @enderror" placeholder="Enter Password"
                        name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="log-in-button">
                    <button type="submit">Log In</button>
                </div>
                {{-- <div class="check-box-poilicy">
                    <span>
                        <input type="checkbox">
                        <a href="#">Privacy-policy</a>
                        And
                        <a href="#">Terms&Condition</a>
                    </span>
                </div> --}}
                <div class="log-font">
                    <i class="fas fa-briefcase-medical"></i>
                </div>
            </form>
        </div>




    </div>
</section>

<x-admin-footer></x-admin-footer>
