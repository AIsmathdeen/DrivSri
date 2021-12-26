@extends('layouts.master')

@section('content')
<!--  BEGIN MAIN CONTAINER  -->

<div class="main-container" id="container">
    <div class="overlay"></div>
    <div class="search-overlay"></div>

    <!--  BEGIN SIDEBAR  -->
    <div class="sidebar-wrapper sidebar-theme">

        @include('police.side_bar');
    </div>
    <!--  END SIDEBAR  -->

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-account-invoice-one">
                        <div class="widget-heading">
                            <h5 class="">Police Officer Name</h5>
                        </div>
                        <div class="widget-content">
                            <div class="invoice-box">
                                <div class="acc-total-info">
                                    <p class="acc-amount">{{$user->first_name}}&nbsp;{{$user->last_name}}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-account-invoice-one">
                        <div class="widget-heading">
                            <h5 class="">Police Division Name</h5>
                        </div>
                        <div class="widget-content">
                            <div class="invoice-box">
                                <div class="acc-total-info">
                                    <p class="acc-amount">{{$user->policeDivision->name}}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-account-invoice-one">
                        <div class="widget-heading">
                            <h5 class="">Total Offences Issued</h5>
                        </div>
                        <div class="widget-content">
                            <div class="invoice-box">
                                <div class="acc-total-info">
                                    <p class="acc-amount">
                                        @if ($total_offences_amount)
                                            {{$total_offences_amount}}
                                        @else
                                            0
                                        @endif

                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-wrapper">
            <div class="footer-section f-section-1">
                <p class="">Copyright © 2021 DrivSRI, All rights reserved.</p>
            </div>
            <div class="footer-section f-section-2">
               
            </div>
        </div>
    </div>
    <!--  END CONTENT AREA  -->

</div>
<!-- END MAIN CONTAINER -->
@endsection
