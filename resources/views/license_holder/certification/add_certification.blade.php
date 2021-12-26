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
                            @if (session('status'))
                            <div class="alert alert-danger">
                                {{ session('status') }}
                            </div>
                            @endif
                            @if (session('status2'))
                            <div class="alert alert-success">
                                {{ session('status2') }}
                            </div>
                            @endif
                              <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Request Certificate of Merit </h4>
                                    </div>
                            <div class="widget-header">
                                <div class="row">

                                </div>
                            </div>
                            <div class="widget-content widget-content-area">

                                @if (($license_holders->total_demerit_points) <=5)
                                       <a class="btn btn-success mt-3" href="{{URL('/licensed_holder/save_certificate/'.$user->id)}}">Request</a>
                                @else
                                    <h5 class="text-danger">Your Accumulated Demerit Points are more than 5. </h5>
                                @endif

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

            </div>
        </div>
            </div>
        </div>
        </div>
    </div>
    <!--  END CONTENT AREA  -->

</div>
<!-- END MAIN CONTAINER -->
@endsection
