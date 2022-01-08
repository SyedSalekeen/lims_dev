@extends('patient.layouts.master')

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
                        </ul>
                    </div>
                </div>

                <div class="card-content collpase show">
                    <div class="card-body">

                        <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                        {!! Form::model($get_patient,['route' => 'patient.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                        <div class="form form-horizontal">
                            <div class="form-body">

                                <h1 class="mb-3">Patient Information</h1>
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
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Gender</label>
                                    <div class="col-md-9 mx-auto">
                                        <select class="form-control" id="select1" name="sex" disabled>
                                            <option selected disabled>Gender</option>

                                            <option value="male" <?php
                                                                if( @$get_patient->sex == "male")
                                                                echo "selected"

                                                ?>>Male</option>
                                            <option value="female" <?php if(@$get_patient->sex == "female")
                                                echo "selected"
                                                ?>>Female</option>
                                            <option value="other" <?php if(@$get_patient->sex == "other")
                                                echo "selected"
                                                ?>>Others</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Martial status</label>
                                    <div class="col-md-9 mx-auto">
                                        <select class="form-control" id="select1" name="martial_status" disabled>
                                            <option selected disabled>Select martial status</option>
                                            <option value="single" <?php if(@$get_patient->martial_status == "single")
                                            echo "selected"
                                            ?>>Single</option>
                                            <option value="married" <?php if(@$get_patient->martial_status == "married")
                                                echo "selected"
                                                ?>>Married</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput3">Username</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::text('username', null, ['placeholder' => 'username', 'class' => 'form-control', 'disabled']) !!}

                                    </div>
                                </div>


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
                                        {!! Form::text('country', null, ['placeholder' => 'Country', 'class' => 'form-control', 'disabled']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">City</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::text('city', null, ['placeholder' => 'City', 'class' => 'form-control', 'disabled']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">State</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::text('state', null, ['placeholder' => 'State', 'class' => 'form-control', 'disabled']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Zip Code</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::number('address', null, ['placeholder' => 'Zip Code', 'class' => 'form-control', 'disabled']) !!}
                                    </div>
                                </div>


                                <h1 class="mb-3">Emergency Contact</h1>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Name</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::text('emergency_name', null, ['placeholder' => 'Name', 'class' => 'form-control', 'disabled']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Relationship</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::text('relationship', null, ['placeholder' => 'Relationship', 'class' => 'form-control' , 'disabled']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Home Phone</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::number('home_phone', null, ['placeholder' => 'Home Phone', 'class' => 'form-control', 'disabled']) !!}
                                    </div>


                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        <a href="{{ route('patient_report.index') }}" type="submit"
                                            class="btn back-button-color float-right box-shadow-1 mt-1 mb-1 mr-1"><i
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
    @endsection

