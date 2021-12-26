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
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                         <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Add Fines</h4>
                                    </div>
                            <div class="widget-header">
                                <div class="row">

                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                                <form class="needs-validation" action="{{URL('/admin/add_fine/save')}}" method="POST" novalidate>
                                @csrf
                                    <div class="form-row">
                                        <div class="col-md-12 mb-4">
                                            <label for="validationCustom01">Section Of Act</label>
                                            <input type="text" class="form-control" id="validationCustom01" name="section_of_act" placeholder="Enter Section act" required>
                                            <div class="invalid-feedback">
                                                Enter Section Of Act
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-4">
                                            <label for="validationCustom01">Fine Amount</label>
                                            <input type="text" class="form-control" id="validationCustom01" name="fine_amount" placeholder="Enter a value" required>
                                            <div class="invalid-feedback">
                                                Enter Fine Amount
                                            </div>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="validationCustom01">Demerit Point</label>
                                            <input type="text" class="form-control" id="validationCustom01" name="demerit_points" placeholder="Enter a value" required>
                                            <div class="invalid-feedback">
                                                Enter Demerit Point
                                            </div>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12 mb-4">
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea1">Provision</label>
                                                <textarea class="form-control" name="provision" id="exampleFormControlTextarea1" rows="3"></textarea>
                                            </div>
                                            <div class="invalid-feedback">
                                                Enter Description
                                            </div>
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
<script src="{{URL('')}}"></script>
<script src="assets/js/forms/bootstrap_validation/bs_validation_script.js"></script>

@endsection
