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
                                        <h4>Spot Fines Details</h4>
                                    </div>


                         {{--  <form action="{{URL('/admin/search_fine')}}" method="get" novalidate>
                            @csrf

                                <div class="form-row">
                                  <div class="col-md-4 mb-4">
                                        <input type="search" class="form-control" id="search" name="search" placeholder="Search Product" >
                                        <button class="btn btn-primary mt-3" type="submit">Submit</button>
                                    </div>
                             </div>
                        </form>  --}}

                        <div class="table-responsive mb-4 mt-4">
                            <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Section Of Act</th>
                                        <th>Povision</th>
                                        <th>Fine Amount</th>
                                        <th>Demerit Point</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($fines as $fine)
                                    <tr>
                                        <td>{{$fine->id}}</td>
                                        <td><a href="{{url('/admin/view_fine/'.$fine->id)}}">{{$fine->section_of_act}}</a></td>
                                        <td>{{$fine->provision}}</td>
                                        <td>{{$fine->fine_amount}}</td>
                                        <td>{{$fine->demerit_points}}</td>
                                         <td>
                                            <a href="{{URL('admin/update_fine/'.$fine->id)}}" class="btn btn-primary mb-2">Update</a>
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
                <p class="">Copyright ?? 2021 DrivSRI, All
                    Rights Reserved.</p>
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
                    extend: 'print',
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
        "pageLength": 7
    });
</script>
@endsection
