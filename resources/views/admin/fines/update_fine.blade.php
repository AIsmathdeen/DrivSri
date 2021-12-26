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
                                        <h4>Update Fine Details</h4>
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
                                <form class="needs-validation" action="{{url('admin/update_fine/update/'.$fine->id)}}" method="POST" novalidate>
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="section_of_act"> Section Of Act</label>
                                        <textarea required class="form-control" id="section_of_act" name="section_of_act" rows="3">{{$fine->section_of_act}}</textarea>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label for="password">Demerit Point</label>
                                                <select type="password" required class="form-control" id="demerit_point" name="demerit_point">
                                                    <?php $demerit_point = 6 ?>
                                                    <option value="{{$fine->demerit_points}}" selected hidden>{{$fine->demerit_points}}</option>
                                                    @for ($i = 1; $i <= $demerit_point; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="fine_amount">Fine Amount</label>
                                            <input type="text" class="form-control" name="fine_amount" value="{{$fine->fine_amount}}" id="fine_amount" required>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="provision"> Provision</label>
                                        <textarea required class="form-control" id="provision" name="provision" rows="4">{{$fine->provision}}</textarea>
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
