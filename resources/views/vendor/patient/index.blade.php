@extends('admin.layouts.master')
@section('content')

    <div class="row">
        <div class="col-12">
            @if ($message = Session::get('success'))
                <div class="alert my-2 alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            @if (Session::get('patient_created'))
                <?php
                session()->forget('patient_created');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Patient has been created' }}</p>
                </div>
            @endif
            @if (Session::get('patient_updated'))
                <?php
                session()->forget('patient_updated');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Patient has been updated' }}</p>
                </div>
            @endif
            @if (Session::get('patient_deleted'))
                <?php
                session()->forget('patient_deleted');
                ?>
                <div class="alert my-2 alert-danger">
                    <p>{{ 'Patient has been daleted' }}</p>
                </div>
            @endif
            @if (Session::get('patient_and_invoice_created'))
                <?php
                session()->forget('patient_and_invoice_created');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Patient and invoice has been created' }}</p>
                </div>
            @endif


            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Patient Management</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li>
                                <a href="{{ route('patient.create') }}"><button class="btn create-new-button"><i
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
                                            colspan="1" style="width: 20px;" aria-sort="ascending"
                                            aria-label="#: activate to sort column descending">#
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 120px;"
                                            aria-label="Image: activate to sort column ascending">Patient Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 120px;"
                                            aria-label="Name: activate to sort column ascending">Patient Email</th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 100px;"
                                            aria-label="Employee Group: activate to sort column ascending">Patient MR NUMBER
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 120px;"
                                            aria-label="Role: activate to sort column ascending">Branch
                                        </th>
                                        <th style="text-align: center; width: 75px;" class="sorting" tabindex="0"
                                            aria-controls="myTable" rowspan="1" colspan="1"
                                            aria-label="Action: activate to sort column ascending">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($get_patients as $item)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1" tabindex="0">{{$loop->index + 1}}</td>
                                            <td>{{ $item->fullname }}</td>
                                            <td>
                                                {{ $item->patient_email }}
                                            </td>
                                            <td>
                                                {{ $item->email }}
                                            </td>
                                            <td>
                                                {{ $item->branch->branch_name }}
                                            </td>
                                            <td>
                                                <center class="for-button-inline">
                                                    <a href="{{ route('patient.show', $item->id) }}"
                                                        class="btn bstm-color-btnns btn-circle"
                                                        style="background-color: #007bff !important;padding: 6px 10px"
                                                        data-toggle="tooltip" data-original-title="Edit">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="{{ route('patient.edit', $item->id) }}"
                                                        class="btn bstm-color-btnns btn-circle"
                                                        style="background-color: #007bff !important;padding: 6px 10px"
                                                        data-toggle="tooltip" data-original-title="Edit">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="{{route('patient_destroy_delete',$item->id)}}" class="btn btn-danger btn-circle delete-row"
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



{{-- @extends('admin.layouts.master')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert my-2 alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if (Session::get('patient_created'))
        <?php
        session()->forget('patient_created');
        ?>
        <div class="alert my-2 alert-success">
            <p>{{ 'Patient has been created' }}</p>
        </div>
    @endif
    @if (Session::get('patient_updated'))
        <?php
        session()->forget('patient_updated');
        ?>
        <div class="alert my-2 alert-success">
            <p>{{ 'Patient has been updated' }}</p>
        </div>
    @endif
    @if (Session::get('patient_deleted'))
        <?php
        session()->forget('patient_deleted');
        ?>
        <div class="alert my-2 alert-success">
            <p>{{ 'Patient has been daleted' }}</p>
        </div>
    @endif
    <div class="filterBox">
        <input type="search" id="VendorfilterPatient" value="" placeholder="Search customer by name, email or phone">
        <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
    </div>
    <div class="cards-list">
        @foreach ($get_patients as $item)
            <a href="{{ route('vendor_patient_inner', $item->id) }}">
                <div class="cardBox">
                    <div class="upperSec">
                        <h4>{{ $item->fullname }}</h4>
                        <p> <i class="fas fa-envelope"></i>{{ $item->patient_email }}</p>
                        <p> <i class="fas fa-phone-alt"></i>{{ $item->contact_number }}</p>
                    </div>
                    <div class="lowerSec">
                        <div class="lower">
                            <div class="lowerBox">
                                <p> <strong>0</strong></p>
                                <p>BOOKINGS</p>
                            </div>
                            <div class="lowerBox">
                                <p> <strong>{{ date('F d, Y', strtotime($item->created_at)) }}</strong></p>
                                <p>PATIENT SINCE</p>
                            </div>
                        </div>
                    </div>

                </div>
        @endforeach

    </div>

@endsection --}}
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    {{-- <script>
        const TOKEN = $("#token").val();
        $(document).ready(function() {
            $('#VendorfilterPatient').on('keyup', function() {
                console.log("here");

                notesDocumentData = [];
                var query = $(this).val();
                console.log(query);
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": TOKEN
                    }
                });
                $.ajax({
                    url: "{{ route('vendor_patient_searches') }}",
                    type: "POST",
                    data: {
                        'search': query,
                    },
                    success: function(response) {

                        console.log("response");
                    }
                });

            })
        });
    </script> --}}

@endsection
