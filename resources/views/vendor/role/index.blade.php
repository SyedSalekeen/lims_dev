@extends('admin.layouts.master')
@section('content')

    <div class="row">
        <div class="col-12">
            @if ($message = Session::get('success'))
                <div class="alert my-2 alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="card">
                <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                <div class="card-header">
                    <h4 class="card-title">Shop Management</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li>
                                <a href="{{ route('shop.create') }}" id="add_item" class="btn btn-success">
                                    <i class="ft-plus"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">

                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th> Sr #</th>
                                    <th>Role Name</th>
                                    <th>Branch Name</th>
                                    <th>Role Status</th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shop as $value)
                                    <tr role="row">
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->role_name }}</td>
                                        <td>{{ $value->role->branch_name }}</td>

                                        <td><label class="switch">
                                                <input data-id="{{ $value->id }}" type="checkbox" class="branch_class"
                                                    data-on="Active" data-off="Inactive"
                                                    {{ $value->status ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        {{-- <td>{{ $value->branch_url }}</td> --}}
                                        <td class="d-flex border-0">
                                            <a class="btn btn-primary box-shadow-1 btn-sm mr-1"
                                                href="{{ route('branch_role.edit', $value->id) }}"><i
                                                    class="ft-edit"></i></a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['branch_role.destroy', $value->id], 'style' => 'display:inline']) !!}
                                            {!! Form::submit('????', ['class' => 'btn btn-danger btn-sm box-shadow-1', 'onclick' => "return confirm('Are you sure you want to delete?');"]) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $shop->render() !!}
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
    </script>
@endsection
