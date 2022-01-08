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
        
        .log-in-button button:hover {
            color: var(--secondary-button-text-color) !important;
            background: var(--secondary-sidebar-bg-color) !important;
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
            <div class="d-flex justify-content-center">
                <div class="img-log">
                    @if ($check_slug_exist->laboratory_logo)
                        <img src="{{ asset('uploads/logo/' . $check_slug_exist->laboratory_logo) }}">

                    @else
                        <h1>{{ $check_slug_exist->laboratory_name }}</h1>
                    @endif
                </div>
            </div>
            @if ($message = Session::get('success'))
                <div class="text-center alert my-2 alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <h2>LOG IN</h2>
            <form class="form-horizontal" method="POST" action="{{ route('user_login') }}" novalidate>
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



        {{-- <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                    <div class="card-title text-center">
                        @if ($check_slug_exist->laboratory_logo)
                        <img src="{{asset('uploads/logo/'.$check_slug_exist->laboratory_logo)}}"  >

                        @else
                        <h1>{{$check_slug_exist->laboratory_name}}</h1>
                        @endif
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="text-center alert my-2 alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 "><span>Login</span></h6>

                </div>
                <div class="card-content">


                    <div class="card-body">

                        <form class="form-horizontal" method="POST" action="{{ route('vendor_login') }}"  novalidate>
                        <form class="form-horizontal" method="POST" action="{{ route('user_login') }}" novalidate>
                            @csrf
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="email" class="form-control  @error('email') is-invalid @enderror "
                                    id="email" name="email" placeholder="Your Email" value="{{ old('email') }}"
                                    required autocomplete="email" autofocus>
                                <div class="form-control-position">
                                    <i class="la la-user"></i>
                                </div>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </fieldset>
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="password" class="form-control @error('password') is-invalid @enderror "
                                    id="password" placeholder="Enter Password" name="password" required
                                    autocomplete="current-password">
                                <div class="form-control-position">
                                    <i class="la la-key"></i>
                                </div>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </fieldset>
                            <button type="submit" class="btn btn-outline-info btn-block"><i class="la la-unlock"></i>
                                Login</button>
                        </form>
                    </div>

                </div>
            </div>
        </div> --}}
    </div>
</section>

<x-admin-footer></x-admin-footer>
