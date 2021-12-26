@extends('layouts.master')

@section('content')
<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>

    <!--  BEGIN SIDEBAR  -->
    <div class="sidebar-wrapper sidebar-theme">

        @include('admin.side_bar');

    </div>
    <!--  END SIDEBAR  -->

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="row layout-top-spacing">
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-account-invoice-one">
                        <div class="widget-heading">

                        </div>
                        <div class="widget-content">
                            <div class="invoice-box">
                                <div class="acc-total-info">
                                    <h5 class="">Total License Holders</h5>
                                    <p class="acc-amount">{{$license_holders->license_holders_counts}}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-account-invoice-one">
                        <div class="widget-heading">

                        </div>
                        <div class="widget-content">
                            <div class="invoice-box">

                                <div class="acc-total-info">
                                    <h5 class="">Total Police Officers</h5>
                                    <p class="acc-amount">{{$police_officers->police_officers_counts}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-account-invoice-one">
                        <div class="widget-heading">

                        </div>
                        <div class="widget-content">
                            <div class="invoice-box">
                                <h5 class="">Total Offences</h5>
                                <div class="acc-total-info">
                                    <p class="acc-amount">{{$offences_count->total_offences_counts}}</p>
                                </div>
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
