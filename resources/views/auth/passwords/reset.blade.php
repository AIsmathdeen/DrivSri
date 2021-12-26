<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>DrivSri</title>

    <link rel="icon" type="image/x-icon" href="{{URL('assets/img/favicon.ico')}}">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{URL('https://fonts.googleapis.com/css?family=Nunito:400,600,700')}}" rel="stylesheet">
    <link href="{{URL('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL('assets/css/authentication/form-1.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link href="{{URL('assets/css/forms/theme-checkbox-radio.css')}}" rel="stylesheet" type="text/css">
    <link href="{{URL('assets/css/forms/switches.css')}}" rel="stylesheet" type="text/css">
</head>

</head>

<body>
     <div class="form-container ">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container" >
                    <div class="form-content">

                       <h1 class="">Reset Password</h1>
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <div class="form">
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div id="username-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign">
                                        <circle cx="12" cy="12" r="4"></circle>
                                        <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path>
                                    </svg>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div id="email-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="New Password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div id="password-field" class="field-wrapper input mb-2" bg-white>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">

                                </div>
                                <div class="d-sm-flex justify-content-start bg-transparent ">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value=""> {{ __('Log In') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                 <div class="footer-wrapper">
                    <div class="footer-section f-section-1">
                        <p class="">Copyright © 2021 DrivSRI, All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-image ">
            <div class="l-image bg-white">
            </div>
        </div>
    </div>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{URL('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{URL('bootstrap/js/popper.min.js')}}"></script>
    <script src="{{URL('bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{URL('assets/js/authentication/form-1.j')}}"></script>

</body>

</html>