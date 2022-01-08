@extends('admin.layouts.master')




@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li> <a class="btn btn-primary" href="{{ route('roles.index') }}"> <i
                                        class="ft-arrow-left"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collpase show">

                    <div class="card-body">
                        {!! Form::model($permission, ['method' => 'PATCH', 'route' => ['role_permission.update',$editId]]) !!}

                        <div class="form form-horizontal">
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> Permission Edit</h4>



                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1"> Permissions</label>
                                    <div class="col-md-9 mx-auto">

                                        @foreach ($permission as $value)
                                            <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name']) }}
                                                {{ $value->name }}</label>
                                            <br />
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-success box-shadow-1 float-right mt-1 mb-1"><i
                                            class="ft-check"></i> Submit</button>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <a href="{{ route('role_permission.index') }}" type="submit"
                                        class="btn btn-primary box-shadow-1 float-right mt-1 mb-1 mr-1">
                                        <i class="ft-arrow-left"></i> back</a>
                                </div>

                            </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
