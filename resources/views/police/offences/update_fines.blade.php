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
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Update Fines</h4>
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
                                <form class="needs-validation" action="/admin/add_fines" method="POST" novalidate>
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-md-4 mb-4">
                                            <label for="license_holder">License Holder</label>
                                            <select name="license_holder_id" class="form-control" id="">
                                                @foreach ($license_holders as $license_holder)
                                                    @if ($license_holder->id==$fine->license_holder_id )
                                                        <option value="{{$license_holder->id}}" selected hiddens>{{$license_holder->first_name}}</option>
                                                    @endif
                                                        <option value="{{$license_holder->id}}">{{$license_holder->first_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-8 mb-4">
                                            <label for="licese_provider">Offence</label>
                                            <select name="offence_id" class="form-control" id="">
                                                @foreach ( $offenses as $offense )
                                                    @if ($offense->id==$fine->offense_id )
                                                        <option value="{{$offense->id}}" selected hiddens>{{$offense->section_of_act}}</option>
                                                    @endif
                                                        <option value="{{$offense->id}}">{{$offense->section_of_act}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-4">
                                            <label for="last_name">Fine Amount</label>
                                            <input type="text" class="form-control" name="fine_amount"  value="{{$fine->fine_amount}}" id="fine_amount" placeholder="Enter amount" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-md-8 mb-4">
                                            <label for="license_holder">Vehicle class</label>
                                            <select name="vehicle_class_id" class="form-control" id="vehicle_class_id">
                                            @foreach ($vehicle_class as $vehicle_class )
                                                @if ($vehicle_class->id==$fine->vehicle_class_id )
                                                    <option value="{{$vehicle_class->id}}" selected hiddens>{{$vehicle_class->vehicle_class}}</option>
                                                @endif
                                                    <option value="{{$vehicle_class->id}}">{{$vehicle_class->vehicle_class}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-4">
                                            <div class="widget-content widget-content-area p-0">
                                                <label for="fine_issued_date">Fine Issued Date</label>
                                                <div class="form-group mb-0">
                                                    <input id="basicFlatpickr"  value="{{$fine->fine_issued_date}}" class="form-control flatpickr  flatpickr-input active" type="text" placeholder="Select Date..." name="fine_issued_date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 mb-4">
                                            <label for="demerit_points">Demerit Point</label>
                                            <input type="text" class="form-control" value="{{$fine->demerit_points}}" name="demerit_points" id="demerit_points" placeholder="Enter amount" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-4 mb-4">
                                            <label for="license_holder">Policeman</label>
                                            <select name="policeman_id" class="form-control" id="policeman_id">
                                            @foreach ($policemen as $policemen)
                                            @if ($policemen->id == $fine->policeman_id)
                                                <option value="{{$policemen->id}}" selected hiddens>{{$policemen->first_name}}</option>
                                            @endif
                                                <option value="{{$policemen->id}}">{{$policemen->first_name}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <label for="license_holder">Payment Status</label>
                                            <select name="payment_status_id" class="form-control" id="payment_status">
                                            @foreach ($payment_statuses as $payment_status)
                                            @if ($payment_status->id == $fine->payment_status)
                                                <option value="{{$payment_status->id}}" selected hidden>{{$payment_status->type}}</option>
                                            @endif
                                                <option value="{{$payment_status->id}}">{{$payment_status->type}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="widget-content widget-content-area p-0">
                                                <label for="basicFlatpickr2">Payment Date</label>
                                                <div class="form-group mb-0">
                                                    <input id="basicFlatpickr2" value="{{$fine->payment_date}}" class="form-control flatpickr  flatpickr-input active" type="text" placeholder="Select Date..." name="payment_date">
                                                </div>
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
