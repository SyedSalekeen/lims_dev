@extends('user.layouts.master')
@section('content')

    <div class="row">
        <div class="col-12">
            @if ($message = Session::get('success'))
                <div class="alert my-2 alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            @if (Session::get('branch_patient_create'))
                <?php
                session()->forget('branch_patient_create');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Patient has been created' }}</p>
                </div>
            @endif
            @if (Session::get('branch_patient_updated'))
                <?php
                session()->forget('branch_patient_updated');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Patient has been updated' }}</p>
                </div>
            @endif
            @if (Session::get('branch_patient_delete'))
                <?php
                session()->forget('branch_patient_delete');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Patient has been delete' }}</p>
                </div>
            @endif
            @if (Session::get('branch_patient_filter_one_field_required'))
                <?php
                session()->forget('branch_patient_filter_one_field_required');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'One of the two fields is required' }}</p>
                </div>
            @endif
            @if (Session::get('branch_patient_invoice_has_created'))
                <?php
                session()->forget('branch_patient_invoice_has_created');
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
                                <a href="{{ route('branch_patient.create') }}"><button class="btn create-new-button"><i
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
                                                <center class="for-button-inline">
                                                    <a href="{{ route('branch_patient.show', $item->id) }}"
                                                        class="btn bstm-color-btnns btn-circle"
                                                        style="background-color: #007bff !important;padding: 6px 10px"
                                                        data-toggle="tooltip" data-original-title="Edit">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="{{ route('branch_patient.edit', $item->id) }}"
                                                        class="btn bstm-color-btnns btn-circle"
                                                        style="background-color: #007bff !important;padding: 6px 10px"
                                                        data-toggle="tooltip" data-original-title="Edit">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="{{ route('branch_patient.destroy_delete', $item->id) }}"
                                                        class="btn btn-danger btn-circle delete-row"
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

                {{-- <div class="card-content collapse show">

                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>MR NUMBER</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($get_patients as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->first_name . ' ' . $item->last_name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            <a class="btn  btn-info btn-sm box-shadow-1"
                                                href="{{ route('branch_patient.show', $item->id) }}"><i
                                                    class="ft-eye"></i></a>
                                            @if ($get_permission_edit_patient)
                                                <a class="btn btn-primary box-shadow-1 btn-sm"
                                                    href="{{ route('branch_patient.edit', $item->id) }}"><i
                                                        class="ft-edit"></i></a>
                                            @endif
                                            @if ($get_permission_delete_patient)
                                                <span>
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['branch_patient.destroy', $item->id], 'style' => 'display:inline']) !!}
                                                    {!! Form::submit('🗑', ['class' => 'btn btn-danger btn-sm box-shadow-1', 'onclick' => "return confirm('Are you sure you want to delete?');"]) !!}
                                                    {!! Form::close() !!}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

@endsection
