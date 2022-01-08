@extends('admin.layouts.master')
@section('content')

    <div class="row">
        <div class="col-12">
            @if ($message = Session::get('success'))
                <div class="alert my-2 alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            @if (Session::get('role_already_exist'))
                <?php
                session()->forget('role_already_exist');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Role already exist' }}</p>
                </div>
            @endif

            @if (Session::get('permission_created'))
                <?php
                session()->forget('permission_created');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Permission created successfully' }}</p>
                </div>
            @endif

            @if (Session::get('permission_updated'))
                <?php
                session()->forget('permission_updated');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Permission updated successfully' }}</p>
                </div>
            @endif

            @if (Session::get('permission_deleted'))
                <?php
                session()->forget('permission_deleted');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Permission deleted successfully' }}</p>
                </div>
            @endif


            <div class="card">
                <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                <div class="card-header">
                    <h4 class="card-title">Permission Management</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li>
                                <a href="{{ route('role_permission.create') }}" id="add_item" class="btn btn-success">
                                    <i class="ft-plus"></i>
                                </a>
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
                                        style="width: 89.15px;" aria-label="Image: activate to sort column ascending">Branch Name
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1"
                                        style="width: 125.15px;" aria-label="Name: activate to sort column ascending">Role
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1"
                                        style="width: 58px;"
                                        aria-label="Employee Group: activate to sort column ascending">Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($getPermissions as $value)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1" tabindex="0">{{$loop->index + 1}}</td>
                                        <td>{{ $value->branch_name->branch_name }}</td>
                                        <td>{{ $value->role_name->name }}</td>
                                        <td>
                                            <center class="for-button-inline">
                                                <a href="{{ route('role_permission.show', $value->id) }}"
                                                    class="btn bstm-color-btnns btn-circle"
                                                    style="background-color: #007bff !important;color:#fff;"
                                                    data-toggle="tooltip" data-original-title="Edit">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('role_permission.edit', $value->id) }}"
                                                    class="btn bstm-color-btnns btn-circle"
                                                    style="background-color: #007bff !important;color:#fff;"
                                                    data-toggle="tooltip" data-original-title="Edit">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('role_permission.destroy_delete', $value->id) }}"
                                                    onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};"
                                                    class="btn btn-danger btn-circle delete-row" data-toggle="tooltip"
                                                    data-row-id="708" data-original-title="Delete" style="color:#fff;">
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
