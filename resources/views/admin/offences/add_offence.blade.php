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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

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
                                        <h4>Add Offences</h4>
                                        @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('status') }}
                                        </div>
                                        @elseif(session('status-failed'))
                                        <div class="alert alert-danger">
                                            {{ session('status-failed') }}
                                        </div>
                                        @endif
                                    </div>
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
                                <form class="needs-validation" action="{{URL('/admin/save_offence')}}" method="POST" novalidate>
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-md-12 mb-4">
                                            <label for="license_holder">License Holder</label>
                                            <select name="license_holder_id" class="form-control" id="">
                                                @foreach ($license_holders as $license_holder)
                                                <option value="{{$license_holder->id}}">{{$license_holder->first_name}}&nbsp;{{$license_holder->last_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-4">
                                            <label for="licese_provider">License No</label>
                                            <select name="offence_id" class="form-control" id="">
                                                @foreach ( $license_holders as $license_holder )
                                                <option value="{{$license_holder->id}}">{{$license_holder->license_no}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="police_men">Policemen</label>
                                            <select name="policemen_id" class="form-control" id="">
                                                @foreach ( $policemens as $policemen )
                                                <option value="{{$policemen->id}}">{{$policemen->first_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-8 mb-4">
                                            <label for="licese_provider">Offence</label>
                                            <select name="offence_id" class="form-control" id="">
                                                @foreach ( $policemens as $policemen )
                                                <option value="{{$policemen->id}}">{{$policemen->first_name}} &nbsp; {{$policemen->last_name}}</option>
                                                @endforeach
                                            </select>
                                        </div> -->

                                    <div class="form-row">
                                        <!-- <div class="col-md-4 mb-4">
                                            <label for="last_name">Fine Amount</label>
                                            <input type="text" class="form-control" name="fine_amount" id="fine_amount" placeholder="Enter amount" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div> -->
                                        <div class="col-md-6 mb-4">
                                            <label for="license_holder">Vehicle class</label>
                                            <select name="vehicle_class_id" class="form-control" id="vehicle_class_id">
                                                @foreach ($vehicle_class as $vehicle_class )
                                                <option value="{{$vehicle_class->id}}">{{$vehicle_class->vehicle_class}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="license_holder">Payment Status</label>
                                            <select name="payment_status_id" class="form-control" id="payment_status">
                                                @foreach ($payment_status as $payment_status)
                                                <option value="{{$payment_status->id}}">{{$payment_status->type}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-4">
                                            <div class="widget-content widget-content-area p-0">
                                                <label for="basicFlatpickr2">Fine Isuue Date</label>
                                                <div class="form-group mb-0">
                                                    <input id="basicFlatpickr2" class="form-control flatpickr  flatpickr-input active" type="text" placeholder="Select Date..." name="issue_date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="widget-content widget-content-area p-0">
                                                <label for="basicFlatpickr">Payment Date</label>
                                                <div class="form-group mb-0">
                                                    <input id="basicFlatpickr" class="form-control flatpickr  flatpickr-input active" type="text" placeholder="Select Date..." name="payment_date">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-4">
                                            <div class="widget-content widget-content-area p-0">
                                                <label for="basicFlatpickr">Fines</label>
                                                <div class="form-group mb-0">
                                                    <select class="form-control selectpicker" id="fines" name="fines[]" multiple data-live-search="true">
                                                        @foreach ($fines as $fine)
                                                        <option class="fine_op" value="{{$fine->id}}">{{$fine->provision}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 mb-4">
                                            <div class="widget-content widget-content-area p-0">
                                                <label for="basicFlatpickr">Demerit Points</label>
                                                <div class="form-group mb-0">
                                                    <input type="text" class="form-control" name="demerit_points" id="demerit_points" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="widget-content widget-content-area p-0">
                                                <label for="basicFlatpickr">Fine Amount</label>
                                                <div class="form-group mb-0">
                                                    <input type="text" class="form-control" name="fine_amount" id="fine_amount" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary mt-3" type="submit" id="btnsubmit">Submit</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script>
    console.log('script ok');


    // $('#btn_cal').click(function() {
    //     var fines = $('.filter-option-inner-inner').text();
    //     console.log(fines);
    // });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('select[name="fines[]"]').on('change', function() {
        var fines = $(this).val();
        console.log(fines);
        $.ajax({
            url: "{{url('/admin/calculate/fine')}}",
            method: "POST",
            data: "fines=" + fines,
            dataType: 'JSON',
            success: function(response) {
                if (response.success) {
                    $("#fine_amount").val(response.final_amount);
                    $("#demerit_points").val(response.demerit);
                }

                if (!response.success) {

                }
            }
        });

    });

    function checkPass() {
        var pass1 = document.getElementById('password');
        var pass2 = document.getElementById('password_confirmation');
        var message = document.getElementById('message');
        var goodColor = "#66cc66";
        var badColor = "#ff6666";

        if (pass1.value.length > 8) {
            message.style.color = goodColor;
            message.innerHTML = "Good Password"
        } else {
            message.style.color = badColor;
            message.innerHTML = " Password must be atleast 8 characters"
            return;
        }

        if (pass1.value == pass2.value) {
            message.style.color = goodColor;
            message.innerHTML = "Passwords match"
        } else {
            message.style.color = badColor;
            message.innerHTML = " These passwords do not match"
        }
    }
</script>


@endsection
