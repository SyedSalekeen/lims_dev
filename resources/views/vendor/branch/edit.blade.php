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
                            <li><a class="btn btn-primary" href="{{ route('branch.index') }}"> <i
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
                                <h4 class="form-section"><i class="ft-user"></i> Branch modification</h4>
                                <hr>
                                {!! Form::model($branch, ['method' => 'PATCH', 'route' => ['branch.update', $branch->id]]) !!}
                                <div class="form form-horizontal">
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput1">Branch Name</label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="text" class="form-control newinput"
                                                    value="{{ $branch->branch_name }}" onload="convertToSlug(this.value)"
                                                    name="branch" onkeyup="convertToSlug(this.value)" required=""
                                                    placeholder="Branch Name">
                                                <input class="newinput" hidden type="text" placeholder="" name="branch_name"
                                                    id="branchSlug" required="">
                                                <input type="" hidden name="branch_url" value="<?php echo config('app.url'); ?>">

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
