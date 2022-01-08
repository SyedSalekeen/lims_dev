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
                        </ul>
                    </div>
                </div>

                <div class="card-content collpase show">
                    <div class="card-body">

                        <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                        {!! Form::model($get_patient, ['method' => 'PATCH', 'route' => ['patient.update', $get_patient->id], 'enctype' => 'multipart/form-data']) !!}

                        <div class="form form-horizontal">
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> Patient modification</h4>
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
                                        <select class="form-control" id="select1" name="gender">
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
                                        {!! Form::text('contact_number', null, ['placeholder' => 'Contact Number', 'class' => 'form-control','min'=>'0']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Age</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::number('age', null, ['placeholder' => 'Age', 'class' => 'form-control','min'=>'0']) !!}
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
                                        <select class="form-control" name="country" id="selectCountry"
                                            onchange="changeFuncOne();">
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
                                        {!! Form::text('state', null, ['placeholder' => 'State', 'class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">City</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::text('city', null, ['placeholder' => 'City', 'class' => 'form-control']) !!}
                                    </div>
                                </div>


                                {{-- <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">State</label>
                                    <div class="col-md-9 mx-auto">
                                        <select class="form-control" name="state" onchange="changeFuncTwo();"
                                            id="selectState">
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
                                </div> --}}



                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Zip Code</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::text('zip_code', null, ['placeholder' => 'Zip Code', 'class' => 'form-control']) !!}
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
                                        {!! Form::number('home_phone', null, ['placeholder' => 'Home Phone', 'class' => 'form-control','min'=>'0']) !!}
                                    </div>


                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center ">
                                        <button type="submit" class="btn btn-success float-right box-shadow-1 mt-1 mb-1"><i
                                                class="ft-check"></i> Submit</button>
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
            const TOKEN = $("#token").val();

            function changeFunc() {
                $('#select1').empty();
                var selectBox = document.getElementById("selectBox");
                var selectedValueId = selectBox.options[selectBox.selectedIndex].value;
                console.log(selectedValueId);

                $(document).ready(function() {
                    notesTeamData = []
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": TOKEN
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('get_vendor_branch_role') }}",
                        dataType: "json",
                        data: {
                            id: selectedValueId,
                        },
                        success: function(response) {
                            console.log(response);
                            response.data.map((val) => {
                                notesTeamData.push(val)

                            })
                            notesTeamData.map((val) => {
                                console.log(val);
                                $('#select1').append(`<option value="${val.id}">
                                       ${val.role_name}
                                  </option>`);
                            });
                        }
                    });

                });
            }

            var loadFile = function(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById('output');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            };

            function changeFuncOne() {
            $('#selectState').empty();
            var selectBox = document.getElementById("selectCountry");
            var selectedValueId = selectBox.options[selectBox.selectedIndex].value;
            console.log(selectedValueId);
            $(document).ready(function() {
                statesData = []
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": TOKEN
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('get_states') }}",
                    dataType: "json",
                    data: {
                        id: selectedValueId,
                    },
                    success: function(response) {
                        console.log(response);
                        response.data.map((val) => {
                            statesData.push(val)

                        })
                        statesData.map((val) => {
                            console.log(val);
                            $('#selectState').append(`<option value="${val.id}">
                                                                                           ${val.name}
                                                                                      </option>`)
                        });
                    }
                });
            });
        }



        function changeFuncTwo() {
            $('#selectCity').empty();
            var selectBox = document.getElementById("selectState");
            var selectedValueId = selectBox.options[selectBox.selectedIndex].value;
            console.log(selectedValueId);
            $(document).ready(function() {
                countryData = []
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": TOKEN
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('get_country') }}",
                    dataType: "json",
                    data: {
                        id: selectedValueId,
                    },
                    success: function(response) {
                        console.log(response);
                        response.data.map((val) => {
                            countryData.push(val)

                        })
                        countryData.map((val) => {
                            console.log(val);
                            $('#selectCity').append(`<option value="${val.id}">
                                                                                           ${val.name}
                                                                                      </option>`)
                        });
                    }
                });
            });
        }


        </script>
    @endsection
