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
                        {!! Form::open(['route' => 'additional_report.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form form-horizontal">
                            <div class="form-body">
                                <h4 class="form-section"><i class="fas fa-file-chart-pie"></i> Add Report</h4>



                                <div class="form-group row">
                                    <label class="col-md-3 label-control mt-2" for="projectinput1">Serach Patient</label>
                                    <div class="col-md-9 mx-auto">
                                        <div class="date-time mt1">
                                            {{-- <label>Search a customer by name or mobile</label> --}}

                                            <select id="mySelect2" class=" form-control select2 select2-hidden-accessible"
                                                name="patient_id" style="width: 100%;" tabindex="-1"
                                                aria-hidden="true">
                                                {{-- <option selected disabled>Select Patient</option> --}}
                                                @foreach ($getPatients as $item)
                                                    <option value="{{ $item->id }}"
                                                        data-id="{{ $item->fullname }},{{ $item->patient_email }}"
                                                        title="{{ $item->fullname }},{{ $item->email }}">
                                                        {{ $item->fullname }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Select Test Category</label>
                                    <div class="col-md-9 mx-auto">
                                        <select class="form-control" name="test_category"> {{-- id="selectBox" onchange="changeFunc();" --}}
                                            <option selected disabled>Select Test Category</option>
                                            @foreach ($getTestCategory as $item)
                                                <option value="{{ $item->id }}">{{ $item->lab_test_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Select Branch</label>
                                    <div class="col-md-9 mx-auto">
                                        <select class="form-control" name="branch_id"> {{-- id="selectBox" onchange="changeFunc();" --}}
                                            <option selected disabled>Select Branch</option>
                                            @foreach ($getBranch as $item)
                                                <option value="{{ $item->id }}">{{ $item->branch_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>





                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Add Report</label>
                                    <div class="col-md-9 mx-auto">
                                        <input type="file" class="" min="0" name="test_report" required=""
                                            placeholder="Amount">
                                    </div>
                                </div>


                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-success float-right box-shadow-1 mt-1 mb-1"><i
                                            class="ft-check"></i> Submit</button>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <a href="{{ route('additional_report.index') }}" type="submit"
                                        class="btn btn-primary float-right box-shadow-1 mt-1 mb-1 mr-1"><i
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
        $(document).ready(function() {
            function formatState(state) {
                console.log(state)
                if (!state.id) {
                    return state.text;
                }
                var $state = $(
                    `<span><div class="row"><div class="col-md-12"><h6>${state?.title?.split(",")[0]}</h6></div><div class="col-md-6">MR: ${state.title.split(",")[1]}</div></div></span>`
                );
                return $state;
            };
            $('.select2').select2({
                closeOnSelect: false,
                templateResult: formatState
            });

        });
    </script>
@endsection
