@extends('layouts.master')


@section('styles')
<link href="{{URL('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
<link href="{{URL('plugins/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL('plugins/noUiSlider/nouislider.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL('plugins/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL('plugins/noUiSlider/custom-nouiSlider.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL('plugins/bootstrap-range-Slider/bootstrap-slider.css')}}" rel="stylesheet" type="text/css" />

@endsection


@section('content')
<div class="main-container" id="container">
    <div class="overlay"></div>
    <div class="search-overlay"></div>

    <!--  BEGIN SIDEBAR  -->
    <!--  BEGIN SIDEBAR  -->
    <div class="sidebar-wrapper sidebar-theme">

        @include('admin.side_bar');
    </div>
    <!--  END SIDEBAR  -->
    <!--  END SIDEBAR  -->

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content" >
        <div class="container">
            <div class="container">
                <div class="row my-4">
                    <div id="flFormsGrid" class="col-lg-12 layout-spacing">

                        <div class="statbox widget box box-shadow">
                              <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Add License Holder</h4>
                                    </div>
                            <div class="widget-header">
                                <div class="row">

                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                
                                <form class="needs-validation" action="{{URL('/admin/save_license_holders')}}" method="POST" novalidate>
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="email"> Email</label>
                                        <input type="email" required class="form-control" id="email" name="email" aria-describedby="emailHelp1" placeholder="Email address">
                                        <div class="invalid-feedback">
                                            Enter email address
                                        </div>
                                    </div>
                                    {{--  <div class="form-group mb-4">
                                        <label for="password">Password</label>
                                        <input type="password" required class="form-control" id="password" onkeyup='checkPass();' name="password" placeholder="Password">
                                        <div class="invalid-feedback">
                                            Enter Password
                                        </div>
                                        <span id='message'></span>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="password_confirmation"> Confirm Password</label>
                                        <input type="password" onkeyup='checkPass();' class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                                        <span id='message1'></span>
                                    </div>  --}}

                                    <div class="form-row">
                                        <div class="col-md-4 mb-4">
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First name" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last name" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-4 mb-4">
                                            <label for="age">Age</label>
                                            <input type="text" class="form-control" id="age" name="age"
                                                placeholder="Age" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div> -->
                                        <div class="col-md-4 mb-4">
                                            <div class="widget-content widget-content-area p-0">
                                                <label for="basicFlatpickr">Date Of Birth</label>
                                                <div class="form-group mb-0">
                                                    <input id="basicFlatpickr" class="form-control flatpickr  flatpickr-input active" type="text" placeholder="Select Date.." name="dob">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-4">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-4">
                                            <label for="license_no">Driving License ID</label>
                                            <input type="text" class="form-control" id="license_no" onkeyup='checklicenseID();' placeholder="Driving License ID" name="license_no" maxlength="8" required>
                                            <div class="invalid-feedback">
                                                Please provide a valid driving license ID.
                                            </div>
                                            <span id='message2'></span>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="widget-content widget-content-area p-0">
                                                <label for="basicFlatpickr2">Expiry Date</label>
                                                <div class="form-group mb-0">
                                                    <input id="basicFlatpickr2" class="form-control flatpickr  flatpickr-input active" type="text" placeholder="Select Date.." name="expiry_date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label for="address">Moble Number</label>
                                            <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Mobile No"  maxlength="10" required onchange="validateContactNumber()">
                                            <div id="phone_messsage" class="text-danger mb-2" style="font-size: 13px;"></div>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary mt-3" type="submit">Submit</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<p>
<!--END CONTENT AREA -->
</div>

@endsection

@section('scripts')
<script src="{{URL('plugins/highlight/highlight.pack.js')}}"></script>
<script src="{{URL('assets/js/custom.js')}}"></script>
<script src="{{URL('assets/js/scrollspyNav.js')}}"></script>
<script src="{{URL('plugins/flatpickr/flatpickr.js')}}"></script>
<script src="{{URL('plugins/noUiSlider/nouislider.min.js')}}"></script>
<script src="{{URL('plugins/flatpickr/custom-flatpickr.js')}}"></script>
<script src="{{URL('plugins/noUiSlider/custom-nouiSlider.js')}}"></script>
<script src="{{URL('plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js')}}"></script>
<script src="{{URL('assets/js/forms/bootstrap_validation/bs_validation_script.js')}}"></script>
<script src="assets/js/forms/bootstrap_validation/bs_validation_script.js"></script>
<script>
    function checkPass() {
        var pass1 = document.getElementById('password');
        var pass2 = document.getElementById('password_confirmation');
        var message = document.getElementById('message');
        var message1 = document.getElementById('message1');
        var goodColor = "#66cc66";
        var badColor = "#ff6666";

        if (pass1.value.length <=8) {
            message.style.color = badColor;
            message.innerHTML = " Password must be at least 8 characters"
            return;
        } else{
                message.style.color = goodColor;
                message.innerHTML = "Good Password"
        }

        if (pass1.value == pass2.value) {
            message1.style.color = goodColor;
            message1.innerHTML = "Passwords match"
        } else {
            message1.style.color = badColor;
            message1.innerHTML = " These passwords do not match"
        }
    }

    function checklicenseID() {
        var pass1 = document.getElementById('license_no');
        var message = document.getElementById('message2');
        var goodColor = "#66cc66";
        var badColor = "#ff6666";

        if (license_no.value.length >=8 && license_no.value.charAt(0)=='B') {
            message.style.color = goodColor;
            message.innerHTML = "Driving License Number is Valid"
        } else {
            message.style.color = badColor;
            message.innerHTML = " Driving License Number is not valid.Format of a Valid is B1234567"
            return;
        }
    }
    function validateContactNumber() {
        const phone = document.getElementById('mobile_number')
        var validNo = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;


        if (!phone.value.match(validNo)) {
            var message = 'Please enter valid phone number';
            $('#phone_messsage').html(message);

        } else {
            $('#phone_messsage').empty();
        }
    }

    $(document).ready(function() {
        $("#mobile_number").attr('maxlength', '10');
    });

    $("input[name='mobile_number']").keydown(function(e) {
        var letters_numbers_array = [];
        for (var i = 65; i <= 90; i++) {
            letters_numbers_array.push(i);
        }
        var ingnore_key_codes = letters_numbers_array;
        if ($.inArray(e.keyCode, ingnore_key_codes) >= 0) {
            e.preventDefault();
        }
    });
</script>


@endsection
