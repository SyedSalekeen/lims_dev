<x-admin-header></x-admin-header>

    <section class="row flexbox-container">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                <div class="card border-grey border-lighten-3   m-0">
                    <div class="card-header border-0 pb-0">
                        <div class="card-title text-center">
                            <h1 class=" text-center  pt-2"><span>Mecashop</span></h1>
                            
                        </div>
                        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 "><span>Register</span></h6>
                    </div>
                    <div class="card-content">
                    
                        <div class="card-body">
                            <form class="form-horizontal" method="POST"  action="{{ route('register') }}" novalidate>
                                @csrf
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="User Name">
                                    <div class="form-control-position">
                                        <i class="la la-user"></i>
                                    </div>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </fieldset>
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email-register" placeholder="Your Email Address" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    <div class="form-control-position">
                                        <i class="la la-envelope"></i>
                                    </div>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </fieldset>
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter Password" name="password" required autocomplete="new-password">
                                    <div class="form-control-position">
                                        <i class="la la-key"></i>
                                    </div>

                                    
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </fieldset>
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input type="password" class="form-control  " id="password" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                                    <div class="form-control-position">
                                        <i class="la la-key"></i>
                                    </div>
                                    
                                
                                </fieldset>
                            
                                <button type="submit" class="btn btn-outline-info btn-block"><i class="la la-user"></i> Register</button>
                            </form>
                        </div>
                        <p class="card-subtitle line-on-side text-muted text-center font-small-3 "><span>New to Mecashop
                            ?</span></p>
                        <div class="card-body">
                            <a href="{{ route('login') }}" class="btn btn-outline-danger btn-block"><i class="la la-unlock"></i>
                                Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<x-admin-footer></x-admin-footer>