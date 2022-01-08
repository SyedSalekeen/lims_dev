@extends('user.layouts.master')
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
                    <h4 class="card-title">Invoice Listening</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <button type="button" class="btn  create-new-button" data-toggle="modal"
                                data-target="#exampleModal">
                                Create New Invoice
                            </button>
                            {{-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                <i class="ft-plus"></i>
                            </button> --}}
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
                                            aria-label="Image: activate to sort column ascending">Patient Name</th>
                                        {{-- <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 120px;"
                                            aria-label="Name: activate to sort column ascending">Assigned To</th> --}}
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 100px;"
                                            aria-label="Employee Group: activate to sort column ascending">Test Amount
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 120px;"
                                            aria-label="Role: activate to sort column ascending">Invoice #
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="myTable" rowspan="1"
                                            colspan="1" style="width: 120px;"
                                            aria-label="Role: activate to sort column ascending">Invoice
                                        </th>
                                        <th style="text-align: center; width:100px;" class="sorting" tabindex="0"
                                            aria-controls="myTable" rowspan="1" colspan="1"
                                            aria-label="Action: activate to sort column ascending">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($add_test as $item)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1" tabindex="0">{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->patientName->fullname }}</td>
                                            {{-- <td>
                                                {{ $item->report_issue_date }}
                                            </td> --}}
                                            <td>
                                                {{ $item->amount }}
                                            </td>
                                            <td>
                                                {{ $item->id }}
                                            </td>
                                            <td>
                                                <button id="text" data-id="{{ $item->id }}"
                                                    class="btn back-button-color receiptShow" data-toggle="modal"
                                                    data-target="#ReceiptModal">
                                                    View
                                                </button>
                                            </td>
                                            <td>
                                                <center class="for-button-inline">
                                                    @if ($get_permission_edit_test)
                                                        <a href="{{ route('branch_add_test.edit', $item->id) }}"
                                                            class="btn bstm-color-btnns btn-circle"
                                                            style="background-color: #007bff !important;padding: 6px 10px"
                                                            data-toggle="tooltip" data-original-title="Edit">
                                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                                        </a>
                                                    @endif
                                                    @if ($get_permission_delete_test)
                                                        <a href="{{ route('branch_add_test.destroy_delete', $item->id) }}"
                                                            class="btn btn-danger btn-circle delete-row"
                                                            onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};"
                                                            data-toggle="tooltip" data-row-id="708"
                                                            data-original-title="Delete"
                                                            style="padding: 6px 10px;background-color:#fb1e3b !important;">
                                                            <i class="fa fa-times" aria-hidden="true"></i>
                                                        </a>
                                                    @endif
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



    <!-- Modal -->
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
    {{-- end modal --}}





    {{-- MODAL ONE --}}

    <div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content grey-color">
                <div class="modal-header cstm-heading">
                    <h4 class="modal-title text-center" id="exampleModalLabel">Create Booking Form</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addTest">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="box-for-shodow">
                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between">
                                            {{-- <div>
                                                <label for="">Category</label>
                                                <select name="" id="" class="for-s-width">
                                                    <option value="">----</option>
                                                    <option value="">----</option>
                                                    <option value="">----</option>
                                                </select>
                                            </div> --}}

                                        </div>

                                    </div>
                                    <div class="col-lg-12 search-heading">

                                        <input type="search" id="search" class="form-control newinput"
                                            placeholder="Search..">



                                    </div>
                                    <div class="col-lg-12 dental-heading">

                                        <h3>Select Test</h3>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row after_search_hidden">
                                            @foreach ($get_test_gig as $item)
                                                <div class="col-lg-4">
                                                    <div class="cards-boxs">
                                                        <label>{{ $item->test_name }}</label>
                                                        <span>Rs:{{ $item->test_amount }}</span>
                                                        <button type="button" class="back-button-color"
                                                            onclick="add_test_gig({{ $item->id }})">+Add</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="row" id="appendSearchTest">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="box-for-shodow">
                                    <div class="col-lg-10">
                                        <div class="date-time">
                                            <label>Date</label>
                                            <input type="Date" class="form-control newinput" name="date" required="">
                                        </div>
                                        <div class="date-time mt1">
                                            <label>Time</label>
                                            <input type="Time" class="form-control newinput" name="time" required="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="for-position">
                                                <div class="col-lg-10">
                                                    <div class="date-time mt1">
                                                        <label>Search a customer by name or mobile</label>

                                                        <select id="mySelect2"
                                                            class=" form-control select2 select2-hidden-accessible"
                                                            name="patient_mr_number" style="width: 100%;" tabindex="-1"
                                                            aria-hidden="true">
                                                            @foreach ($get_patients as $item)
                                                                <option value="{{ $item->id }}"
                                                                    data-id="{{ $item->fullname }},{{ $item->patient_email }}"
                                                                    title="{{ $item->fullname }},{{ $item->patient_email }}">
                                                                    {{ $item->fullname }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <a href="{{route('branch_patient.create')}}">
                                                    <button type="button" class="btn back-button-color for-top-0">Add Patient</button>
                                                    <a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tabel-for-scroll mt1 ">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Service</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Sub Total</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="append_gig_details">

                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- <div class="red-par">
                                        <p>Please select the service to continue</p>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn back-button-color">Create Booking</button>
                    </div>
                </form>


            </div>
        </div>
    </div>

    {{-- Modal 2 --}}
    <div class="modal fade" id="exampleModal2" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content grey-color">
                <div class="modal-header cstm-heading">
                    <h4 class="modal-title text-center" id="exampleModalLabel"> Booking Payment</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addPayement">
                    <div class="modal-body">
                        <div class="box-for-shodow">
                            <table class="table">
                                <thead class="for-transparent">
                                    <tr>
                                        <th scope="row">Sub Total</th>
                                        <input type="hidden" name="after_dicount_calculated" id="after_dicount_calculated"
                                            value="">
                                        <input type="hidden" id="test_amount" value="">
                                        <th scope="col" id="test_amount_td">}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Discount%</th>
                                        <td> <input type="Number" min="0" class="form-control newinput test-discount"
                                                name="discount" id="discount_amount"></td>

                                    </tr>
                                    <tr>
                                        <th scope="row">GST(17%)</th>
                                        <input type="hidden" name="gst_amount" id="gst_amount_input" value="">
                                        <td id="gst_amount"></td>

                                    </tr>
                                    <tr class="for-transparent">
                                        <th scope="row">Total</th>
                                        <input type="hidden" name="total_amount" id="total_amount" value="">
                                        <td class="for-transparent" id="total_test_amount"></td>

                                    </tr>
                                </tbody>
                            </table>
                            <div class="pay-butn">
                                <button class="btn back-button-color">Pay</button>
                            </div>
                        </div>
                    </div>
                </form>



            </div>
        </div>
    </div>

    <!-- Modal 3-->
    <div class="modal fade" id="exampleModal3" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-m" role="document">
            <div class="modal-content grey-color">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="exampleModalLabel">Pay</h4>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>
                <form action="{{ route('branch_payement_submit') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="col-lg-12">
                            <div>
                                <label>Toatl:</label>
                                <span id="final_amount"></span>
                            </div>

                        </div>
                        <div class="col-lg-10 mt1">
                            <div class="pay-chech-box" id="pills-tabContent">
                                <div class="">
                                    <input type="radio" name="fav_language" id="cash-radio" value="cash" checked>
                                    <label>Pay By Cash</label>
                                </div>
                                <div class="">
                                    <input type="radio" class="" name="fav_language" id="card-radio"
                                        value="card">
                                    <label>Pay By Card</label>
                                </div>
                                {{-- <div class="">
                                    <input type="radio" class="" name="fav_language" id="later-radio"
                                        value="later">
                                    <label>Pay By Later</label>
                                </div> --}}
                            </div>
                        </div>
                        <div id="myDIV">
                            <div class="col-lg-12 mt1">
                                <div class="cash-input">
                                    <label>Cash given by customer</label>
                                    <input type="Number" id="cash_given_by_customer"
                                        class="form-control cash_given_by_customer" min="0" name="cash_given">
                                </div>
                            </div>
                            <div class="row mt1 for-padding-row">
                                <div class="col-lg-6">
                                    <label>Cash Remaing</label>
                                    <input id="cash_remaining" name="cash_remaining" min="0" type="Number">

                                </div>
                                <div class="col-lg-6">
                                    <label>Cash To Return</label>
                                    <input id="cash_return" name="cash_return" min="0" type="Number">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn back-button-color" data-dismiss="modal">Pay</button>
                    </div>
                </form>
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


        function myFunction(e) {
            if (confirm("Are You Sure to delete this"))
                console.log(';e0', e)
            $('#' + e).remove()
        }

        // select 2 option click event
        $(document).on('mouseup', '.select2-container--open .select2-results__option', function(e) {
            console.log(e)
        })
        const TOKEN = $("#token").val();

        function add_test_gig(id) {

            console.log("here");
            console.log(id);
            console.log("add gig click");
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": TOKEN
                }
            });
            $.ajax({
                url: "{{ route('vendor_add_gig_to_invoice') }}",
                type: "GET",
                data: {
                    'id': id,
                },
                success: function(response) {
                    console.log(response);
                    $('#append_gig_details').append(
                        `
                    <tr id='remove-${response.gig_data.id}'>
                                    <td>${response.gig_data.test_name}</td>
                                    <td>${response.gig_data.test_amount}</td>
                                    <td>  <div class="quantity buttons_added">
                                        <a class="discrease_quantity" data-id=${response.gig_data.id}>
                                         <input id="abc" type="button" value="-" class="minus">
                                         <input type="hidden" name="gig_id[]" value="${response.gig_data.id}">
                                         <input type="number" step="1" min="1" id="${response.gig_data.id}" max="" name="quantity[]" value="1" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="">
                                         <input type="button" value="+" class="plus">
                                         </a>
                                    </div></td>
                                    <input type="hidden" id="first_amount${response.gig_data.id}" value=${response.gig_data.test_amount}>
                                    <input type="hidden" id="amount${response.gig_data.id}" value=${response.gig_data.test_amount} name="actual_amont[]">
                                        <td id="inner_amount${response.gig_data.id}">${response.gig_data.test_amount}</td>
                                        <td id="removetd">
                                                <a class="btn btn-danger" onclick="return myFunction('remove-${response.gig_data.id}');" value=${response.gig_data.id} href="#">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                </tr>
                            `)


                }
            });
        }
        $(document).ready(function() {

            function myFunction(e) {

                if (confirm("Are You Sure to delete this"))
                    $('#removetd').on('click', (e) => {
                        const tableData = e.target.parentNode.parentNode
                        $(tableData).remove()
                        console.log(tableData)
                    })
            }


            const appendDocumentNotes = (data) => {
                $('#appendSearchTest').empty();
                if (data.length > 0) {
                    data.map((val) => {
                        // console.log(val);
                        $('#appendSearchTest').append(
                            `   <div class="col-lg-4">
                                <div class="cards-boxs">
                                    <label>${val.test_name}</label>
                                    <span>Rs:${val.test_amount}</span>
                                    <button id='addSugarBtn' class='back-button-color'  onclick="add_test_gig(${val.id})">+Add</button>
                                </div>
                            </div>
                    `)
                    })
                } else {
                    $('#appendSearchTest').innerH(`<div>no data </div>`)
                }
            }

            $('#search').on('keyup', function() {
                $('#appendSearchTest').empty();
                $('.after_search_hidden').empty();
                notesDocumentData = [];
                var query = $(this).val();
                console.log(query);
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": TOKEN
                    }
                });
                $.ajax({

                    url: "{{ route('branch_search_patient') }}",
                    type: "GET",
                    data: {
                        'search': query,
                    },
                    success: function(response) {
                        if (response.data == "No result found") {
                            $('#appendSearchTest').html(
                                `<div class="apendedNodata d-flex justify-content-center align-items-center">no data </div>`
                            )
                            // return;
                        } else {
                            response.data.map((val) => {
                                notesDocumentData.push(val)
                            })
                            notesData = response
                        }
                        // notesData = response

                        const ids = notesDocumentData.map(o => o.id)
                        const filtered = notesDocumentData.filter(({
                            id
                        }, index) => !ids.includes(id, index + 1))
                        console.log(filtered)
                        notesDocumentData = filtered
                        appendDocumentNotes(filtered)
                    }
                });
            })


            // storing data
            $('#addTest').on("submit", function(event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": TOKEN
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('branch_add_test.store') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        document.getElementById("test_amount").value = response.success
                            .total_test_amount;
                        var amount = document.getElementById("test_amount_td").innerHTML =
                            response.success.total_test_amount;
                        gstAmount = Math.round((17 / 100) * amount);
                        document.getElementById("gst_amount").innerHTML = gstAmount
                        document.getElementById("total_test_amount").innerHTML = Number(
                            gstAmount) + Number(amount);
                        document.getElementById("after_dicount_calculated").value = amount;
                        document.getElementById("gst_amount_input").value = gstAmount;
                        document.getElementById("total_amount").value = Number(
                            gstAmount) + Number(amount);

                        $('#exampleModal').hide()
                        $('#exampleModal').removeClass('show')
                        $(".modal-backdrop").hide()
                        $("#exampleModal2").show()
                        $('#exampleModal2').css('visibility', 'visible');
                        $('#exampleModal2').css('opacity', '1');
                        $('#exampleModal2').addClass('show');

                    }
                })
            })

            $('#addPayement').on("submit", function(event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": TOKEN
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('branch_add_test_payemnet') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        $('#exampleModal2').hide()
                        $('#exampleModal2').removeClass('show')
                        $(".modal-backdrop").hide()
                        $("#exampleModal3").show()
                        $('#exampleModal3').css('visibility', 'visible');
                        $('#exampleModal3').css('opacity', '1');
                        $('#exampleModal3').addClass('show');
                        document.getElementById("final_amount").innerHTML = response.success
                            .amount;
                    }
                })

            })


            /// claculate discount
            $(".test-discount").on('keyup', () => {
                console.log("here");
                test_amount = document.getElementById("test_amount").value;
                discount_amount = document.getElementById("discount_amount").value;
                calcultedDiscountAmount = test_amount - (test_amount * (discount_amount / 100));
                document.getElementById("after_dicount_calculated").value =
                    calcultedDiscountAmount;
                console.log("calculate_discount_amount", calcultedDiscountAmount);
                number = Math.round(calcultedDiscountAmount);
                percentToGet = 17;

                // calculate gst amount
                gstAmount = Math.round((percentToGet / 100) * number);
                console.log("gstAmount", gstAmount);

                // claculate total amount

                totalAmount = Math.round(Number(gstAmount) + Number(calcultedDiscountAmount))
                console.log("totalAmount", totalAmount);

                document.getElementById("gst_amount").innerHTML = gstAmount;
                document.getElementById("total_test_amount").innerHTML = totalAmount;
                document.getElementById("total_amount").value = totalAmount;
                document.getElementById("gst_amount_input").value = gstAmount;
                gst_amount_input
            })
            $(".close").on('click', () => {
                $('#exampleModal2').hide()
            })



        })
        $(document).ready(function() {
            $('.select2').select2({
                closeOnSelect: false
            });
        });


        $(document).ready(function() {
            function formatState(state) {
                console.log(state)
                if (!state.id) {
                    return state.text;
                }
                var $state = $(
                    `<span><div class="row"><div class="col-md-12"><h6>${state?.title?.split(",")[0]}</h6></div><div class="col-md-6"><i class="fa fa-envelope"></i>: ${state.title.split(",")[1]}</div></div></span>`
                );
                return $state;
            };
            $('.select2').select2({
                closeOnSelect: false,
                templateResult: formatState
            });


            // pay 3rd modal



            $(".cash_given_by_customer").on('keyup', () => {
                customerAmount = document.getElementById("cash_given_by_customer").value;
                var total_amount = document.getElementById("final_amount").innerHTML;
                console.log(total_amount);
                console.log("customerAmount", customerAmount);
                console.log("total_amount", total_amount);
                cash_remaining = total_amount - customerAmount;
                cash_return = customerAmount - total_amount;
                if (cash_remaining < 0) {
                    document.getElementById("cash_remaining").value = "00"
                } else {
                    document.getElementById("cash_remaining").value = cash_remaining
                }
                if (cash_return < 0) {
                    document.getElementById("cash_return").value = "00"
                } else {
                    document.getElementById("cash_return").value = cash_return
                }
                console.log("cash_remaining", cash_remaining);
                console.log("cash_return", cash_return);
            })


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

        function wcqib_refresh_quantity_increments() {
            jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(a, b) {
                var c = jQuery(b);
                c.addClass("buttons_added"), c.children().first().before(
                    '<input type="button" value="-" class="minus" />'), c.children().last().after(
                    '<input type="button" value="+" class="plus" />')
            })
        }
        String.prototype.getDecimals || (String.prototype.getDecimals = function() {
            var a = this,
                b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
            return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
        }), jQuery(document).ready(function() {
            wcqib_refresh_quantity_increments()
        }), jQuery(document).on("updated_wc_div", function() {
            wcqib_refresh_quantity_increments()
        }), jQuery(document).on("click", ".plus, .minus", function() {
            var a = jQuery(this).closest(".quantity").find(".qty"),
                b = parseFloat(a.val()),
                c = parseFloat(a.attr("max")),
                d = parseFloat(a.attr("min")),
                e = a.attr("step");
            b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !==
                d ||
                (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(
                    this)
                .is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) :
                d &&
                b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger(
                    "change")
        });

        $('input[type=radio][name=fav_language').change(function() {
            console.log("hgdgd", this.value)
            if (this.value == 'cash') {
                $("#myDIV").css("display", "block")
            } else if (this.value == 'card') {
                $("#myDIV").css("display", "block")
            } else {
                $("#myDIV").css("display", "none")
            }
        });


        jQuery(document).on("click", ".discrease_quantity, .increase_quantity", function() {
            console.log("here");
            var id = $(this).data('id');
            console.log(id);
            var first_amount = "first_amount";
            var totn_string = 'amount';
            var inner_amount = 'inner_amount';
            var quantity = document.getElementById(id).value;
            var amount = document.getElementById(first_amount.concat(id)).value;
            var total_amount = quantity * amount;
            console.log(total_amount);
            document.getElementById(totn_string.concat(id)).value = total_amount;
            document.getElementById('inner_amount'.concat(id)).innerHTML = total_amount;
            console.log(amount, "hello");
        });
    </script>
@endsection
