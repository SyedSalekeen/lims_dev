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

            @if (Session::get('expensive_report_store'))
                <?php
                session()->forget('expensive_report_store');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Expensive Report has been added' }}</p>
                </div>
            @endif

            @if (Session::get('expensive_report_updated'))
                <?php
                session()->forget('expensive_report_updated');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Expensive Report has been updated' }}</p>
                </div>
            @endif

            @if (Session::get('expensive_report_deleted'))
                <?php
                session()->forget('expensive_report_deleted');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Expensive Report has been deleted' }}</p>
                </div>
            @endif

            @if (Session::get('vendor_expensive_one_fileld_required'))
            <?php
            session()->forget('vendor_expensive_one_fileld_required');
            ?>
            <div class="alert my-2 alert-danger">
                <p>{{ 'One of two fields are required' }}</p>
            </div>
        @endif


            {!! Form::open(['route' => 'epensive_report.filterReports', 'method' => 'POST']) !!}
            <div class="form form-horizontal mb-5">
                <div class="form-body">
                    <h4 class="form-section"><i class="ft-user"></i>Filter Expense Report</h4>
                    <div class="form-group row">
                        {{-- <label class="col-md-3 label-control" for="projectinput4">Year</label> --}}
                        <div class="col-md-2 mx-auto">
                            <select class="form-select cstm-slect" name="day" aria-label="Default select example">
                                <option selected disabled>Select Date</option>
                                <option value="01">1</option>
                                <option value="02">2</option>
                                <option value="03">3</option>
                                <option value="04">4</option>
                                <option value="05">5</option>
                                <option value="06">6</option>
                                <option value="07">7</option>
                                <option value="08">8</option>
                                <option value="09">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select>
                        </div>
                        <div class="col-md-2 mx-auto">
                            <select class="form-select cstm-slect" name="month" aria-label="Default select example">
                                <option selected disabled>Select Month</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>

                            </select>
                        </div>
                        <div class="col-md-2 mx-auto">
                            <select class="form-select cstm-slect" name="year" aria-label="Default select example">
                                <option selected disabled>Select Year</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                            </select>
                        </div>

                        <div class="col-md-3 mx-auto">
                            <select class="form-select cstm-slect" name="branch" aria-label="Default select example">
                                <option selected disabled>Select Branch</option>
                                @foreach ($get_vendor_branch as $item)
                                    <option value="{{ $item->id }}">{{ $item->branch_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    {{-- <label class="col-md-3 label-control" for="projectinput4">Branch</label> --}}





                    {{-- <label class="col-md-3 label-control" for="projectinput4">Year</label> --}}

                    <div class="col-xs-12 col-sm-12 col-md-12 text-center filter_button">
                        @if (@$data)
                        <a href="{{route('epensive_report.index')}}">
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


                <div class="col-xs-12 col-sm-12 col-md-12">
                    {{-- {{ route('branch.index') }} --}}
                    <a href="{{ route('export_report') }}" class="btn back-button-color float-left box-shadow-1 mt-1 mb-1 mr-1"><i
                            class="ft-arrow-left"></i> Export to Excel</a>
                </div>

                <div class="card-header">
                    <h4 class="card-title">Expense Reports</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li>
                                <a href="{{ route('epensive_report.create') }}"><button class="btn create-new-button"><i
                                            class="fas fa-plus"></i> Create
                                        New</button></a>

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
                                            colspan="1" style="width: 120px;"
                                            aria-label="Image: activate to sort column ascending">Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 120px;"
                                            aria-label="Name: activate to sort column ascending">Date</th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 200px;"
                                            aria-label="Employee Group: activate to sort column ascending">Amount
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 200px;"
                                            aria-label="Employee Group: activate to sort column ascending">Descriptions
                                        </th>
                                        <th style="text-align: center; width: 75px;" class="sorting" tabindex="0"
                                            aria-controls="myTable" rowspan="1" colspan="1"
                                            aria-label="Action: activate to sort column ascending">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($get_expensive_reports as $item)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1" tabindex="0">{{$loop->index + 1}}</td>
                                            <td>{{ $item->expensive_name }}</td>
                                            <td>{{ $item->expensive_date }}</td>
                                            <td>{{ $item->expensive_amount }}</td>
                                            <td>{{ $item->expensive_description }}</td>

                                            <td>
                                                <center class="for-button-inline">
                                                    <a href="{{ route('epensive_report.edit', $item->id) }}"
                                                        class="btn bstm-color-btnns btn-circle"
                                                        style="background-color: #007bff !important;padding: 6px 10px"
                                                        data-toggle="tooltip" data-original-title="Edit">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="{{ route('epensive_report.destroy_delete', $item->id) }}"
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
