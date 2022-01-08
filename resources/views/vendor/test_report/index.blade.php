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

            @if (Session::get('vendor_test_add'))
                <?php
                session()->forget('vendor_test_add');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Test has been created' }}</p>
                </div>
            @endif
            @if (Session::get('vendor_test_updated'))
                <?php
                session()->forget('vendor_test_updated');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Test has been updated' }}</p>
                </div>
            @endif
            @if (Session::get('vendor_test_deleted'))
                <?php
                session()->forget('vendor_test_deleted');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Test has been deleted' }}</p>
                </div>
            @endif

            @if (Session::get('vendor_test_report_created'))
            <?php
            session()->forget('vendor_test_report_created');
            ?>
            <div class="alert my-2 alert-success">
                <p>{{ 'Report has been created' }}</p>
            </div>
        @endif



            <div class="card">
                <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                <div class="card-header">
                    <h4 class="card-title">Report Listening</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">

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
                                            colspan="1" style="width: 20px;" aria-sort="ascending"
                                            aria-label="#: activate to sort column descending">#
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 100px;"
                                            aria-label="Image: activate to sort column ascending">Patient MR #</th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 100px;"
                                            aria-label="Name: activate to sort column ascending">Invoice #</th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 100px;"
                                            aria-label="Employee Group: activate to sort column ascending">Report #
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 200px;"
                                            aria-label="Employee Group: activate to sort column ascending">Test Category
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 100px;"
                                            aria-label="Role: activate to sort column ascending">Branch Name
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 100px;"
                                            aria-label="Role: activate to sort column ascending">Report
                                        </th>
                                        <th style="text-align: center; width: 75px;" class="sorting" tabindex="0"
                                            aria-controls="myTable" rowspan="1" colspan="1"
                                            aria-label="Action: activate to sort column ascending">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($TestReport as $item)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1" tabindex="0">{{$loop->index + 1}}</td>
                                            <td>{{ $item->patient_id }}</td>
                                            <td>
                                                {{ $item->invoice_id }}
                                            </td>
                                            <td>
                                                {{ $item->id }}
                                            </td>
                                            <td>
                                                {{ $item->lab_test_name }}
                                            </td>
                                            <td>
                                                {{ $item->branch_name }}
                                            </td>
                                            <td>
                                                <a target="_blank" class="btn  btn-success btn-sm box-shadow-1 mr-1"
                                                    href="{{ route('test_report.show', $item->id) }}"><i
                                                        class="ft-eye"></i>View</a>
                                            </td>
                                            <td>
                                                <center class="for-button-inline">

                                                    <a href="{{route('test_report.destroy_delete',$item->id)}}" class="btn btn-danger btn-circle delete-row"
                                                        onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};"
                                                        data-toggle="tooltip" data-row-id="708" data-original-title="Delete"
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
