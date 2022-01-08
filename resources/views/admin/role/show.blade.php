@extends('admin.layouts.master')




@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Permissions</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>

                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Permission</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">{{ $role->name }}</th>
                                    <td>
                                        @if (!empty($rolePermissions))
                                            @foreach ($rolePermissions as $v)
                                                <label class="badge badge-success">{{ $v->name }},</label>
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a href="{{ route('roles.index') }}" type="submit"
                                class="btn btn-primary float-right box-shadow-1 mt-1 mb-1 mr-1"><i
                                    class="ft-arrow-left"></i> back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
