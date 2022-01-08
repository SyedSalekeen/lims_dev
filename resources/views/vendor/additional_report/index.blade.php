@extends('admin.layouts.master')
@section('content')

    <div class="row">
        <div class="col-12">
            @if ($message = Session::get('success'))
                <div class="alert my-2 alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert my-2 alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @endif

            @if (Session::get('vendor_additional_report_create'))
                <?php
                session()->forget('vendor_additional_report_create');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Report has been added' }}</p>
                </div>
            @endif

            @if (Session::get('vendor_additional_report_deleted'))
            <?php
            session()->forget('vendor_additional_report_deleted');
            ?>
            <div class="alert my-2 alert-success">
                <p>{{ 'Report has been deleted' }}</p>
            </div>
        @endif



            <div class="card">
                <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                <div class="card-header">
                    <h4 class="card-title">Additional Reports</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li>
                                <a href="{{ route('additional_report.create') }}"><button class="btn create-new-button"><i
                                            class="fas fa-plus"></i> Add New Report</button></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">

                    <div style="background: white;padding:24px 10px;">
                        <div>
                            <table id="myTable" class="table w-100 dataTable no-footer dtr-inline" role="grid"
                                aria-describedby="myTable_info" style="width: 100%; text-align:center">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 50px;" aria-sort="ascending"
                                            aria-label="#: activate to sort column descending">#
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 100px;"
                                            aria-label="Image: activate to sort column ascending">Patient Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 100px;"
                                            aria-label="Name: activate to sort column ascending">Branch Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 250px;"
                                            aria-label="Name: activate to sort column ascending">Test Category</th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 100px;"
                                            aria-label="Employee Group: activate to sort column ascending">Report Id
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 100px;"
                                            aria-label="Employee Group: activate to sort column ascending">MR Number
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 200px;"
                                            aria-label="Employee Group: activate to sort column ascending">Report
                                        </th>
                                        <th style="text-align: center; width: 75px;" class="sorting" tabindex="0"
                                            aria-controls="myTable" rowspan="1" colspan="1"
                                            aria-label="Action: activate to sort column ascending">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($getAdditionalReport as $item)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1" tabindex="0">{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->patient_name }}</td>
                                            <td>{{ $item->branch_name }}</td>
                                            <td>{{ $item->lab_test_name }}</td>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->patient_id }}</td>
                                            <td>
                                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                                    <a href="{{ asset('reports/'.$item->patient_report_pdf) }}"
                                                        class="btn btn-primary float-right box-shadow-1 mr-3 ">View</a>
                                                </div>
                                            </td>
                                            <td>
                                                <center class="for-button-inline">

                                                    <a href="{{ route('additional_report.destroy_delete', $item->id) }}"
                                                        onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};"
                                                        class="btn btn-danger btn-circle delete-row" data-toggle="tooltip"
                                                        data-row-id="708" data-original-title="Delete"
                                                        style="padding: 6px 10px;background-color:#fb1e3b !important;">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </a>
                                                </center>
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
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
