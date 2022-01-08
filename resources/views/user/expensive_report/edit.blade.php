@extends('user.layouts.master')

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
                        {!! Form::model($get_expensive_reports, ['method' => 'PATCH', 'route' => ['branch_expensive_report.update',$get_expensive_reports->id]]) !!}
                        <div class="form form-horizontal">
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i>Edit Expense Report</h4>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Name</label>
                                    <div class="col-md-9 mx-auto">
                                        <input type="text" class="form-control newinput" value="{{$get_expensive_reports->expensive_name}}" name="expensive_name" required=""
                                            placeholder="Name">
                                    </div>
                                </div>

                                {{-- <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Date</label>
                                    <div class="col-md-9 mx-auto">
                                        <input type="Date" class="form-control newinput" name="expensive_date" required=""
                                            placeholder="Date">
                                    </div>
                                </div> --}}


                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Amount</label>
                                    <div class="col-md-9 mx-auto">
                                        <input type="Number" class="form-control newinput" min="0" value="{{$get_expensive_reports->expensive_amount}}" name="expensive_amount"
                                            required="" placeholder="Amount">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Date</label>
                                    <div class="col-md-9 mx-auto">
                                        <input type="Date" class="form-control newinput" value="{{$get_expensive_reports->expensive_date}}" min="0" name="expensive_date"
                                            required="" placeholder="Date">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Description</label>
                                    <div class="col-md-9 mx-auto">
                                        <input type="text" class="form-control newinput" value="{{$get_expensive_reports->expensive_description}}" name="expensive_description"
                                            required="" placeholder="Description">
                                    </div>
                                </div>


                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn submit-button-color float-right box-shadow-1 mt-1 mb-1"><i
                                            class="ft-check"></i> Submit</button>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <a href="{{ route('branch_expensive_report.index') }}" type="submit"
                                        class="btn back-button-color float-right box-shadow-1 mt-1 mb-1 mr-1"><i
                                            class="ft-arrow-left"></i> back</a>
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
        console.log("hello");

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
