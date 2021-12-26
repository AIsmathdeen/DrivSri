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
                                        <h4>Update License Holder Profile</h4>
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
                             <form class="needs-validation" action="/admin/edit_license_holders/{{$license_holder->user_id}}" method="POST" novalidate>
                                    @csrf
                                        <div class="form-row">
                                        <div class="col-md-4 mb-4">
                                            <label for="first_name">First name</label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" value="{{$license_holder->first_name}}" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-md-8 mb-4">
                                            <label for="last_name">Last name</label>
                                            <input type="text"  class="form-control" name="last_name" id="last_name" value="{{$license_holder->last_name}}" required>
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
                                            <input type="text" class="form-control" maxlength="8" id="license_no" value="{{$license_holder->license_no}}" name="license_no" >

                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="widget-content widget-content-area p-0">
                                                <label for="basicFlatpickr2">Expiry Date</label>
                                                <div class="form-group mb-0">
                                                    <input id="basicFlatpickr2" class="form-control flatpickr  flatpickr-input active" type="text" name="expiry_date" value="{{$license_holder->expiry_date}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                         <label for="license_status">License Status</label>
                                            <select name="license_status_id" id="license_status" class="form-control">
                                                @foreach($license_status as $license_status)
                                                    @if($license_status->id==$license_holder->status_id)
                                                     <option value="{{$license_status->id}}" selected>{{$license_status->type}}</option>
                                                    @else
                                                    <option value="{{$license_status->id}}">{{$license_status->type}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Please provide a valid driving license ID.

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
