<?php
$value = \App\User::where(['vendor_id' => auth()->id()])->get();
$vendors = count($value);
?>
@extends('admin.layouts.master')

@section('content')

    <div class="card mt-5">
        <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
        <div class="card-header">
            <h4 class="card-title">Employees List</h4>
            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li>
                    </li>
                </ul>
            </div>
        </div>

        <div style="background: white;padding:24px 10px;">
            <div>
                <table id="myTable" class="table w-100 dataTable no-footer dtr-inline" role="grid"
                    aria-describedby="myTable_info" style="width: 100%; text-align:center">
                    <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1"
                                style="width: 20px;" aria-sort="ascending"
                                aria-label="#: activate to sort column descending">#
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1"
                                style="width: 100px;" aria-label="Name: activate to sort column ascending">Employee Name</th>
                                <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1"
                                style="width: 100px;" aria-label="Name: activate to sort column ascending">Branch Name</th>
                                <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1"
                                style="width: 100px;" aria-label="Name: activate to sort column ascending">Employee Role</th>
                                <!--<th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1"-->
                                <!--style="width: 100px;" aria-label="Name: activate to sort column ascending">Liboratory Name</th>-->
                            <th style="text-align: center; width: 45px;" class="sorting" tabindex="0"
                                aria-controls="myTable" rowspan="1" colspan="1"
                                aria-label="Action: activate to sort column ascending">Show</th>
                        </tr>
                    </thead>

                    <tbody>
                             @foreach ($employeeData as $user)
                        <tr role="row" class="odd">
                            <td class="sorting_1" tabindex="0">{{ $loop->index+1 }}</td>
                            <td>{{ $user->first_name . ' ' . $user->last_name }}</td>
                            <td>--</td>
                            <td>
                            @if ($user->role_id == 1)  Manager
                             @elseif($user->role_id == 2)  Lab Technician
                            @else
                            Front Desk
                            @endif
                        </td>
                            <!--<td>{{ $user->laboratory_name }}</td>-->
                            <td>
                                <center>
                                    <a href="{{ route('vendor_user.show',$user->id) }}" class="btn btn-primary btn-circle" style="background-color: #007bff !important;padding: 6px 10px" data-toggle="tooltip"
                                        data-original-title="show employee">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                    {{-- <a href="" class="btn btn-danger btn-circle delete-row" data-toggle="tooltip"
                                        data-row-id="708" data-original-title="Delete"
                                        style="padding: 6px 10px;background-color:#fb1e3b !important;">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a> --}}
                                </center>
                            </td>
                        </tr>
                          @endforeach
                    </tbody>
                </table>
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
