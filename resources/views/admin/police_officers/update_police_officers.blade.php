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
    <div id="content" class="main-content">
        <div class="container">
            <div class="container">
                <div class="row my-4">
                    <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Update Police Officer</h4>
                                    </div>
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
                                <form class="needs-validation" action="{{URL('admin/edit_police_officers/'.$police_officer->id)}}" method="POST" novalidate>
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-md-4 mb-4">
                                            <label for="first_name">First name</label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First name" value="{{$police_officer->first_name}}" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label for="last_name">Last name</label>
                                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last name" value="{{$police_officer->last_name}}" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="widget-content widget-content-area p-0">
                                                <label for="basicFlatpickr2">Date Of Birth</label>
                                                <div class="form-group mb-0">
                                                    <input id="basicFlatpickr" class="form-control flatpickr flatpickr-input active" value="{{$police_officer->dob}}" type="text" placeholder="Select Date..." name="dob">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-4">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{$police_officer->postal_address}}" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-4">
                                            <label for="registration_number">Registration Number</label>
                                            <input type="text" class="form-control"  maxlength="8" id="registration_number" placeholder="Registration Number" value="{{$police_officer->registration_number}}" name="registration_number" required>
                                            <div class="invalid-feedback">
                                                Please provide a valid driving license ID.
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="registration_number">Police Division</label>
                                            <select class="form-control" id="police_division_id" name="police_division_id">
                                                @foreach ($police_divisions as $police_division)
                                                    @if($police_division->id==$police_officer->division_id)
                                                        <option value="{{$police_division->id}}" selected hidden>{{$police_division->name}}</option>
                                                    @endif
                                                        <option value="{{$police_division->id}}">{{$police_division->name}}</option>
                                                @endforeach
                                            </select>
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
</script>


@endsection
