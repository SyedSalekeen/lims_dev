@extends('patient.layouts.master')
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
            @if (Session::get('branch_test_deleted'))
                <?php
                session()->forget('branch_test_deleted');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Test has been deleted' }}</p>
                </div>
            @endif

            @if (Session::get('branch_edit_test_updated'))
                <?php
                session()->forget('branch_edit_test_updated');
                ?>
                <div class="alert my-2 alert-success">
                    <p>{{ 'Test has been updated' }}</p>
                </div>
            @endif


            <div class="card">
                <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
                <div class="card-header">
                    <h4 class="card-title">Invoice Listing</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>

                        </ul>
                    </div>
                </div>

                {{-- <div class="card-content collapse show">

                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Sr#</th>
                                    <th>MR NUMBER</th>
                                    <th>Invoice</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($add_test as $value)
                                    <tr role="row">
                                        <td>{{ $loop->index + 1 }}</td>

                                        <td>{{ $value->patient_mr_no }}</td>
                                        <td> <button id="text" data-id="{{ $value->id }}"
                                                class="btn btn-danger receiptShow" data-toggle="modal"
                                                data-target="#ReceiptModal">
                                                Invoice
                                            </button></td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div> --}}

                <div class="card-content collapse show">

                    <div style="background: white;padding:24px 10px;">
                        <div>
                            <table id="myTable" class="table w-100 dataTable no-footer dtr-inline" role="grid"
                                aria-describedby="myTable_info" style="width: 100%; text-align:center">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 50px;" aria-sort="ascending"
                                            aria-label="#: activate to sort column descending">#
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 120px;"
                                            aria-label="Image: activate to sort column ascending">MR #</th>
                                            <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 120px;"
                                            aria-label="Image: activate to sort column ascending">Invoice #</th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 120px;"
                                            aria-label="Name: activate to sort column ascending">Invoice</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($add_test as $item)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1" tabindex="0">{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->patient_mr_no }}</td>
                                            <td>{{ $item->id }}</td>

                                            <td> <button id="text" data-id="{{ $item->id }}"
                                                    class="btn back-button-color receiptShow" data-toggle="modal"
                                                    data-target="#ReceiptModal">
                                                    Invoice
                                                </button></td>

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



    <!-- Modal -->

    <div class="modal fade" id="ReceiptModal" tabindex="-1" role="dialog" aria-labelledby="ReceiptModalLabel"
        aria-hidden="true">
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
                        <!--<div class="contact-details">-->
                        <!--    <span>Generated By:</span>-->
                        <!--    <h2><strong id="laboratoryName"></strong></h2>-->
                        <!--    <p id="branchName"></p>-->
                        <!--    <label for="">+92-30245-300</label>-->

                        <!--</div>-->
                    </div>
                    {{-- {!! QrCode::size(200)->generate('Laravel Tutorial'); !!} --}}
                    <div>
                        <span><strong>Booking Date/Time:</strong> <span id="bookingDate"></span> : <span
                                id="bookingTime"></span> </span>
                        <!--<span>Booking Time: <p id="bookingTime"></p> </span>-->
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
                                    <tbody id="appendReciptTable">

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
                                {{-- <div style="width: 150px;
                                 height: 150px;
                                 position: absolute;
       top: 50%;
       left: 10%;
                                 ">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/QR_code_for_mobile_English_Wikipedia.svg/1200px-QR_code_for_mobile_English_Wikipedia.svg.png"
                                        width="100%" height="100%" />
                                </div> --}}
                            </div>

                        </div>

                    </div>

                </div>
                {{-- <div style="width: 100px;
height: 100px;
margin-left: auto;
margin-right: auto;
margin-bottom: 4px;">
             <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/QR_code_for_mobile_English_Wikipedia.svg/1200px-QR_code_for_mobile_English_Wikipedia.svg.png" width="100%" height="100%" />
         </div> --}}
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



        const TOKEN = $("#token").val();
        $(document).ready(function() {
            const appendReceipt = () => {
                receiptTableData.map((val) => {
                    console.log(val);
                    $('#appendReciptTable').append(
                        `     <tr>
                                        <th scope="row">1</th>
                                        <td>${val.get_gig_name.test_name}</td>
                                        <td>${val.gig_quantity}</td>
                                        <td>${val.gig_amount}</td>
                                    </tr>
                                `)
                })
            }




            $('.receiptShow').on("click", function(event) {
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
                    url: "{{ route('branch_add_test.invoice') }}",
                    dataType: "json",
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        console.log(response);
                        response.data.map((val) => {
                            receiptTableData.push(val)
                        });
                        $('#appendReciptTable').empty();
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
