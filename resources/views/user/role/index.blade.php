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
                <div class="card-header">
                    <h4 class="card-title">Roles</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li> @can('role-create')
                                    <a class="btn btn-success" href="{{ route('roles.create') }}"><i
                                            class="ft-plus"></i></a>
                                @endcan
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Role Name</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $key => $role)
                                    <tr class="text-center">
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <a class="btn btn-info btn-sm box-shadow-1"
                                                href="{{ route('roles.show', $role->id) }}">
                                                <i class="ft-eye"></i></a>
                                            @can('role-edit')
                                                <a class="btn btn-primary btn-sm box-shadow-1"
                                                    href="{{ route('roles.edit', $role->id) }}">
                                                    <i class="ft-edit"></i>
                                                </a>
                                            @endcan
                                            @can('role-delete')
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                                                {!! Form::submit('🗑', ['class' => 'btn btn-danger btn-sm box-shadow-1']) !!}
                                                {!! Form::close() !!}
                                            @endcan
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
@endsection
