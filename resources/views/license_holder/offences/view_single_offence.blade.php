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
        <div class="row">
            <div class="col-md-8 offset-1">

                <div class="row my-4">
                    <div id="flFormsGrid" class="col-lg-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Spot Fine Detail</h4>
                            </div>
                            @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                            @endif

                            <div class="widget-content widget-content-area">
                                <form class="needs-validation" action="https://sandbox.payhere.lk/pay/checkout" method="POST" novalidate>
                                    @csrf
                                    {{-- <input type="hidden" name="merchant_id" value="1216105">
                                    <input type="hidden" name="return_url" value="{{URL('/licensed_holder/offences_all')}}">
                                    <input type="hidden" name="cancel_url" value="{{URL('/licensed_holder/offences_all')}}">
                                    <input type="hidden" name="notify_url" value="{{URL('/payhere/notify')}}">
                                    <input type="hidden" name="first_name" value="{{$offence->licensedHolder->first_name}}">
                                    <input type="hidden" name="last_name" value="{{$offence->licensedHolder->last_name}}"><br>
                                    <input type="hidden" name="email" value="{{$offence->licensedHolder->user->email}}">
                                    <input type="hidden" name="phone" value="{{$offence->licensedHolder->mobile_no}}"><br>
                                    <input type="hidden" name="address" value="{{$offence->licensedHolder->postal_address}}">
                                    <input type="hidden" name="city" value="Colombo">
                                    <input type="hidden" name="country" value="Sri Lanka">
                                    <input type="hidden" name="order_id" value="{{$offence->id}}">
                                    <input type="hidden" name="items" value="{{$offence->id}}">
                                    <input type="hidden" name="currency" value="LKR"> --}}
                                    <div class="form-group mb-3">
                                        <label for="email"> Police Division </label>
                                        <input type="email" readonly class="form-control" id="fine" name="fine" aria-describedby="emailHelp1" value="{{$offence->police->policeDivision->name}}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="email"> Issued Date</label>
                                        <input type="email" readonly class="form-control" id="fine_issued_date" name="fine_issued_date" aria-describedby="emailHelp1" value="{{$offence->fine_issued_date}}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="email"> Payment Due Date</label>
                                        <input type="email" readonly class="form-control" id="payment_date" name="payment_date" aria-describedby="emailHelp1" value="{{$offence->payment_date}}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="email"> Payment Amount</label>
                                        <input type="email" readonly class="form-control" id="amount" name="amount" aria-describedby="emailHelp1" value="{{$offence->total_fine_amount}}">
                                    </div>
                                    {{-- <div class="form-group mb-3">
                                        <label for="email"> Payment Status</label>
                                        <input type="email" readonly class="form-control" id="payment_status" name="payment_status" aria-describedby="emailHelp1" value="{{$offence->paymentStatus->type}}">
                                    </div> --}}
                                    <button class="btn btn-primary mt-3" type="submit">Pay Now</button>
                                    <input type="hidden" name="merchant_id" value="1216105">
                                    <input type="hidden" name="return_url" value="{{URL('/licensed_holder/offences_all')}}">
                                    <input type="hidden" name="cancel_url" value="{{URL('/licensed_holder/offences_all')}}">
                                    <input type="hidden" name="notify_url" value="{{URL('/payhere/notify')}}">
                                    <input type="hidden" name="first_name" value="{{$offence->licensedHolder->first_name}}">
                                    <input type="hidden" name="last_name" value="{{$offence->licensedHolder->last_name}}"><br>
                                    <input type="hidden" name="email" value="{{$offence->licensedHolder->user->email}}">
                                    <input type="hidden" name="phone" value="{{$offence->licensedHolder->mobile_no}}"><br>
                                    <input type="hidden" name="address" value="{{$offence->licensedHolder->postal_address}}">
                                    <input type="hidden" name="city" value="Colombo">
                                    <input type="hidden" name="country" value="Sri Lanka">
                                    <input type="hidden" name="order_id" value="{{$offence->id}}">
                                    <input type="hidden" name="items" value="{{$offence->id}}">
                                    <input type="hidden" name="currency" value="LKR">
                                </form>
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
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTAINER -->
@endsection
