@extends('user.layouts.master')
@section('content')

    <div class="row">
        <div class="col-12">
            @if ($message = Session::get('success'))
                <div class="alert my-2 alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            @if (Session::get('branch_user_create'))
                <?php
                session()->forget('branch_user_create');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'User has been created' }}</p>
                </div>
            @endif
            @if (Session::get('branch_user_update'))
                <?php
                session()->forget('branch_user_update');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'User has been Updated' }}</p>
                </div>
            @endif

            @if (Session::get('branch_user_delete'))
                <?php
                session()->forget('branch_user_delete');
                ?>
                <div class="alert my-2 alert-danger">
                    <p>{{ 'User has been Deleted' }}</p>
                </div>
            @endif





            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">User Management</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li>
                                <a href="{{ route('branch_user.create') }}"><button class="btn create-new-button"><i
                                    class="fas fa-plus"></i> Create
                                New</button></a>


                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div style="background: white;padding:24px 10px;">
                    <div class="table-responsive">
                        <table id="myTable" class="table w-100 dataTable no-footer dtr-inline" role="grid"
                            aria-describedby="myTable_info" style="width: 100%;">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1"
                                        style="width: 35.15px;" aria-sort="ascending"
                                        aria-label="#: activate to sort column descending">#</th>
                                    <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1"
                                        style="width: 89.15px;" aria-label="Image: activate to sort column ascending">Image
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1"
                                        style="width: 125.15px;" aria-label="Name: activate to sort column ascending">Name
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1"
                                        style="width: 181.15px;"
                                        aria-label="Employee Group: activate to sort column ascending">Email
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1"
                                        style="width: 275.15px;" aria-label="Service: activate to sort column ascending">
                                        URL</th>
                                    <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1"
                                        style="width: 76.15px;" aria-label="Role: activate to sort column ascending">Status
                                    </th>
                                    <th style="text-align: center; width: 213.15px;" class="sorting" tabindex="0"
                                        aria-controls="myTable" rowspan="1" colspan="1"
                                        aria-label="Action: activate to sort column ascending">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($user as $item)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1" tabindex="0">{{$loop->index + 1}}</td>
                                        <td>
                                            @if ($item->profile_image)
                                                <img src="{{ asset('uploads/profile/' . $item->profile_image) }}"
                                                    class="img" height="65em" width="65em">
                                            @else
                                                <img src="https://appointments.lightbulbsolution.com/public/img/default-avatar-user.png"
                                                    class="img" height="65em" width="65em">
                                            @endif
                                        </td>
                                        <td>{{ $item->first_name . ' ' . $item->last_name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            {{ $item->branch->branch_url }}
                                        </td>
                                        <td>
                                            <label class="switch">
                                                <input data-id="{{ $item->id }}" type="checkbox" class="toggle_class"
                                                    data-on="Active" data-off="Inactive"
                                                    {{ $item->status ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <center class="for-button-inline">
                                                <a href="{{ route('branch_user.show', $item->id) }}"
                                                    class="btn bstm-color-btnns btn-circle"
                                                    style="background-color: #007bff !important;color:#fff;"
                                                    data-toggle="tooltip" data-original-title="Edit">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('branch_user.edit', $item->id) }}"
                                                    class="btn bstm-color-btnns btn-circle"
                                                    style="background-color: #007bff !important;color:#fff;"
                                                    data-toggle="tooltip" data-original-title="Edit">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('branch_user.destroy_delete', $item->id) }}"
                                                    onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};"
                                                    class="btn btn-danger btn-circle delete-row" data-toggle="tooltip"
                                                    data-row-id="708" data-original-title="Delete"  style="padding: 10px 15px;background-color:#fb1e3b !important;">
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
