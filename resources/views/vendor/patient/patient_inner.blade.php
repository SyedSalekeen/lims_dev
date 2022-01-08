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
        <div class="widget-user-header">
            <div class="row">
                <div class="col-md-2">
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2"
                            src="https://appointments.lightbulbsolution.com/public/img/default-avatar-user.png"
                            height="60em" width="60em" alt="User Avatar">
                    </div>
                </div>
                <div class="col-md-10 text-white">
                    <h3 class="widget-user-username">{{ $get_patient->fullname }}
                        <a href="javascript:void(0)" class="btn btn-outline-light delete-row">Delete</a>
                    </h3>
                    <div>
                        <p><i class="fa fa-envelope"></i>: {{ $get_patient->patient_email }}</p>
                        <p><i class="fa fa-phone-alt"></i>: {{ $get_patient->contact_number }}</p>
                    </div>

                </div>
            </div>
        </div>

        <div class="card-footer row">

            <div class="col-md-10 offset-md-2">
                <div class="row">

                    <div class="col-md-12">
                        <h4> <strong> Booking Stats </strong></h4>
                    </div>
                    <div class="col-md-12">
                        <div class="row" id="customer-stats">
                            <div class="col-md-2 text-center mt-3 border-right">
                                <h6 class="text-uppercase"> <strong> Inovices </strong></h6>
                                <p>0</p>
                            </div>

                            <div class="col-md-2 text-center mt-3 border-right">
                                <h6 class="text-uppercase"> <strong> Reports </strong></h6>
                                <p>0</p>
                            </div>



                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <div class="card-content collpase show">
        <div class="card-body">

            <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
            {!! Form::model($get_patient, ['method' => 'PATCH', 'route' => ['patient.update', $get_patient->id], 'enctype' => 'multipart/form-data']) !!}

            <div class="form form-horizontal">
                <div class="form-body">
                    <h1 class="mb-3">Patient Information</h1>
                    <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput1">First Name</label>
                        <div class="col-md-9 mx-auto">
                            {!! Form::text('first_name', null, ['placeholder' => 'First Name', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput2">Last Name</label>
                        <div class="col-md-9 mx-auto">
                            {!! Form::text('last_name', null, ['placeholder' => 'Last Name', 'class' => 'form-control']) !!}

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput4">Select Gender</label>
                        <div class="col-md-9 mx-auto">
                            <select class="form-control" id="select1" name="sex">
                                <option selected disabled>Select Gender</option>

                                <option value="male" <?php if ($get_patient->sex == 'male') {
    echo 'selected';
}
?>>Male</option>
                                <option value="female" <?php if ($get_patient->sex == 'female') {
    echo 'selected';
}
?>>Female</option>
                                <option value="other" <?php if ($get_patient->sex == 'other') {
    echo 'selected';
}
?>>Others</option>

                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput4">Marital status</label>
                        <div class="col-md-9 mx-auto">
                            <select class="form-control" id="select1" name="martial_status">
                                <option selected disabled>Select marital status</option>
                                <option value="single" <?php if ($get_patient->martial_status == 'single') {
    echo 'selected';
}
?>>Single</option>
                                <option value="married" <?php if ($get_patient->martial_status == 'married') {
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
                        <label class="col-md-3 label-control" for="projectinput3">Change Password</label>
                        <div class="col-md-9 mx-auto">
                            {!! Form::password('password', ['placeholder' => 'Change Password', 'class' => 'form-control']) !!}

                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput4">Contact Number</label>
                        <div class="col-md-9 mx-auto">
                            {!! Form::text('contact_number', null, ['placeholder' => 'Contact Number', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput4">Address</label>
                        <div class="col-md-9 mx-auto">
                            {!! Form::text('address', null, ['placeholder' => 'Address', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput4">Country</label>
                        <div class="col-md-9 mx-auto">
                            <select class="form-control" name="country" id="selectCountry" onchange="changeFuncOne();">
                                <option selected disabled>Select Country</option>
                                @foreach ($get_country as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $get_patient->country ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput4">State</label>
                        <div class="col-md-9 mx-auto">
                            <select class="form-control" name="state" onchange="changeFuncTwo();" id="selectState">
                                @foreach ($get_state as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $get_patient->state ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput4">City</label>
                        <div class="col-md-9 mx-auto">
                            <select class="form-control" name="city" id="selectCity">
                                @foreach ($get_city as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $get_patient->city ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>



                    <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput4">Zip Code</label>
                        <div class="col-md-9 mx-auto">
                            {!! Form::number('address', null, ['placeholder' => 'Zip Code', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput4">Branch</label>
                        <div class="col-md-9 mx-auto">
                            <select class="form-control" name="branch">
                                <option selected disabled>Select Branch</option>
                                @foreach ($get_vendor_branch as $item)
                                    <option value="{{ $item->id }}" <?php if ($get_patient->branch_id == $item->id) {
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
                            {!! Form::text('emergency_name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput1">Relationship</label>
                        <div class="col-md-9 mx-auto">
                            {!! Form::text('relationship', null, ['placeholder' => 'Relationship', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 label-control" for="projectinput1">Home Phone</label>
                        <div class="col-md-9 mx-auto">
                            {!! Form::number('home_phone', null, ['placeholder' => 'Home Phone', 'class' => 'form-control']) !!}
                        </div>


                        <div class="col-xs-12 col-sm-12 col-md-12 text-center ">
                            <button type="submit" class="btn back-button-color float-right box-shadow-1 mt-1 mb-1"><i
                                    class="ft-check"></i>Update</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>






@endsection
@section('scripts')
    <script>
        console.log("here")
        $(document).ready(function() {
            $('#table_id').DataTable();
        });
    </script>
@endsection
