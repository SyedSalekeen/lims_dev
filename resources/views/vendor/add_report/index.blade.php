@extends('admin.layouts.master')
@section('content')

    <div class="row dono">
        <div class="col-12">
            @if ($message = Session::get('success'))
                <div class="alert my-2 alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert my-2 alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @endif

            @if (Session::get('branch_test_add'))
                <?php
                session()->forget('branch_test_add');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Test has been created' }}</p>
                </div>
            @endif
            @if (Session::get('branch_test_updated'))
                <?php
                session()->forget('branch_test_updated');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Test has been updated' }}</p>
                </div>
            @endif
            @if (Session::get('vendor_add_report_deleted'))
                <?php
                session()->forget('vendor_add_report_deleted');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Test has been deleted' }}</p>
                </div>
            @endif

            <div class="card">
                <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                <div class="card-header">
                    <h4 class="card-title">Add Report</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>

                <div class="card-content collapse show">
                    <div style="background: white;padding:24px 10px;">
                        <div>
                            <table id="myTable" class="table w-100 dataTable no-footer dtr-inline" role="grid"
                                aria-describedby="myTable_info" style="width: 100%; text-align:center">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 20px;" aria-sort="ascending"
                                            aria-label="#: activate to sort column descending">#
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 120px;"
                                            aria-label="Image: activate to sort column ascending">Patient MR #</th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 120px;"
                                            aria-label="Image: activate to sort column ascending">Invoice #</th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 120px;"
                                            aria-label="Name: activate to sort column ascending">Invoice</th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 120px;"
                                            aria-label="Name: activate to sort column ascending">Bar Code</th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 100px;"
                                            aria-label="Employee Group: activate to sort column ascending">Reprot
                                        </th>

                                        <th style="text-align: center; width: 75px;" class="sorting" tabindex="0"
                                            aria-controls="myTable" rowspan="1" colspan="1"
                                            aria-label="Action: activate to sort column ascending">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($add_test as $item)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1" tabindex="0">{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->patient_mr_no }}</td>
                                            <td>
                                                {{ $item->id }}
                                            </td>
                                            <td>
                                                <button id="text" data-id="{{ $item->id }}"
                                                    class="btn back-button-color vendorReportreceiptShow"
                                                    data-toggle="modal" data-target="#ReceiptVendorAddReportModal">
                                                    Patient Invoice
                                                </button>
                                            </td>
                                            <td>
                                                <button id="text" data-id="{{ $item->id }}"
                                                    class="btn back-button-color vendorBarCodeShow"
                                                    data-toggle="modal" data-target="#VendorBarCodeModal">
                                                    Bar Code
                                                </button>
                                            </td>

                                            <td>
                                                <button type="button" class="btn back-button-color">
                                                    <a style="color: #fff;"
                                                        href="{{ route('vendor_add_report.show', $item->id) }}"><i
                                                            class=""></i>Add Report</a>
                                                </button>
                                            </td>

                                            <td>
                                                <center class="for-button-inline">

                                                    <a href="{{ route('vendor_add_report.destroy_delete', $item->id) }}"
                                                        class="btn btn-danger btn-circle delete-row"
                                                        onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};"
                                                        data-toggle="tooltip" data-row-id="708" data-original-title="Delete"
                                                        style="padding: 6px 10px;background-color:#fb1e3b !important;">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </a>
                                                </center>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Recipt  Modal -->
    <div class="modal fade" id="ReceiptVendorAddReportModal" tabindex="-1" role="dialog"
        aria-labelledby="ReceiptModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="text-align: center;">
                        <img class="img-status">
                        <h1 style="font-size:20px;    margin-bottom: 0;" id="laboratoryName">

                        </h1>
                        <h5 style="font-size:15px;    margin-bottom: 0;" id="branchName">

                        </h5>
                    </div>
                    <div class="modal-cstm-tittle">
                        <div>
                            <h4>Receipt#<span id="vendorReportReceiptNu"></span></>
                            </h4>
                            <span><strong>Patient MR:</strong>
                                <span id="vendorReportPatientMR"></span></span><br>
                            <span><strong>Patient Name:</strong>
                                <span id="vendorReportPatientName"></span></span>

                        </div>


                    </div>

                    <div>
                        <span><strong>Booking Date/Time:</strong> <span id="bookingDate"></span> : <span
                                id="bookingTime"></span> </span>

                    </div>
                    <div>
                        <span><strong>Patient Contact:</strong>
                            <span id="vendorReportPatientContactNumber"></span></span>
                    </div>
                    <div>
                        <span><strong>Patient Address:</strong>
                            <span id="vendorReportPatientAddress"></span></span>
                    </div>

                    <div>
                        <div class="row mt-1">
                            <div class="col-lg-12">
                                <table class="table" style="position: relative">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Test Name</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody id="ReceiptVendorAddReportModalAppend">

                                    </tbody>
                                    <tbody class="remove-line">
                                        <tr>
                                            <th>
                                            <td colspan="1"></td>
                                            <td>Sub Total</td>
                                            <td id="sub_total"></td>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                            <td colspan="1"></td>
                                            <td>Discount</td>
                                            <td id="discount_receipt"> <span>%</span></td>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                            <td colspan="1"></td>
                                            <td>GST(17%)</td>
                                            <td id="gst_receipt"></td>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                            <td colspan="1"></td>
                                            <td>Total</td>
                                            <td id="receipt_total"></td>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                            <td colspan="1"></td>
                                            <td>Payement Method</td>
                                            <td id="payement_method_receipt"></td>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                            <td colspan="1"></td>
                                            <td>Cash Given</td>
                                            <td id="payement_cash_given"></td>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                            <td colspan="1"></td>
                                            <td>Cash Remaining</td>
                                            <td id="payement_cash_remaining"></td>
                                            </th>
                                        </tr>

                                    </tbody>

                                </table>

                                <div id="QR_code_url" style="width: 150px; height: 150px;
                                        position: absolute; top: 50%; left: 10%;">
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <div class="modal-footer dono">

                    <button type="button" class="btn back-button-color" onclick="printDiv('printMe')">Print</button>
                </div>
            </div>
        </div>
    </div>

   <!--Bar Code  Modal -->
    <div class="modal fade" id="VendorBarCodeModal" tabindex="-1" role="dialog"
    aria-labelledby="ReceiptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">

                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>
            <div class="modal-body">

                <h5>Patient MR: 000005263635</h5>
                <h5>Invoice #: 000005263635</h5>
                @php
                    $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                @endphp
                <div id="barCodeAppend">

                </div>
                {{-- <img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode('000005263635', $generatorPNG::TYPE_CODE_128)) }}"> --}}
            </div>

            <div class="modal-footer dono">

                <button type="button" class="btn back-button-color" onclick="printDiv('printMe')">Print</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        function printDiv(divName) {
            // var printContents = document.getElementById(divName).innerHTML;
            $('.dono').css('display', 'none');
            $('.printclass').css('display', 'none');
            $('body').css('background-color', '#fff');
            $('.content-wrapper').addClass('blackie')

            $('.hadingbox .img').css({
                'display': 'block',
                'visibility': 'visible'
            });
            setTimeout(() => {
                var head = document.querySelector('head').innerHTML;
                var body = document.querySelector('body').innerHTML;
                console.log(body)
                var printContents = head + body
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                return location.reload();
                document.body.innerHTML = originalContents;
            }, 100)
        }



        $(document).ready(function() {
            $('#myTable').DataTable();
        });
        const TOKEN = $("#token").val();
        $(document).ready(function() {
            const appendReceipt = () => {
                receiptTableData.map((val) => {
                    console.log(val);
                    $('#ReceiptVendorAddReportModalAppend').append(
                        `     <tr>
                                        <th scope="row">1</th>
                                        <td>${val.get_gig_name.test_name}</td>
                                        <td>${val.gig_quantity}</td>
                                        <td>${val.gig_amount}</td>
                                    </tr>
                                `)
                })
            }



            $('.vendorBarCodeShow').on("click", function(event) {
                receiptTableData = [];
                event.preventDefault();
                var id = $(this).data('id');
                console.log(id);
                branchesData = []
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": TOKEN
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('vendor_bar_code_details') }}",
                    dataType: "json",
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        response.data.map((val) => {
                            branchesData.push(val)
                        })

                        branchesData.map((val) => {
                            console.log("vals", val);
                            $('#barCodeAppend').append(`<img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode('1234', $generatorPNG::TYPE_CODE_128)) }}">`)
                        });





                    }
                })

            })


            $('.vendorReportreceiptShow').on("click", function(event) {
                receiptTableData = [];
                event.preventDefault();
                var id = $(this).data('id');
                console.log(id);

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": TOKEN
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('patient_invoice_show') }}",
                    dataType: "json",
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        console.log(response);
                        response.data.map((val) => {
                            receiptTableData.push(val)
                        });
                        $('#ReceiptVendorAddReportModalAppend').empty();
                        appendReceipt();
                        document.getElementById("laboratoryName").innerHTML = response
                            .get_laoratory_name.laboratory_name;
                        document.getElementById("branchName").innerHTML = response
                            .get_branch_name.branch_name;
                        document.getElementById("vendorReportReceiptNu").innerHTML = response
                            .getTest.id;
                        document.getElementById("bookingDate").innerHTML = response.getTest
                            .booking_date;
                        document.getElementById("bookingTime").innerHTML = response.getTest
                            .booking_time;
                        document.getElementById("vendorReportPatientName").innerHTML = response
                            .get_patient
                            .fullname;
                        document.getElementById("vendorReportPatientMR").innerHTML = response
                            .get_patient
                            .id;
                        document.getElementById("vendorReportPatientContactNumber").innerHTML =
                            response.get_patient.contact_number;
                        document.getElementById("vendorReportPatientAddress").innerHTML =
                            response.get_patient.address;
                        document.getElementById("sub_total").innerHTML = response.getTest
                            .total_test_amount;
                        document.getElementById("discount_receipt").innerHTML = response.getTest
                            .discount;
                        document.getElementById("gst_receipt").innerHTML = response.getTest.gst;
                        document.getElementById("receipt_total").innerHTML = response.getTest
                            .amount;
                        document.getElementById("payement_method_receipt").innerHTML = response
                            .getTest.payement_method;
                        document.getElementById("payement_cash_given").innerHTML = response
                            .getTest.cash_given;
                        document.getElementById("payement_cash_remaining").innerHTML = response
                            .getTest.cash_remaining;
                        document.getElementById("QR_code_url").innerHTML = response.QrCodeHTML;
                        // var logo = innerHTML = response.get_laoratory_name.laboratory_logo;
                        // var source = "{!! asset('uploads/logo/61c4d11b63b2d.png') !!}";
                        // $('.img-status').attr('src', source);

                    }
                })

            })
        });
    </script>
@endsection
