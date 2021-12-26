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


    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="widget-content widget-content-area br-6">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Offence and Fine Payment Details </h4>
                                    </div>
                        <div class="table-responsive mb-4 mt-4">
                            <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Issued Police Division</th>
                                        <th>Section of Act</th>
                                        <th>Fine Isuued Date</th>
                                        <th>Payment Due Date</th>
                                        <th>Fine Amount</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($offences as $offence)
                                        <tr>
                                            <td>{{$offence->id}}</td>
                                            <td>{{$offence->police->policeDivision->name}} </td>
                                            <td>{{$offence->fine[0]['section_of_act'] }}</td>
                                            <td>{{$offence->fine_issued_date}}</td>
                                            <td>{{$offence->payment_date}}</td>
                                            <td>{{$offence->total_fine_amount}}</td>
                                            <td>
                                            @if($offence->payment_status==1 )
                                            <span class="badge badge-pill badge-warning">Pending</span>
                                            @elseif ($offence->payment_status==2)
                                            <span class="badge badge-pill badge-success">Paid</span>
                                            @elseif ($offence->payment_status==3)
                                            <span class="badge badge-pill badge-danger">Overdue</span>
                                            @endif
                                            </td>
                                            <td>

                                                <a href="{{URL('/licensed_holder/offence/view')}}/{{$offence->id}}" class="btn btn-primary mb-2">Pay Now </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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

            </div>
        </div>
    </div>

</div>
<!-- END MAIN CONTAINER -->
@endsection
