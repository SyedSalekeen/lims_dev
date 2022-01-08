


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
                            <li><a class="btn btn-primary" href="{{ route('patient_invoice.index') }}"> <i
                                        class="ft-arrow-left"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class=" invoice-head">
                    <div class="row invoice-header-marging">
                        <div class="col-lg-6">
                            <div class="">
                                <div>
                                    @if ($get_logo->laboratory_logo)
                                        <img src="{{ asset('uploads/logo/' . $get_logo->laboratory_logo) }}" width="100px"
                                            height="100px">
                                    @else
                                        <h3 class="brand-text">{{ $get_logo->laboratory_name }}</h3>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-6"><label>Invoice Number:</label></div>
                                <div class="col-lg-6"><span>#{{ $invoice->id }}</span></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6"><label>Report Issue Date:</label></div>
                                <div class="col-lg-6"><span>{{ $invoice->report_issue_date }}</span></div>
                            </div>
                        </div>
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
                        <div class="form form-horizontal">
                            <div class="form-body">

                                <div class="Patient-Information">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div>
                                                <div>
                                                    <h1>Patient Information</h1>
                                                </div>
                                                <div>
                                                    <p><b>Name</b>
                                                        {{ $patient_name->first_name . ' ' . $patient_name->last_name }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <p><b>MR Number</b> {{ $invoice->patient_mr_no }}</p>
                                                </div>
                                                <div>
                                                    <p><b>Contact Number</b> {{ $patient_name->contact_number }} </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="qr-code">
                                                <img src="{{ asset('uploads/logo/qr_code.png') }}" width="100%"
                                                    height="100%">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">S.No</th>
                                            <th scope="col">Test Name</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Discount</th>
                                            <th scope="col">Aditional Discount</th>
                                            <th scope="col">Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>{{ $invoice->patient_test_name }}</td>
                                            <td>{{ $invoice->test_amount }}</td>
                                            <td>
                                                @if ($invoice->test_discount_amount)
                                                    {{ $invoice->test_discount_amount }}%
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>
                                                @if ($invoice->additional_discount_amountt)
                                                    {{ $invoice->additional_discount_amount }}%
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td><b>{{ round($invoice->total_test_amount) }}</b></td>
                                        </tr>
                                    </tbody>
                                </table>
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















