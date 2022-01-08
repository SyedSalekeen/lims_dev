@extends('admin.layouts.master')



@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a class="btn btn-primary" href="{{ route('users.index') }}"> <i
                                        class="ft-arrow-left"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collpase show">
                    <div class="card-body">

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
                        <div class="form form-horizontal">
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> User modification</h4>
                                <hr>
                                {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id], 'enctype' => 'multipart/form-data']) !!}
                                <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Name</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::text('first_name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Name</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::text('last_name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput2">Email</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control', 'disabled']) !!}

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput3">Change Password</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::password('password', ['placeholder' => 'Change Password', 'class' => 'form-control']) !!}

                                    </div>
                                </div>

                                {{-- <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Confirm Password</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}

                                    </div>
                                </div> --}}

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
                                        <select class="form-control" name="country" id="selectCountry"
                                            onchange="changeFuncOne();">
                                            <option selected disabled>Select Country</option>
                                            @foreach ($get_country as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $user->country ? 'selected' : '' }}>
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
                                                <option value="{{$item->id}}"
                                                    {{ $item->id == $user->state ? 'selected' : '' }}>
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
                                                <option value="{{$item->id}}"
                                                    {{ $item->id == $user->city ? 'selected' : '' }}>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Branch Limit</label>
                                    <div class="col-md-9 mx-auto">
                                        {!! Form::number('branch_limit', null, ['placeholder' => 'State', 'class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Labortary Name</label>
                                    <div class="col-md-9 mx-auto">
                                        <input type="text" class="form-control newinput" onload="convertToSlug(this.value)"
                                            name="labortary" onkeyup="convertToSlug(this.value)" required=""
                                            placeholder="Laboratory Name" value="{{ $user->laboratory_name }}">
                                        <input class="newinput" type="text" hidden placeho lder=""
                                            value="{{ $user->laboratory_slug }}" name="labortary_name" id="inputslug">
                                        <input type="hidden" name="laboratory_url" value="<?php echo config('app.url'); ?>">
                                    </div>
                                </div>

                                <div class="proFileImgSec d-flex gap-4">
                                    <div class="profileImg">
                                        <img id="output" src="{{ asset('uploads/logo/' . $user->laboratory_logo) }}"
                                            alt="" width="100%" height="100%" />

                                        <img src="" style="background:white;">
                                    </div>
                                    <div class="btns d-flex gap-3 uploadDelBtns">
                                        <label for="uploadInp" class="csLabel">
                                            Update Laboratory Logo
                                            <input type="file" name="update_laboratory_logo" id="uploadInp" hidden
                                                onchange="loadFile(event)">
                                            @error('upload')
                                                <p class="help-block" style="color: red">{{ $errors->first('upload') }}
                                                </p>
                                            @enderror
                                        </label>
                                    </div>
                                </div>


                                <div class="col-xs-12 col-sm-12 col-md-12 text-center ">
                                    <button type="submit" class="btn btn-success float-right box-shadow-1 mt-1 mb-1"><i
                                            class="ft-check"></i> Submit</button>
                                </div>

                            </div>
                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('scripts')
    <script>
        const TOKEN = $("#token").val();
        @if (Session::get('success'))
            swal({
            title: "User modified",
            text: "User modified Successfully",
            icon: "success",
            });
        @endif

        function convertToSlug(str) {

            //replace all special characters | symbols with a space
            str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ').toLowerCase();

        // trim spaces at start and end of string
        str = str.replace(/^\s+|\s+$/gm, '');

        // replace space with dash/hyphen
        str = str.replace(/\s+/g, '-');
        // document.getElementById("slug-text").innerHTML= str;
        document.getElementById("inputslug").value = str;
        //return str;
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
                        $('#selectCity').append(`<option value="${val.id}" {{ $item->id == $user->city ? 'selected' : '' }}>
                                                                                           ${val.name}
                                                                                      </option>`)
                        });
                    }
                });
            });
        }
    </script>
@endsection
