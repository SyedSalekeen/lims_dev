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

            @if (Session::get('agregate_data_field_is_required'))
                <?php
                session()->forget('agregate_data_field_is_required');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Age and Type are required'}}</p>
                </div>
            @endif



            {!! Form::open(['route' => 'agregateData.filterReports', 'method' => 'POST']) !!}
            <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">

            <div class="form form-horizontal mb-5">
                <div class="form-body">
                    <h4 class="form-section"><i class="ft-user"></i>Filter Agregate Data</h4>
                    <div class="form-group row">

                        <div class="col-md-3 mx-auto">
                            <select class="form-select cstm-slect" id="age" name="age" aria-label="Default select example">
                                <option selected disabled>Select Age</option>
                                <option value="12-20">12-20</option>
                                <option value="21-29">21-29</option>
                                <option value="30-38">30-38</option>
                                <option value="39-47">39-47</option>
                                <option value="48-56">48-56</option>
                                <option value="57-65">57-65</option>
                                <option value="66-74">66-74</option>
                                <option value="75-80">75-80</option>
                            </select>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <select class="form-select cstm-slect" name="filter_type" aria-label="Default select example">
                                <option selected disabled>Select Type</option>
                                <option value="Patient">Patient</option>
                                <option value="Report">Report</option>

                            </select>
                        </div>
                        <div class="col-md-3 mx-auto">
                            <select class="form-select cstm-slect" name="lab_id" id="selectlabName"
                                onchange="changeFuncOne();">
                                <option selected disabled>Select laboratory</option>
                                @foreach ($lab_filter as $lab)
                                    <option value="{{ $lab->id }}">
                                        {{ $lab->laboratory_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 mx-auto">
                            <select class="form-select cstm-slect" name="branch_id" id="branch"
                                aria-label="Default select example" id="selectbranches">

                            </select>
                        </div>




                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-12 text-center filter_button">
                        @if (@$backButton)
                            <a href="{{ route('aggregate_data') }}">
                                <button type="button"
                                    class="btn for-marg-right create-new-button float-right box-shadow-1 mt-1 mb-1"><i
                                        class="ft-arrow-left "></i>Back</button> </a>
                        @endif
                        <button type="submit" class="btn create-new-button float-right box-shadow-1 mt-1 mb-1"><i
                                class="ft-check "></i> Filter</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>




            <div class="card mt-5">
                <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">

                <div class="card-header">
                    <h4 class="card-title">Agregate Data</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        @if (@$filterType == 'patient')
                            <h1>{{$filterPatientCount}}</h1>
                        @endif
                        @if (@$filterType == 'report')
                        <h1>{{$filterReportCount}}</h1>
                        @endif
                    </div>
                </div>

                @if (@$filterType == 'patient')
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
                                                colspan="1" style="width: 120px;"
                                                aria-label="Image: activate to sort column ascending">Patient Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                                colspan="1" style="width: 120px;"
                                                aria-label="Image: activate to sort column ascending">Patient Email</th>
                                            <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                                colspan="1" style="width: 120px;"
                                                aria-label="Image: activate to sort column ascending">Patient MR</th>
                                            <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                                colspan="1" style="width: 120px;"
                                                aria-label="Image: activate to sort column ascending">Laboratory Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                                colspan="1" style="width: 120px;"
                                                aria-label="Image: activate to sort column ascending">Branch Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                                colspan="1" style="width: 120px;"
                                                aria-label="Image: activate to sort column ascending">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($getFilterPatients as $key => $item)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1" tabindex="0">{{ $key + 1 }}</td>
                                                <td>{{ $item->fullname }}</td>
                                                <td>{{ $item->patient_email }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->laboratory_name }}</td>
                                                <td>{{ $item->branch->branch_name }}</td>
                                                <td>
                                                    <center class="for-button-inline">

                                                        <a href="{{ route('agergate_data_patient', $item->id) }}">
                                                            <button type="button"
                                                                class="btn for-marg-right create-new-button float-right box-shadow-1">View
                                                                Details</button> </a>
                                                    </center>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                @if (@$filterType == 'report')
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
                                                colspan="1" style="width: 120px;"
                                                aria-label="Image: activate to sort column ascending">Patient Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                                colspan="1" style="width: 120px;"
                                                aria-label="Image: activate to sort column ascending">Laboratory Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                                colspan="1" style="width: 120px;"
                                                aria-label="Image: activate to sort column ascending">Branch Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                                colspan="1" style="width: 120px;"
                                                aria-label="Image: activate to sort column ascending">Patient MR</th>
                                            <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                                colspan="1" style="width: 120px;"
                                                aria-label="Image: activate to sort column ascending">Report #</th>
                                            <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                                colspan="1" style="width: 120px;"
                                                aria-label="Image: activate to sort column ascending">Report</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    @foreach ($getFilterPatientsReport as $key => $item)
                                    @if($item->invoice_id != "")
                                        <tr role="row" class="odd">
                                            <td class="sorting_1" tabindex="0">{{ $key+1 }}</td>
                                            <td>{{ $item->first_name }} {{ $item->get_patient_name->fullname }}</td>
                                            <td>{{ $item->first_name }} {{ $item->laboratory_name }}</td>
                                            <td>{{ $item->first_name }} {{ $item->get_branch_name->branch_name }}</td>
                                            <td>{{ $item->first_name }} {{ $item->patient_id }}</td>
                                            <td>{{ $item->first_name }} {{ $item->id }}</td>
                                            <td>
                                                <center class="for-button-inline">

                                                    <a href="{{route('agregate_reports', $item->id)}}">
                                                        <button type="button"
                                                            class="btn for-marg-right create-new-button float-right box-shadow-1">View
                                                            </button> </a>
                                                </center>
                                            </td>
                                        </tr>
                                    @else
                                    <tr role="row" class="odd">
                                        <td class="sorting_1" tabindex="0">{{ $key+1 }}</td>
                                        <td>{{ $item->first_name }} {{ $item->get_patient_name->fullname }}</td>
                                        <td>{{ $item->first_name }} {{ $item->laboratory_name }}</td>
                                        <td>{{ $item->first_name }} {{ $item->get_branch_name->branch_name }}</td>
                                        <td>{{ $item->first_name }} {{ $item->patient_id }}</td>
                                        <td>{{ $item->first_name }} {{ $item->id }}</td>
                                        <td>
                                            <center class="for-button-inline">

                                                <a href="{{asset('reports/'. $item->patient_report_pdf)}}">
                                                    <button type="button"
                                                        class="btn for-marg-right create-new-button float-right box-shadow-1">View
                                                        </button> </a>
                                            </center>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
        const TOKEN = $("#token").val();

        function changeFuncOne() {
            console.log("here");

            var selectBox = document.getElementById("selectlabName");
            var selectedValueId = selectBox.options[selectBox.selectedIndex].value;
            console.log(selectedValueId);
            $(document).ready(function() {
                branchesData = []
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": TOKEN
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('get_branches') }}",
                    dataType: "json",
                    data: {
                        id: selectedValueId,
                    },
                    success: function(response) {
                        console.log(response);
                        response.data.map((val) => {
                            branchesData.push(val)
                        })
                        branchesData.map((val) => {
                            console.log("vals", val);
                            $('#branch').append(`<option value="${val.id}">
                            ${val.branch_name}
                             </option>`)
                        });
                    }
                });
            });
        }
    </script>


@endsection
