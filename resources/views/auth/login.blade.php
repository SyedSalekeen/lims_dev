<x-admin-header></x-admin-header>

<section class="row flexbox-container">
    <div class="col-12 d-flex align-items-center justify-content-center">
        <div class="login-box">
            <h1>LOG IN</h1>
            <form class="form-horizontal" method="POST" action="{{ route('login') }}" novalidate>
                @csrf
                <div class="email-log-input">
                    <label>Email Address</label>
                    <input type="email"  id="email" name="email" placeholder="Enter your Email" required="">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="password-log-input">
                    <label>Password</label>
                    <input type="password" placeholder="Enter Password" name="password" required="">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="log-in-button">
                    <a href="#"><button class="lims_login_button">Log In</button></a>
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
                <form>
        </div>
        {{-- <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
            <div class="card border-grey border-lighten-3 m-0">
                <div class="card-header border-0">
                    <div class="card-title text-center">
                        <h1 class=" text-center  pt-2"><span>LIMS</span></h1>
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

                        <form class="form-horizontal" method="POST" action="{{ route('login') }}" novalidate>
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

                    <div class="card-body">
                            <a href="{{ route('register') }}" class="btn btn-outline-danger btn-block"><i class="la la-user"></i>
                                Register</a>
                        </div>
                </div>
            </div>
        </div> --}}
    </div>
</section>

<x-admin-footer></x-admin-footer>
