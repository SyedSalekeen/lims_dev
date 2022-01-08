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
                            <li><a class="btn btn-primary" href="{{ route('test_gig.index') }}"> <i
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
                                <h4 class="form-section"><i class="ft-user"></i> Test Modification</h4>
                                <hr>
                                {!! Form::model($get_edit_gig, ['method' => 'PATCH', 'route' => ['test_gig.update', $get_edit_gig->id]]) !!}
                                <div class="form form-horizontal">
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput4">Branch</label>
                                            <div class="col-md-9 mx-auto">
                                                <select class="form-select cstm-slect" name="branch"
                                                    aria-label="Default select example">
                                                    <option selected disabled>Select Branch</option>
                                                    @foreach ($get_vendor_branch as $item)
                                                        <option value="{{ $item->id }}" <?php if($get_edit_gig->branch_id == $item->id)
                                                            echo "selected";
                                                            ?>>{{ $item->branch_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput4">Select Test</label>
                                            <div class="col-md-9 mx-auto">
                                                <select class="form-select cstm-slect" name="lab_test" required=""
                                                    aria-label="Default select example">
                                                    <option selected disabled>Select Test</option>
                                                    @foreach ($get_lab_test_name as $item)
                                                        <option value="{{ $item->id }}" <?php if($get_edit_gig->lab_test == $item->id)
                                                            echo "selected";
                                                            ?>>{{ $item->lab_test_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput1">Test Name</label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="text" class="form-control newinput"
                                                    name="test_name" value="{{$get_edit_gig->test_name}}" required=""
                                                    placeholder="Name">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput1">Best Range</label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="Number" class="form-control newinput" name="test_best_range" value="{{$get_edit_gig->test_best_range}}" required=""
                                                    placeholder="Best Range">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput1">Unit</label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="text" class="form-control newinput" name="test_unit" value="{{$get_edit_gig->test_unit}}" required=""
                                                    placeholder="Unit">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput1">Test Amount</label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="Number" class="form-control newinput"
                                                    name="test_amount" min="0" value="{{$get_edit_gig->test_amount}}" required=""
                                                    placeholder="Amount">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 text-center ">
                                            <button type="submit"
                                                class="btn btn-success float-right box-shadow-1 mt-1 mb-1"><i
                                                    class="ft-check"></i> Update</button>
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
                    document.getElementById("branchSlug").value = str;
                    //return str;
                }
            </script>
        @endsection
