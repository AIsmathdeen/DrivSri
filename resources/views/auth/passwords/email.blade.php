<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from designreset.com/cork/ltr/demo4/auth_pass_recovery.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 17 May 2021 03:58:44 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>DrivSri Password Recovery</title>
     <link rel="icon" type="image/x-icon" href="{{URL('assets/img/favicon.ico')}}">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{URL('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL('assets/css/authentication/form-1.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{URL('assets/css/forms/theme-checkbox-radio.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL('assets/css/forms/switches.css')}}">
</head>

<body class="form ">
    <div class="form-container bg-white" >
        <div class="form-form bg-white">
            <div class="form-form-wrap bg-white">
                <div class="form-container">
                    <div class="form-content">
                        @if (session('status'))
                        <div class="text-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <h1 class="">Password Recovery</h1>
                        <p class="signup-link">Enter your email and instructions will sent to you!</p>

                        <form class="text-left" method="POST" action="{{ route('password.email') }}">

                            @csrf
                            <div class="form">
                                <div id="email-field" class="field-wrapper input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign">
                                        <circle cx="12" cy="12" r="4"></circle>
                                        <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path>
                                    </svg>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value=""> {{ __('Send Password Reset Link') }}</button>
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
