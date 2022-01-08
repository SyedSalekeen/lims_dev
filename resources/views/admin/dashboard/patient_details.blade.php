@extends('admin.layouts.master')

@section('content')


    <div class="card card-widget widget-user-2">
        @if (count($errors) > 0)
            <div class="alert round alert-primary">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>

    <div class="row">
        <div class="col-md-12">

                <div class="card-content collpase show">
                    <div class="card-body">

                        {!! Form::model($getPatients, ['route' => 'patient.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

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
                                    <label class="col-md-3 label-control" for="projectinput4">Select Sex</label>
                                    <div class="col-md-9 mx-auto">
                                        <select class="form-control" id="select1" name="sex" disabled>
                                            <option selected disabled>Select Sex</option>

                                            <option value="male" <?php
if (@$get_patient->sex == 'male') {
    echo 'selected';
}

?>>Male</option>
                                            <option value="female" <?php if (@$getPatients->sex == 'female') {
    echo 'selected';
}
?>>Female</option>
                                            <option value="other" <?php if (@$getPatients->sex == 'other') {
    echo 'selected';
}
?>>Others</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Marital status</label>
                                    <div class="col-md-9 mx-auto">
                                        <select class="form-control" id="select1" name="martial_status" disabled>
                                            <option selected disabled>Select marital status</option>
                                            <option value="single" <?php if (@$getPatients->martial_status == 'single') {
    echo 'selected';
}
?>>Single</option>
                                            <option value="married" <?php if (@$getPatients->martial_status == 'married') {
    echo 'selected';
}
?>>Married</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput3">Email</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::email('patient_email', null, ['placeholder' => 'Email', 'class' => 'form-control', 'disabled']) !!}

                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Contact Number</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::text('contact_number', null, ['placeholder' => 'Contact Number', 'class' => 'form-control', 'disabled']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Age</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::number('age', null, ['placeholder' => 'Age', 'class' => 'form-control','min'=>'0', 'disabled']) !!}
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
                                        <input class="form-control" type="text" value="{{$get_country->name}}" readonly>

                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">State</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::text('state', null, ['placeholder' => 'State', 'class' => 'form-control', 'disabled']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">City</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::text('city', null, ['placeholder' => 'City', 'class' => 'form-control', 'disabled']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Zip Code</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::number('zip_code', null, ['placeholder' => 'Zip Code', 'class' => 'form-control', 'disabled']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Branch</label>
                                    <div class="col-md-9 mx-auto">
                                        <select class="form-control" name="branch" disabled>
                                            <option selected disabled>Select Branch</option>
                                            @foreach ($getVendorBranch as $item)
                                                <option value="{{ $item->id }}" <?php if ($getPatients->branch_id == $item->id) {
    echo 'selected';
}
?>>
                                                    {{ $item->branch_name }}
                                                </option>
                                            @endforeach
                                        </select>
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
                                        {!! Form::text('relationship', null, ['placeholder' => 'Relationship', 'class' => 'form-control', 'disabled']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Home Phone</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::number('home_phone', null, ['placeholder' => 'Home Phone', 'class' => 'form-control', 'disabled']) !!}
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


    @section('scripts')
        <script type="text/javascript">
            var loadFile = function(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById('output');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            };
        </script>
    @endsection
