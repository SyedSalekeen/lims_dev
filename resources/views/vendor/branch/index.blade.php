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

            @if (Session::get('branch_create_session'))
                <?php
                session()->forget('branch_create_session');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Branch Has Been Created' }}</p>
                </div>
            @endif



            @if (Session::get('branch_create_limit_cross'))
                <?php
                session()->forget('branch_create_limit_cross');

                ?>
                <div class="alert my-2 alert-danger">
                    <p>{{ 'Branch Limit Has Been Crossed' }}</p>
                </div>
            @endif

            @if (Session::get('branch_updated'))
                <?php
                session()->forget('branch_updated');

                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Branch has been updated' }}</p>
                </div>
            @endif
            @if (Session::get('vendor_branch_deleted'))
                <?php
                session()->forget('vendor_branch_deleted');

                ?>
                <div class="alert my-2 alert-danger">
                    <p>{{ 'Branch has been deleted' }}</p>
                </div>
            @endif


            <div class="card">
                <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                <div class="card-header">
                    <h4 class="card-title">Branch Management</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li>
                                <a href="{{ route('branch.create') }}"><button class="btn create-new-button"><i
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
                                            aria-label="Image: activate to sort column ascending">Branch Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 120px;"
                                            aria-label="Name: activate to sort column ascending">Branch Status</th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 200px;"
                                            aria-label="Employee Group: activate to sort column ascending">Branch URL
                                        </th>

                                        <th style="text-align: center; width: 75px;" class="sorting" tabindex="0"
                                            aria-controls="myTable" rowspan="1" colspan="1"
                                            aria-label="Action: activate to sort column ascending">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($shop as $item)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1" tabindex="0">{{$loop->index + 1}}</td>
                                            <td>{{ $item->branch_name }}</td>
                                            <td>
                                                <label class="switch">
                                                    <input data-id="{{ $item->id }}" type="checkbox"
                                                        class="branch_class" data-on="Active" data-off="Inactive"
                                                        {{ $item->status ? 'checked' : '' }}>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>

                                            <td id="laboratorUrl">
                                                <div class="laboratorUrl2 td-div"> {{ $item->branch_url }} </div>
                                                <input type="hidden" id="copiedURL">
                                                <button class="customClass1222 copyLinkBtn btn cstm-blue-button"
                                                    id="copybtn">Copy Link</button>
                                            </td>

                                            <td>
                                                <center class="for-button-inline">
                                                    <a href="{{ route('branch.edit', $item->id) }}"
                                                        class="btn bstm-color-btnns btn-circle"
                                                        style="background-color: #007bff !important;padding: 6px 10px"
                                                        data-toggle="tooltip" data-original-title="Edit">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="{{ route('branch.destroy_delete', $item->id) }}"
                                                        onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};"
                                                        class="btn btn-danger bstm-color-btnns btn-circle delete-row" data-toggle="tooltip"
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
        $(".copyLinkBtn").click(function(e) {
            var copiedLink = e.target.parentNode.children[0];
            if ($(copiedLink).hasClass('laboratorUrl2')) {
                const url = document.getElementById("copiedURL");
                const btn =e.target.parentNode.children[2];
                $(copiedLink).text()
                console.log($(copiedLink).text());
                url.value = $(copiedLink).text();
                url.type = "text";
                url.select();
                document.execCommand('copy');
                url.type = "hidden";
                btn.innerHTML = "Copied";
                setTimeout(function() {
                    btn.innerHTML = "Copy Link";
                }, 1000);
            } else {
                return;
            }

        });
        $('.confirmation').on('click', function() {
            return confirm('Are you sure?');
        });
        $(document).ready(function() {
            const TOKEN = $("#token").val();
            $('.branch_class').change(function() {
                var status = $(this).prop('checked') === true ? 1 : 0;
                var user_id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": TOKEN
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('branch_change_status') }}",
                    data: {
                        'status': status,
                        'branch_id': user_id
                    },
                    success: function(data) {
                        console.log(data);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

@endsection
