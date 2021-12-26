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
                    <div class="widget-content widget-content-area br-6">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4> License Holders Details</h4>
                        </div>
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">

                        @if(request()->has('view_deleted'))
                        <p align="right"><a href="{{route('admin.viewLicensedHolders')}}"
                                class="btn btn-primary mb-2">  View All License Holders</a></p>

                        @else
                        <p align="right"><a href="{{route('admin.viewLicensedHolders',['view_deleted'=>'DeletedRecords'])}}"
                                class="btn btn-primary mb-2">  View Deleted License Holders</a></p>
                        @endif
                     </div>
                        <div class="table-responsive mb-4 mt-4">

                            <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>License ID</th>
                                        <th>Name</th>
                                        <th>Demerit Points</th>
                                        <th>Expiry Date</th>
                                        <th>Last Fine Issued Date</th>
                                        <th>Status</th>
                                         @if(!request()->has('view_deleted'))
                                        <th><b>UPDATE</b></th>
                                        @endif

                                        @if(request()->has('view_deleted'))
                                        <th><b>RESTORE</b></th>

                                        @else
                                        <th><b>DELETE</b></th>
                                        @endif
                                        </tr>
                                </thead>
                                <tbody>
                                    @foreach($license_holders as $license_holder)
                                    <tr>
                                        <td><a
                                                href="{{url('/admin/view_license_holder/'.$license_holder->user_id)}}">{{$license_holder->license_no}}</a>
                                        </td>
                                        <td>{{$license_holder->first_name}}&nbsp;{{$license_holder->last_name}}</td>
                                        <td>{{$license_holder->total_demerit_points}}</td>
                                        <td>{{\Carbon\Carbon::parse($license_holder->expiry_date)->format('d/m/Y')}}</td>
                                        <td>{{$license_holder->last_fine_issued_date}}</td>
                                        <td>  @if ($license_holder->status_id==1)
                                                <span class="badge badge-success">{{$license_holder->licenseStatus->type}}</span>
                                            @elseif ($license_holder->status_id==2)
                                                <span class="badge badge-warning">{{$license_holder->licenseStatus->type}}</span>
                                            @elseif($license_holder->status_id==3)
                                                <span class="badge badge-danger">{{$license_holder->licenseStatus->type}}</span>
                                            @else
                                            <span class="badge badge-danger">{{$license_holder->licenseStatus->type}}</span>
                                            @endif
                                        </td>
                                        @if(request()->has('view_deleted'))

                                        @else
                                             <td>
                                                <a href="{{url('/admin/update_license_holders/'.$license_holder->user_id)}}"
                                                class="btn btn-primary mb-2">Update</a>
                                            </td>

                                        @endif

                                        @if(request()->has('view_deleted'))
                                         <form action="{{route('admin.restoreLicensedHolders',$license_holder->user_id)}}"
                                                method="POST">
                                                @csrf
                                                <td>
                                                    <button class="btn btn-success mb-2">Restore</button>
                                                 </td>
                                        </form>

                                        @else
                                             <form action="/admin/delete_license_holders/{{$license_holder->user_id}}"
                                                method="POST" onsubmit="return confirm('{{ trans('Are You Sure ?')}}')";>
                                                @csrf
                                                @method('DELETE')
                                                <td>
                                                    <button class="btn btn-danger mb-2">Delete</button>
                                                 </td>
                                        </form>
                                        @endif
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
                <p class="">Copyright © 2021 DrivSRI, All Rights Reserved.</p>
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
@endsection

@section('scripts')
<script src="{{URL('plugins/table/datatable/datatables.js')}}"></script>
<!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
<script src="{{URL('plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
<script src="{{URL('plugins/table/datatable/button-ext/jszip.min.js')}}"></script>
<script src="{{URL('plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
<script src="{{URL('plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
<script>
    $('#html5-extension').DataTable( {
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
        buttons: {
            buttons: [
                { extend: 'copy', className: 'btn' },
                { extend: 'csv', className: 'btn' },
                { extend: 'excel', className: 'btn' },
                { extend: 'print', className: 'btn' }
            ]
        },
        "oLanguage": {
            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search...",
           "sLengthMenu": "Results :  _MENU_",
        },
        "stripeClasses": [],
        "lengthMenu": [7, 10, 20, 50],
        "pageLength": 7
    } );
</script>
@endsection
