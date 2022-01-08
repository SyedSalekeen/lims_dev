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
                    <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
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

                        {!! Form::open(['route' => 'patient_invoice.store', 'method' => 'POST']) !!}
                        <div class="form form-horizontal">
                            <div class="form-body">
                                <h4 class="form-section"> Create Report</h4>

                                {{-- <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Branch ID</label>
                                    <div class="col-md-9 mx-auto">
                                        <input type="text" readonly class="form-control newinput"
                                            id="test_amount" name="branch_id" required="" placeholder="Branch Name" value="{{ $invoice->branch_id }}">
                                    </div>
                                </div> --}}

                                <input type="hidden" name="invoice_id" value="{{ $invoice_id }}">
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Patient MR Number</label>
                                    <div class="col-md-9 mx-auto">
                                        <input type="Number" readonly class="form-control newinput" id="test_amount"
                                            value="{{ $invoice->patient_mr_no }}" name="patient_id" required=""
                                            placeholder="Patient MR Number">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Branch Name</label>
                                    <div class="col-md-9 mx-auto">
                                        <input type="text" readonly class="form-control newinput" id="test_amount"
                                            name="branch_name" required="" value="{{ $branch_name->branch_name }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput1">Patient Name</label>
                                    <div class="col-md-9 mx-auto">
                                        <input type="text" readonly class="form-control newinput"
                                            value="{{ $patient_name->first_name . ' ' . $patient_name->last_name }}"
                                            name="patient_name" required="" placeholder="Patient Name">
                                    </div>
                                </div>
                                @foreach ($get_gigs as $get_gigs)
                                <input type="hidden" readonly class="form-control newinput" id=""
                                name="lab_test_ids[]"  value="{{ $get_gigs->lab_test }}">
                                
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput1">Test Name</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="text" readonly class="form-control newinput" id="test_amount"
                                                name="test_name[]" required="" value="{{ $get_gigs->test_name }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput1">Test Best Range</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="text" readonly class="form-control newinput" id="test_amount"
                                                name="test_best_range[]" required="" placeholder="Test Best Range"
                                                value="{{ $get_gigs->test_best_range }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput1">Test Unit</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="text" readonly class="form-control newinput" id="test_amount"
                                                name="test_unit[]" required="" placeholder="Test Best Range"
                                                value="{{ $get_gigs->test_unit }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput1">Test Result</label>
                                        <div class="col-md-9 mx-auto">
                                            <input type="text" class="form-control newinput" id="test_amount"
                                                name="test_result[]" required=""  placeholder="Test Result" value="">
                                        </div>
                                    </div>
                                @endforeach



                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-success float-right box-shadow-1 mt-1 mb-1"><i
                                            class="ft-check"></i>Create Report</button>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <a href="{{ route('patient_invoice.index') }}" type="submit"
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

    </script>
@endsection
