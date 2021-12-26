@extends('layouts.master')
@section('content')
<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>

 <!--  BEGIN SIDEBAR  -->
    <div class="sidebar-wrapper sidebar-theme">

        @include('license_holder.side_bar');
    </div>
    <!--  END SIDEBAR  -->

 
    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="row">
            <div class="col-md-8 offset-1">

                <div class="row my-4">
                    <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                          <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Update Profile</h4>
                                    </div>
                                    
                            @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                            @endif
                            <div class="widget-header">
                                <div class="row">
                                  
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <!-- @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif -->
                                <form class="needs-validation" action="{{URL('/licensed_holder/update_license_holder')}}" method="POST" novalidate>
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="email"> Email</label>
                                        <input type="email" required class="form-control" id="email" name="email" aria-describedby="emailHelp1" placeholder="Email address" value="{{$user->email}}">
                                    </div>


                                    <div class="form-row">
                                        <div class="col-md-4 mb-4">
                                            <label for="first_name">First name</label>
                                            <input type="text" readonly class="form-control" name="first_name" id="first_name" value="{{$license_holder->first_name}}" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-md-8 mb-4">
                                            <label for="last_name">Last name</label>
                                            <input type="text" readonly class="form-control" name="last_name" id="last_name" value="{{$license_holder->last_name}}" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                     </div>
                                    <div class="form-row">
                                        <div class="col-md-8 mb-4">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" value="{{$license_holder->postal_address}}" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="widget-content widget-content-area p-0">
                                                <label for="basicFlatpickr">Date Of Birth</label>
                                                <div class="form-group mb-0">
                                                    <input id="basicFlatpickr" class="form-control flatpickr  flatpickr-input active" type="text" value="{{$license_holder->dob}}" name="dob">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-4">
                                            <label for="license_no">Driving License ID</label>
                                            <input type="text" readonly class="form-control" id="license_no" value="{{$license_holder->license_no}}" name="license_no" >

                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="widget-content widget-content-area p-0">
                                                <label for="basicFlatpickr2">Expiry Date</label>
                                                <div class="form-group mb-0">
                                                    <input id="basicFlatpickr2" readonly class="form-control flatpickr  flatpickr-input active" type="text" name="expiry_date" value="{{$license_holder->expiry_date}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label for="mobile_number">Mobile Number</label>
                                            <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="{{$license_holder->mobile_no}}" required onchange="validateContactNumber()">
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
        <div class="footer-wrapper">
            <div class="footer-section f-section-1">
                <p class="">Copyright © 2021 DrivSRI, All
                    rights reserved.</p>
            </div>
            <div class="footer-section f-section-2">
                <p class="">Coded with
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                        </path>
                    </svg>
                </p>
            </div>
        </div>
    </div>
    <!--  END CONTENT AREA  -->

</div>
<!-- END MAIN CONTAINER -->
@endsection

@section('scripts')
<script>
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
