@extends('patient.layouts.master')
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

            @if (Session::get('branch_test_add'))
                <?php
                session()->forget('branch_test_add');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Test has been created' }}</p>
                </div>
            @endif
            @if (Session::get('branch_test_updated'))
                <?php
                session()->forget('branch_test_updated');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Test has been updated' }}</p>
                </div>
            @endif
            @if (Session::get('branch_test_deleted'))
                <?php
                session()->forget('branch_test_deleted');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Test has been deleted' }}</p>
                </div>
            @endif


            <div class="card">
                <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                <div class="card-header">
                    <h4 class="card-title">Patient Reports</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">

                    </div>
                </div>
                {{-- <div class="card-content collapse show">

                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Sr #</th>
                                    <th>MR NUMBER</th>
                                    <th>Patient Name</th>


                                    <th>Report</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($get_test as $value)
                                    <tr role="row">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $value->patient_id }}</td>
                                        <td>{{ $value->patient_name }}</td>



                                        <td> <a class="btn  btn-danger btn-sm box-shadow-1"
                                                href="{{ route('patient_report.show', $value->id) }}"><i
                                                    class="ft-eye"></i></a></td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div> --}}

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
                                        colspan="1" style="width: 300px;"
                                        aria-label="Name: activate to sort column ascending">Patient Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 250px;"
                                            aria-label="Image: activate to sort column ascending">Invoice Number</th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 250px;"
                                            aria-label="Image: activate to sort column ascending">Report Number</th>

                                            <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 300px;"
                                            aria-label="Name: activate to sort column ascending">Test Category</th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 270px !important;"
                                            aria-label="Employee Group: activate to sort column ascending">Report
                                        </th>

                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($get_test as $item)
                                        @if ($item->invoice_id == '')
                                            <tr role="row" class="odd">
                                                <td class="sorting_1" tabindex="0">{{ $loop->index + 1 }}</td>
                                                <td>{{ $item->patient_name }}</td>
                                                <td>N\A</td>
                                                <td>{{ $item->id }}</td>

                                                <td>{{ $item->lab_test_name }}</td>
                                                <td>
                                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                                        <a href="{{ asset('reports/' . $item->patient_report_pdf) }}"
                                                            class="btn btn-primary float-right box-shadow-1 mr-5 ">View</a>
                                                    </div>
                                                </td>

                                            </tr>
                                        @else
                                            <tr role="row" class="odd">
                                                <td class="sorting_1" tabindex="0">{{ $loop->index + 1 }}</td>
                                                <td>{{ $item->patient_name }}</td>
                                                <td>{{ $item->invoice_id }}</td>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->lab_test_name }}</td>
                                                <td>
                                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                                        <a href="{{ route('patient_report.show', $item->id) }}"
                                                            class="btn btn-primary float-right box-shadow-1 mr-5 ">View</a>
                                                    </div>
                                                </td>


                                            </tr>
                                        @endif

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
