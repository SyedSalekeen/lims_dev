@extends('admin.layouts.master')
@section('content')

    <div class="row">
        <div class="col-12">
            @if ($message = Session::get('success'))
                <div class="alert my-2 alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            @if (Session::get('vendor_user_created'))
                <?php
                session()->forget('vendor_user_created');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'User has been created' }}</p>
                </div>
            @endif

            @if (Session::get('vendor_user_updated'))
                <?php
                session()->forget('vendor_user_updated');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'User has been updated' }}</p>
                </div>
            @endif


            @if (Session::get('vendor_user_deleted'))
                <?php
                session()->forget('vendor_user_deleted');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'User has been deleted' }}</p>
                </div>
            @endif
            @if (Session::get('vendor_user_already_exist'))
                <?php
                session()->forget('vendor_user_already_exist');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'User already exist' }}</p>
                </div>
            @endif





            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">User Management</h4>
                    <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li>
                                <a href="{{ route('vendor_user.create') }}"><button class="btn create-new-button"><i
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
                                        <th class="sorting_asc" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 35.15px;" aria-sort="ascending"
                                            aria-label="#: activate to sort column descending">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 89.15px;"
                                            aria-label="Image: activate to sort column ascending">Image
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 125.15px;"
                                            aria-label="Name: activate to sort column ascending">Name
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 181.15px;"
                                            aria-label="Employee Group: activate to sort column ascending">Email
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 275.15px;"
                                            aria-label="Service: activate to sort column ascending">
                                            URL</th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 76.15px;"
                                            aria-label="Role: activate to sort column ascending">Status
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
                                            <td id="laboratorUrl">
                                                <div class="laboratorUrl2 td-div"> {{ $item->branch->branch_url  }} </div>
                                                <input type="hidden" id="copiedURL">
                                                <button class="customClass1222 copyLinkBtn btn cstm-blue-button"
                                                    id="copybtn">Copy Link</button>
                                            </td>
                                            {{-- <td>
                                                {{ $item->branch->branch_url }}
                                            </td> --}}
                                            <td>
                                                <label class="switch">
                                                    <input data-id="{{ $item->id }}" type="checkbox"
                                                        class="toggle_class" data-on="Active" data-off="Inactive"
                                                        {{ $item->status ? 'checked' : '' }}>
                                                    <span class="slider round"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <center class="for-button-inline">
                                                    <a href="{{ route('vendor_user.show', $item->id) }}"
                                                        class="btn back-button-color btn-circle"
                                                        style="background-color: #007bff !important;color:#fff;"
                                                        data-toggle="tooltip" data-original-title="Edit">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="{{ route('vendor_user.edit', $item->id) }}"
                                                        class="btn back-button-color btn-circle"
                                                        style="background-color: #007bff !important;color:#fff;"
                                                        data-toggle="tooltip" data-original-title="Edit">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </a>
                                                    <a href="{{ route('vendor_user.destroy_delete', $item->id) }}"
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

$(".copyLinkBtn").click(function(e){
            var copiedLink = e.target.parentNode.children[0];
            if($(copiedLink).hasClass('laboratorUrl2')){
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
            }
            else{
                return;
            }

        });




        $(document).ready(function() {
            $('#myTable').DataTable();
        });
        $(document).ready(function() {
            const TOKEN = $("#token").val();
            $('.toggle_class').change(function() {
                console.log("here");
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
                    url: "{{ route('vendor_change_status') }}",
                    data: {
                        'status': status,
                        'user_id': user_id
                    },
                    success: function(data) {
                        console.log(data);
                    }
                });
            });
        });
    </script>
@endsection
