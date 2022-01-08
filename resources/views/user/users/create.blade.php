@extends('user.layouts.master')

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
                        {!! Form::open(['route' => 'branch_user.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                        <div class="form form-horizontal">
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> Create New Users</h4>


                                <div class="proFileImgSec d-flex gap-4">
                                    <div class="profileImg">
                                        <img id="output" src="{{ asset('uploads/avator.jpg') }}" alt="" width="100%"
                                            height="100%" />

                                        <img src="" style="background:white;">
                                    </div>
                                    <div class="btns d-flex gap-3 uploadDelBtns">
                                        <label for="uploadInp" class="csLabel back-button-color">
                                            Update Profile Picture
                                            <input type="file" name="profile_image" id="uploadInp" hidden
                                                onchange="loadFile(event)">
                                            @error('upload')
                                                <p class="help-block" style="color: red">{{ $errors->first('upload') }}
                                                </p>
                                            @enderror
                                        </label>
                                    </div>
                                </div>



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
                                    <label class="col-md-3 label-control" for="projectinput3">Email</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}

                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput3">Password</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Confirm Password</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Contact Number</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::text('contact_number', null, ['placeholder' => 'Contact Number', 'class' => 'form-control', 'min' => '0']) !!}
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
                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                {{-- <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">State</label>
                                    <div class="col-md-9 mx-auto">
                                        <select class="form-control" name="state" onchange="changeFuncTwo();"
                                            id="selectState">

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">City</label>
                                    <div class="col-md-9 mx-auto">
                                        <select class="form-control" name="city" id="selectCity">

                                        </select>
                                    </div>
                                </div> --}}

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
                                    <label class="col-md-3 label-control" for="projectinput4">Branch</label>
                                    <div class="col-md-9 mx-auto">
                                        <select class="form-control"
                                             name="branch">
                                            <option selected disabled>Select Branch</option>
                                            @foreach ($get_vendor_branch as $item)
                                                <option value="{{ $item->id }}">{{ $item->branch_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Role</label>
                                    <div class="col-md-9 mx-auto">
                                        <select class="form-control" id="select1" name="role">
                                            <option selected disabled>Select Role</option>
                                            @foreach ($get_vendor_branch_role as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-12 for-align-btns">
                                       <button type="submit" class="btn btn-success box-shadow-1 mt-1 mb-1"><i
                                               class="ft-check"></i> Submit</button>
                                               <a href="{{ route('users.index') }}" type="submit"
                                           class="btn btn-primary box-shadow-1 mt-1 mb-1 mr-1"><i
                                               class="ft-arrow-left"></i> back</a>
                                    </div>

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
            console.log("here");
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
