@extends('layouts.master')

@section('styles')
<link href="{{URL('plugins/table/datatable/datatables.css')}}" rel="stylesheet">
<link href="{{URL('plugins/table/datatable/custom_dt_html5.css')}}" rel="stylesheet">
<link href="{{URL('plugins/table/datatable/dt-global_style.css')}}" rel="stylesheet">
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
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if (session('status2'))
                    <div class="alert alert-danger">
                        {{ session('status2') }}
                    </div>
                    @endif
                    <div class="widget-content widget-content-area br-6">
                       <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Reports</h4>
                       </div>
                       <div class="container">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                  <label for="registration_number">Select report You want </label>
                                    <select class="form-control" id="report_select" name="report_select">
                                    <option value="0">Select report</option>
                                    <option value="1">License_holders report</option>
                                    <option value="2">Police divisions report</option>
                                    <option value="3">Fine types report</option>
                                    <option value="4">Vehicle class report</option>
                                    <option value="5">Payment report</option>
                                </select>
                              </div>
                        <div class="col-md-4 mb-4">
                            <label for="todate">To Date </label>
                            <div class="form-group mb-0">
                                <input type="date" id="todate" name="todate" class="form-control flatpickr  flatpickr-input active" >
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="fromdate">From Date </label>
                            <div class="form-group mb-0">
                                <input type="date" id="fromdate" name="fromdate" class="form-control flatpickr  flatpickr-input active" >
                            </div>
                        </div>
                    </div></div>
                        <div class="col-md-6">
                            <button class="btn btn-primary mt-3" type="button" id="btnsubmit">Submit</button>
                        </div>

                        @if($license_holders != null)
                        <div class="table-responsive mb-4 mt-4">
                            <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>License ID</th>
                                        <th>Demerit Points</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($license_holders as $license_holder)
                                    <tr>
                                        <td>{{$license_holder->license_no}}</td>
                                        <td>{{$license_holder->total_demerit_points}}</td>
                                        <td>{{$license_holder->licenseStatus->type}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif

                        @if ($police_divisions != null)
                        <div class="table-responsive mb-4 mt-4">
                            <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Police Division</th>
                                        <th>No of Police Officer</th>
                                        <th>No of Issued offense</th>
                                        <th>Total Fine Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($police_divisions as $division)
                                    <tr>
                                        <td>{{$division->name}}</td>
                                        <td>{{$division->no_of_police_officer}}</td>
                                        <td>{{$division->no_of_offence}}</td>
                                        <td>{{$division->total_amount}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif

                        @if ($fine_types != null)
                        <div class="table-responsive mb-4 mt-4">
                            <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Section of Act</th>
                                        <th>No of offenses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($fine_types as $fine_type)
                                    <tr>
                                        <td>{{$fine_type->section_of_act}}</td>
                                        <td>{{$fine_type->no_of_offences}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif

                        @if ($vehicle_classes != null)
                        <div class="table-responsive mb-4 mt-4">
                            <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Vehicle class</th>
                                        <th>Description</th>
                                        <th>No of offenses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($vehicle_classes as $vehicle_classe)
                                    <tr>
                                        <td>{{$vehicle_classe->vehicle_class}}</td>
                                        <td>{{$vehicle_classe ->desctription}}</td>
                                        <td>{{$vehicle_classe->no_of_offences}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif

                        @if ($payments != null)
                        <div class="table-responsive mb-4 mt-4">
                            <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Payment Status</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($payments as $payment)
                                    <tr>
                                        <td>{{$payment->type}}</td>
                                        <td>{{$payment->total_amount}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-wrapper">
            <div class="footer-section f-section-1">
                <p class="">Copyright © 2021 DrivSRI, All
                    Rights Reserved.</p>
            </div>

        </div>
</div>

<!--  END CONTENT AREA  -->

</div>
@endsection

@section('scripts')
<script src="{{URL('plugins/table/datatable/datatables.js')}}"></script>
<!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
<script src="{{URL('plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
<script src="{{URL('plugins/table/datatable/button-ext/jszip.min.js')}}"></script>
<script src="{{URL('plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
<script src="{{URL('plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
<script>


    $('#html5-extension').DataTable({
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
        buttons: {
            buttons: [{
                    extend: 'copy',
                    className: 'btn'
                },
                {
                    extend: 'csv',
                    className: 'btn'
                },
                {
                    extend: 'excel',
                    className: 'btn'
                },
                {
                    extend: 'print',title :'DriSri Managment Information Report',
                    className: 'btn'

                }
            ]
        },
        "oLanguage": {
            "oPaginate": {
                "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
            },
            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search...",
            "sLengthMenu": "Results :  _MENU_",
        },
        "stripeClasses": [],
        "lengthMenu": [7, 10, 20, 50],
        "pageLength": 7,
        searching: true
    });


    $( "#btnsubmit" ).click(function() {

        if($("#report_select").val() == 0)
        {
            alert("Please select report");
        }
        else{
            var type = $("#report_select").val();
            window.location.href = "{{URL('/admin/reports')}}/"+type;
        }
    });
</script>
@endsection
