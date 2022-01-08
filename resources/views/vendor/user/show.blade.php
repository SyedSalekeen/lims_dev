@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">

            @if (count($errors) > 0)
                <div class="alert round alert-danger">
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
                            <li><a class="btn btn-primary" href="{{ route('vendor_user.index') }}"> <i
                                        class="ft-arrow-left"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collpase show">
                    <div class="card-body">
                        <div class="form form-horizontal">
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> User</h4>
                                <hr>
                                {!! Form::model($user_show, ['method' => 'PATCH', 'route' => ['vendor_user.update', $user_show->id], 'enctype' => 'multipart/form-data']) !!}
                                <div class="form form-horizontal">
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput1">First Name</label>
                                            <div class="col-md-9 mx-auto">
                                                {!! Form::text('first_name', null, ['placeholder' => 'First Name', 'class' => 'form-control', 'disabled']) !!}

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput2">Last Name</label>
                                            <div class="col-md-9 mx-auto">
                                                {!! Form::text('last_name', null, ['placeholder' => 'Last Name', 'class' => 'form-control', 'disabled']) !!}

                                            </div>
                                        </div>
                                        {{-- <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput3">Email</label>
                                            <div class="col-md-9 mx-auto">
                                                {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}

                                            </div>
                                        </div> --}}



                                        {{-- <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput3">Password</label>
                                            <div class="col-md-9 mx-auto">
                                                {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control', 'disabled']) !!}
                                            </div>
                                        </div> --}}
                                        {{-- <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput4">Confirm Password</label>
                                            <div class="col-md-9 mx-auto">
                                                {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
                                            </div>
                                        </div> --}}

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput4">Contact Number</label>
                                            <div class="col-md-9 mx-auto">
                                                {!! Form::text('contact_number', null, ['placeholder' => 'Contact Number', 'class' => 'form-control', 'disabled']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput4">Address</label>
                                            <div class="col-md-9 mx-auto">
                                                {!! Form::text('address', null, ['placeholder' => 'Address', 'class' => 'form-control', 'disabled']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput4">Country</label>
                                            <div class="col-md-9 mx-auto">
                                                {!! Form::text('country', $get_country->name, ['placeholder' => 'Country', 'class' => 'form-control', 'disabled']) !!}
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput4">State</label>
                                            <div class="col-md-9 mx-auto">
                                                {!! Form::text('state',null, ['placeholder' => 'State', 'class' => 'form-control', 'disabled']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput4">City</label>
                                            <div class="col-md-9 mx-auto">
                                                {!! Form::text('city',null, ['placeholder' => 'City', 'class' => 'form-control', 'disabled']) !!}
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput4">Branch</label>
                                            <div class="col-md-9 mx-auto">
                                                <select class="form-control" name="branch" disabled> {{-- id="selectBox" onchange="changeFunc();" --}}
                                                    <option selected disabled>Select Branch</option>
                                                    @foreach ($get_vendor_branch as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $item->id == $user_show->branch_id ? 'selected' : '' }}>
                                                            {{ $item->branch_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        {{-- <h1>{{$user_show->role_id}}</h1> --}}
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput4">Role</label>
                                            <div class="col-md-9 mx-auto">
                                                <select class="form-control" id="select1" name="role" disabled>
                                                    <option selected disabled>Select Role</option>
                                                    @foreach ($get_vendor_branch_role as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $item->id == $user_show->role_id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                            <a href="{{ route('vendor_user.index') }}" type="submit"
                                                class="btn btn-primary float-right box-shadow-1 mt-1 mb-1 mr-1"><i
                                                    class="ft-arrow-left"></i> back</a>
                                        </div>
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
    </div>
    <script>
        @if (Session::get('success'))
            swal({
            title: "User modified",
            text: "User modified Successfully",
            icon: "success",
            });
        @endif
    </script>
@endsection
