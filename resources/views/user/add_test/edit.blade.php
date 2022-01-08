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
                            <li><a class="btn back-button-color" href="{{ route('branch_add_test.index') }}"> <i
                                        class="ft-arrow-left"></i></a></li>
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
                        <div class="form form-horizontal">


                            <form id="editBranchTest">
                                <input type="hidden" value="{{ $get_add_test->id }}" name="BranchEdit_test_id">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="box-for-shodow">

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
                                                        <input type="Date" class="form-control newinput" name="date"
                                                            value="{{ $get_add_test->booking_date }}" required="">
                                                    </div>
                                                    <div class="date-time mt1">
                                                        <label>Time</label>
                                                        <input type="Time" class="form-control newinput" name="time"
                                                            value="{{ $get_add_test->booking_time }}" required="">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="for-position">
                                                            <div class="col-lg-10">
                                                                <div class="date-time mt1">
                                                                    <label>Search a customer by name</label>

                                                                    <select id="mySelect2"
                                                                        class=" form-control select2 select2-hidden-accessible"
                                                                        name="patient_mr_number" style="width: 100%;"
                                                                        tabindex="-1" aria-hidden="true">
                                                                        @foreach ($get_patients as $item)
                                                                            <option value="{{ $item->id }}"
                                                                                {{ $get_add_test->patient_mr_no == $item->id ? 'selected' : '' }}
                                                                                data-id="{{ $item->fullname }},{{ $item->patient_email }}"
                                                                                title="{{ $item->fullname }},{{ $item->patient_email }}">
                                                                                {{ $item->fullname }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tabel-for-scroll mt1 " style="
                                                            overflow-x: auto;
                                                        ">
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
                                                            @foreach ($get_add_test_details as $item)
                                                                <tr>
                                                                    <td>{{ $item->get_gig_name->test_name }}</td>
                                                                    <td>{{ $item->get_gig_name->test_amount }}</td>
                                                                    <td>
                                                                        <div class="quantity buttons_added">
                                                                            <a class="discrease_quantity"
                                                                                data-id="{{ $item->id }}">
                                                                                <input id="abc" type="button" value="-"
                                                                                    class="minus">
                                                                                <input type="hidden" name="gig_id[]"
                                                                                    value="{{ $item->gig_id }}">
                                                                                <input type="number" step="1" min="1"
                                                                                    id="{{ $item->id }}" max=""
                                                                                    name="quantity[]"
                                                                                    value="{{ $item->gig_quantity }}"
                                                                                    title="Qty" class="input-text qty text"
                                                                                    size="4" pattern="" inputmode="">
                                                                                <input type="button" value="+"
                                                                                    class="plus">
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                    <input type="hidden"
                                                                        id="first_amount{{ $item->id }}"
                                                                        value="{{ $item->get_gig_name->test_amount }}">
                                                                    <input type="hidden" id="amount{{ $item->id }}"
                                                                        value="{{ $item->gig_amount }}"
                                                                        name="actual_amont[]">
                                                                    <td id="inner_amount{{ $item->id }}">
                                                                        {{ $item->gig_amount }}</td>
                                                                    <td id="removetd">
                                                                        <a class="btn btn-danger"
                                                                            href="{{ route('edit_test_delete', $item->id) }}"
                                                                            onclick="return myFunction();"
                                                                            {{ $item->id }} href="#">
                                                                            <i class="fa fa-times"></i>
                                                                        </a>
                                                                    </td>

                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="red-par">
                                                    <p>If you delete any item you must have to complete the whole process
                                                    </p>
                                                </div>
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
                                            <tr class="for-transparent">
                                                <th scope="row">Cash Given</th>
                                                <td class="for-transparent" id="cashGiven"></td>

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
                        <form action="{{ route('branch_edit_payement_submit') }}" method="POST">
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
                function myFunction(e) {
                    if (confirm("Are You Sure to delete this"))
                        console.log(';e0', e)
                    $('#' + e).remove()
                }

                function myFunction(e) {

                    if (confirm("Are You Sure to delete this"))
                        $('#removetd').on('click', (e) => {
                            const tableData = e.target.parentNode.parentNode
                            $(tableData).remove()
                            console.log(tableData)
                        })
                }
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

                    </tr>
                `)


                        }
                    });
                }


                $(document).ready(function() {

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

                    $('.select2').select2({
                        closeOnSelect: false
                    });

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

                    $('#editBranchTest').on("submit", function(event) {
                        event.preventDefault();
                        var formData = new FormData(this);
                        $.ajaxSetup({
                            headers: {
                                "X-CSRF-TOKEN": TOKEN
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ route('branch_edit_test.editStore') }}",
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
                                document.getElementById("cashGiven").innerHTML = response.success.amount;

                                document.getElementById("total_test_amount").innerHTML = Number(
                                    gstAmount) + Number(amount);
                                document.getElementById("after_dicount_calculated").value = amount;
                                document.getElementById("gst_amount_input").value = gstAmount;
                                document.getElementById("total_amount").value = Number(
                                    gstAmount) + Number(amount);
                                $("#exampleModal2").show()
                                $('#exampleModal2').css('visibility', 'visible');
                                $('#exampleModal2').css('opacity', '1');
                                $('#exampleModal2').addClass('show');

                            }
                        })


                        // cash given by customer
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
                    })


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
                        b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d &&
                            "NaN" !==
                            d ||
                            (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1),
                            jQuery(
                                this)
                            .is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e
                                .getDecimals())) :
                            d &&
                            b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a
                            .trigger(
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
                    })
                    $(".close").on('click', () => {
                        $('#exampleModal2').hide()
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
                            url: "{{ route('branch_edit_test_payemnet') }}",
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
                });



                function changeFunc() {
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
                            url: "{{ route('add_test_gig_amount') }}",
                            dataType: "json",
                            data: {
                                id: selectedValueId,
                            },
                            success: function(response) {
                                console.log(response);
                                document.getElementById("test_amount").value = response.data
                                    .test_amount;
                                document.getElementById("patient_test_name").value = response.data
                                    .test_name;
                                document.getElementById("patient_test_name_id").value = response
                                    .data.id;

                            }
                        });

                    });


                }

                $(".test-dis").on('keyup', () => {

                    test_amount = document.getElementById("test_amount").value;
                    discount_amount = document.getElementById("discount_amount").value;
                    console.log(test_amount);
                    console.log(discount_amount);
                    calcultedDiscountAmount = test_amount - (test_amount * (discount_amount / 100));
                    document.getElementById("total_test_amount").value = calcultedDiscountAmount;
                })
                $(".additional-dis").on('keyup', () => {

                    test_amount = document.getElementById("test_amount").value;
                    discount_amount = document.getElementById("discount_amount").value;
                    additional_discount_amount = document.getElementById("additional_discount_amount").value;
                    console.log(test_amount);
                    console.log(discount_amount);
                    calcultedDiscountAmount = test_amount - (test_amount * (discount_amount / 100));
                    add_dis_amount = calcultedDiscountAmount - (calcultedDiscountAmount * (
                        additional_discount_amount / 100));
                    document.getElementById("total_test_amount").value = add_dis_amount;
                })
            </script>
        @endsection
