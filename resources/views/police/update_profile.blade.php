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

        @include('police.side_bar');

    </div>
    <!--  END SIDEBAR  -->
    <!--  END SIDEBAR  -->

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="container">
            <div class="container">
                <div class="row my-4">
                    <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                            @endif
                         <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Update Profile</h4>
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
                                <form class="needs-validation" action="{{URL('policemen/update_profile/'.$policemen->id)}}" method="POST" novalidate>
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-md-4 mb-4">
                                            <label for="first_name">First Name</label>
                                            <input type="text" readonly class="form-control" name="first_name" id="first_name" placeholder="First name" value="{{$policemen->first_name}}" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" readonly class="form-control" name="last_name" id="last_name" placeholder="Last name" value="{{$policemen->last_name}}" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="widget-content widget-content-area p-0">
                                                <label for="basicFlatpickr">Date Of Birth</label>
                                                <div class="form-group mb-0">
                                                    <input id="basicFlatpickr" class="form-control flatpickr  flatpickr-input active" value="{{$policemen->dob}}" name="dob" type="text" placeholder="Select Date..">
                                                </div>
                                            </div>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-4">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" value="{{$policemen->postal_address}}" name="address" placeholder="Address" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-4">
                                            <label for="mobile_number">Mobile Number</label>
                                            <input type="text" class="form-control" id="mobile_number" value="{{$policemen->mobile_number}}" name="mobile_number" placeholder="Enter Mobile No" required onchange="validateContactNumber()">
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
</div>
<!--  END CONTENT AREA  -->
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
    var check = function() {
        if (document.getElementById('password').value ==
            document.getElementById('confirm_password').value) {
            document.getElementById('message').style.color = 'DodgerBlue';
            document.getElementById('message').innerHTML = 'Passwords match';
        } else {
            document.getElementById('message').style.color = 'Tomato';
            document.getElementById('message').innerHTML = 'Passwords do not match';
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
        $("#mobile_number").attr('maxlength', '12');
    });

    $("input[name='mobile_number']").keyup(function() {
        var curchr = this.value.length;
        var curval = $(this).val();
        if (curchr == 3) {
            $("input[name='mobile_number']").val(curval + " ");
        } else if (curchr == 7) {
            $("input[name='mobile_number']").val(curval + " ");
        }
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
