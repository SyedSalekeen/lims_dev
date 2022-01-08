@extends('user.layouts.master')
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

            @if (Session::get('branch_gig_created'))
                <?php
                session()->forget('branch_gig_created');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Test  has been created' }}</p>
                </div>
            @endif
            @if (Session::get('branch_gig_updated'))
                <?php
                session()->forget('branch_gig_updated');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Test has been updated' }}</p>
                </div>
            @endif
            @if (Session::get('branch_gig_already_exist'))
                <?php
                session()->forget('branch_gig_already_exist');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Test already exist' }}</p>
                </div>
            @endif

            @if (Session::get('branch_gig_deleted'))
                <?php
                session()->forget('branch_gig_deleted');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Test deleted successfully' }}</p>
                </div>
            @endif


            <div class="card">
                <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                <div class="card-header">
                    <h4 class="card-title">Test Listing</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li>
                                <a href="{{ route('branch-test-gig.create') }}"><button class="btn create-new-button"><i
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
                                            aria-label="Name: activate to sort column ascending">Best range</th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 200px;"
                                            aria-label="Employee Group: activate to sort column ascending">Unit
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 200px;"
                                            aria-label="Employee Group: activate to sort column ascending">Amount
                                        </th>
                                        <th style="text-align: center; width: 75px;" class="sorting" tabindex="0"
                                            aria-controls="myTable" rowspan="1" colspan="1"
                                            aria-label="Action: activate to sort column ascending">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($get_test_gigs as $item)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1" tabindex="0">{{$loop->index + 1}}</td>
                                            <td>{{ $item->test_name }}</td>
                                            <td>{{ $item->test_best_range }}</td>
                                            <td>{{ $item->test_unit }}</td>
                                            <td>{{ $item->test_amount }}</td>

                                            <td>
                                                <center class="for-button-inline">
                                                    <a href="{{ route('branch-test-gig.edit', $item->id) }}"
                                                        class="btn bstm-color-btnns btn-circle"
                                                        style="background-color: #007bff !important;padding: 6px 10px"
                                                        data-toggle="tooltip" data-original-title="Edit">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="{{ route('branch-test-gig.destroy_delete', $item->id) }}"
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

                {{-- <div class="card-content collapse show">

                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th> Sr #</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Best Range</th>
                                    <th>Unit</th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($get_test_gigs as $value)
                                    <tr role="row">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $value->test_name }}</td>


                                        <td>{{ $value->test_amount }}</td>
                                        <td>{{ $value->test_best_range }}</td>
                                        <td>{{ $value->test_unit }}</td>
                                        <td class="d-flex border-0">
                                            @if ($get_permission_edit_gig)
                                                <a class="btn btn-primary box-shadow-1 btn-sm mr-1"
                                                    href="{{ route('branch-test-gig.edit', $value->id) }}"><i
                                                        class="ft-edit"></i></a>
                                            @endif
                                            @if ($get_permission_delete_gig)
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['branch-test-gig.destroy', $value->id], 'style' => 'display:inline']) !!}
                                                {!! Form::submit('🗑', ['class' => 'btn btn-danger btn-sm box-shadow-1', 'onclick' => "return confirm('Are you sure you want to delete?');"]) !!}
                                                {!! Form::close() !!}
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

@section('scripts')
    <script>

    </script>
@endsection
