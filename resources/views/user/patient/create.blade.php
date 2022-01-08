@extends('user.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">

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
                        <form action="{{ route('branch_patient.store') }}" method="POST" enctype="multipart/form-data"
                            id="branchFormInvoice">
                            @csrf
                            <div class="form form-horizontal">
                                <div class="form-body">
                                    <h4 class="form-section"><i class="ft-user"></i> Create New Patient</h4>


                                    <h1 class="mb-3">Patient Information</h1>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput1">First Name</label>
                                        <div class="col-md-9 mx-auto">
                                            {!! Form::text('first_name', null, ['placeholder' => 'First Name', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput2">Last Name</label>
                                        <div class="col-md-9 mx-auto">
                                            {!! Form::text('last_name', null, ['placeholder' => 'Last Name', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput4">Select Gender</label>
                                        <div class="col-md-9 mx-auto">
                                            <select class="form-control" id="select1" name="gender">
                                                <option selected disabled>Select Gender</option>

                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Others</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput4">Marital status</label>
                                        <div class="col-md-9 mx-auto">
                                            <select class="form-control" id="select1" name="martial_status">
                                                <option selected disabled>Select marital status</option>
                                                <option value="single">Single</option>
                                                <option value="married">Married</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput3">Email</label>
                                        <div class="col-md-9 mx-auto">
                                            {!! Form::email('username', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}

                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput3">Password</label>
                                        <div class="col-md-9 mx-auto">
                                            {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput4">Confirm Password</label>
                                        <div class="col-md-9 mx-auto">
                                            {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput4">Contact Number</label>
                                        <div class="col-md-9 mx-auto">
                                            {!! Form::number('contact_number', null, ['placeholder' => 'Contact Number', 'class' => 'form-control', 'min' => '0']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput4">Age</label>
                                        <div class="col-md-9 mx-auto">
                                            {!! Form::number('age', null, ['placeholder' => 'Age', 'class' => 'form-control', 'min' => '0']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput4">Address</label>
                                        <div class="col-md-9 mx-auto">
                                            {!! Form::text('address', null, ['placeholder' => 'Address', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput4">Country</label>
                                        <div class="col-md-9 mx-auto">
                                            <select class="form-control" name="country" id="selectCountry"
                                                onchange="changeFuncOne();">
                                                <option selected disabled>Select Country</option>
                                                @foreach ($get_country as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput4">State</label>
                                        <div class="col-md-9 mx-auto">
                                            {!! Form::text('state', null, ['placeholder' => 'State', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput4">City</label>
                                        <div class="col-md-9 mx-auto">
                                            {!! Form::text('city', null, ['placeholder' => 'City', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    {{-- <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput4">State</label>
                                        <div class="col-md-9 mx-auto">
                                            <select class="form-control" name="state" onchange="changeFuncTwo();"
                                                id="selectState">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput4">City</label>
                                        <div class="col-md-9 mx-auto">
                                            <select class="form-control" name="city" id="selectCity">

                                            </select>
                                        </div>
                                    </div> --}}



                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput4">Zip Code</label>
                                        <div class="col-md-9 mx-auto">
                                            {!! Form::text('zip_code', null, ['placeholder' => 'Zip Code', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    {{-- <div class="form-group row">
                                    <label class="col-md-3 label-control" for="projectinput4">Branch</label>
                                    <div class="col-md-9 mx-auto">
                                        <select class="form-control"
                                             name="branch">
                                            <option selected disabled>Select Branch</option>
                                            @foreach ($get_vendor_branch as $item)
                                                <option value="{{ $item->id }}">{{ $item->branch_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                    <h1 class="mb-3">Emergency Contact</h1>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput1">Name</label>
                                        <div class="col-md-9 mx-auto">
                                            {!! Form::text('emergency_name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput1">Relationship</label>
                                        <div class="col-md-9 mx-auto">
                                            {!! Form::text('relationship', null, ['placeholder' => 'Relationship', 'class' => 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control" for="projectinput1">Home Phone</label>
                                        <div class="col-md-9 mx-auto">
                                            {!! Form::number('home_phone', null, ['placeholder' => 'Home Phone', 'class' => 'form-control', 'min' => '0']) !!}
                                        </div>

                                        <div class=" col-xs-12 col-sm-12 col-md-12 text-center">
                                            <button type="submit" onclick="branchSubmitFormInvoice();"
                                                class="btn submit-button-color float-right box-shadow-1 mt-1 ml-3 mb-1 ">
                                                <i class="ft-check"></i>
                                                Save And Create Invoice
                                            </button>
                                            <button type="submit"
                                                class="btn submit-button-color float-right box-shadow-1 mt-1 mb-1"><i
                                                    class="ft-check"></i>Save Patient</button>

                                        </div>
                                        <button id="branchModalTrigger" hidden data-toggle="modal"
                                            data-target="#exampleModal"></button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>


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
                                                            <label>Patient Name</label>
                                                            <input type="text" class="form-control newinput"
                                                                id="branchPatientName" readonly value="" required="">
                                                            <input type="hidden" class="form-control newinput"
                                                                name="patient_id" id="branchPatientId" value="" required="">
                                                        </div>
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

                    <button id="modalTriggerTwo" hidden data-toggle="modal" data-target="#exampleModal2"></button>
                </div>
            </div>
        </div>


        {{-- Modal 2 --}}
        <div class="modal fade" id="exampleModal2" role="dialog" aria-labelledby="exampleModalLabel2"
            aria-hidden="true">
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
                                            <input type="hidden" name="after_dicount_calculated"
                                                id="after_dicount_calculated" value="">
                                            <input type="hidden" id="test_amount" value="">
                                            <th scope="col" id="test_amount_td">}</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Discount%</th>
                                            <td> <input type="Number" class="form-control newinput test-discount"
                                                    name="discount" min="0" id="discount_amount"></td>

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
        <div class="modal fade" id="exampleModal3" role="dialog" aria-labelledby="exampleModalLabel2"
            aria-hidden="true">
            <div class="modal-dialog modal-m" role="document">
                <div class="modal-content grey-color">
                    <div class="modal-header">
                        <h4 class="modal-title text-center" id="exampleModalLabel">Pay</h4>
                        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> --}}
                    </div>
                    <form action="{{ route('branch_patient_payement_submit') }}" method="POST">
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
                                        <input id="Number" name="cash_return" min="0" type="text">
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
        <script type="text/javascript">
            const TOKEN = $("#token").val();

            function myFunction(e) {
                if (confirm("Are You Sure to delete this"))
                    console.log(';e0', e)
                $('#' + e).remove()
            }


            var something = (function() {
                var executed = false;
                return function() {
                    if (!executed) {
                        executed = true;
                        // do something
                        $("#branchModalTrigger").click();
                        setTimeout(() => {
                            executed = false;
                        }, 5000);
                    }
                };
            })()



            function branchSubmitFormInvoice() {
                var submitted = false;
                console.log("here");
                $('#branchFormInvoice').on("submit", function(event) {
                    event.preventDefault();
                    var formData = new FormData(this);
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": TOKEN
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('branch_patient.store_create_invoice') }}",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            submitted = true;
                            something();
                            $('#branchPatientName').val(response.data.fullname);
                            $('#branchPatientId').val(response.data.email);

                        }

                    });
                    // if (submitted) {
                    //     console.log("here");
                    //     $("#branchModalTrigger").click()
                    // }
                });
            }

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
                    url: "{{ route('branch_patient_add_test.store_invoice') }}",
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
                        $("#modalTriggerTwo").click()

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
                    url: "{{ route('branch_patient_test_payement') }}",
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
                        $("#modalTriggerThree").click()
                    }
                })

            })

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

                    url: "{{ route('vendor_search_patient') }}",
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

            var loadFile = function(event) {
                var reader = new FileReader();
                reader.onload = function() {
                    var output = document.getElementById('output');
                    output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            };



            function changeFuncOne() {

                $('#selectState').empty();
                var selectBox = document.getElementById("selectCountry");
                var selectedValueId = selectBox.options[selectBox.selectedIndex].value;
                console.log(selectedValueId);
                $(document).ready(function() {
                    statesData = []
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": TOKEN
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('get_states') }}",
                        dataType: "json",
                        data: {
                            id: selectedValueId,
                        },
                        success: function(response) {

                            response.data.map((val) => {
                                statesData.push(val)

                            })
                            statesData.map((val) => {

                                $('#selectState').append(`<option value="${val.id}">
                                                                               ${val.name}
                                                                          </option>`)
                            });
                        }
                    });
                });
            }



            function changeFuncTwo() {
                $('#selectCity').empty();
                var selectBox = document.getElementById("selectState");
                var selectedValueId = selectBox.options[selectBox.selectedIndex].value;
                console.log(selectedValueId);
                $(document).ready(function() {
                    countryData = []
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": TOKEN
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('get_country') }}",
                        dataType: "json",
                        data: {
                            id: selectedValueId,
                        },
                        success: function(response) {

                            response.data.map((val) => {
                                countryData.push(val)

                            })
                            countryData.map((val) => {

                                $('#selectCity').append(`<option value="${val.id}">
                                                                               ${val.name}
                                                                          </option>`)
                            });
                        }
                    });
                });
            }

            function myFunction(e) {

                if (confirm("Are You Sure to delete this"))
                    $('#removetd').on('click', (e) => {
                        const tableData = e.target.parentNode.parentNode
                        $(tableData).remove()
                        console.log(tableData)
                    })
            }

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
