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
                        </ul>
                    </div>
                </div>
                <div class="card-content collpase show">
                    <div class="card-body">
                        <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                        {!! Form::open(['route' => 'role_permission.store', 'method' => 'POST']) !!}

                        <div class="form form-horizontal">
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> Permission Creation</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Branch</label>
                                    <div class="col-md-9 mx-auto">
                                        <select class="form-select cstm-slect" name="branch"
                                            aria-label="Default select example" id="selectBox" onchange="changeFunc();">
                                            <option selected disabled>Select Branch</option>
                                            @foreach ($get_vendor_branch as $item)
                                                <option value="{{ $item->id }}">{{ $item->branch_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Role</label>
                                    <div class="col-md-9 mx-auto">
                                        <select class="form-select cstm-slect" id="select1" name="role"
                                            aria-label="Default select example">

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1"> Permissions</label>
                                    <div class="col-md-9 mx-auto">
                                        @foreach ($permission as $value)
                                            <label>
                                                <input type="checkbox"  name="permission_check_box[]" value="{{$value->id}}">
                                                {{-- {{ Form::checkbox('permission[]', $value->id, false, ['class' => 'name']) }}
                                                {{ $value->name }} --}}{{$value->name}}</label>
                                            <br>

                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-success box-shadow-1 float-right mt-1 mb-1"><i
                                            class="ft-check"></i> Submit</button>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <a href="{{ route('roles.index') }}" type="submit"
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
</script>
@endsection
