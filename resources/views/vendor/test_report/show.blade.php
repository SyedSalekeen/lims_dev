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
                            <li><a class="btn btn-primary" href="{{ route('add_test.index') }}"> <i
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
                            <div class="form-body">
                                <h4 class="form-section"><i class="ft-user"></i> Patient Invoice</h4>
                                <hr>
                                {!! Form::model($edit_test, ['method' => 'PATCH', 'route' => ['add_test.update', $edit_test->id]]) !!}
                                <div class="form form-horizontal">
                                    <div class="form-body">

                                        <div class="form-group row">
                                            <label class="col-md-3" for="projectinput4">Branch</label>
                                            <div class="col-md-9 mx-auto">
                                                <select class="cstm-slect" name="branch" disabled>
                                                    <option selected disabled>Select Branch</option>
                                                    @foreach ($get_vendor_branch as $item)
                                                        <option value="{{ $item->id }}"<?php if($edit_test->branch_id == $item->id)
                                                            echo "selected";
                                                            ?>>{{ $item->branch_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput4">Patient MR Number</label>
                                            <div class="col-md-9 mx-auto">
                                                <select class="form-control select2 select2-hidden-accessible"
                                                    name="patient_mr_number" style="width: 100%;" tabindex="-1" aria-hidden="true" disabled>
                                                    <option selected disabled>Select Patient MR Number</option>
                                                    @forelse ($get_patients as $item )
                                                        <option value="{{ $item->id }}" <?php if($edit_test->branch_id == $item->id)
                                                            echo "selected";
                                                            ?>>{{ $item->id }}
                                                        @empty

                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" name="patient_test_name" id="patient_test_name" value="{{$edit_test->patient_test_name}}">
                                        <input type="hidden" name="patient_test_name_id" id="patient_test_name_id" value="{{$edit_test->patient_test_name_id}}">

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput4">Select Test Gig</label>
                                            <div class="col-md-9 mx-auto">
                                                <select class="form-control select2 select2-hidden-accessible"
                                                    name="patient_test" style="width: 100%;" tabindex="-1" aria-hidden="true"
                                                    id="selectBox" onchange="changeFunc();" disabled>
                                                    <option selected disabled>Select Test Gig</option>

                                                    @forelse ($get_test_gigs as $item )
                                                        <option value="{{ $item->id }}" <?php if($edit_test->patient_test_name_id == $item->id)
                                                            echo "selected";
                                                            ?>>{{ $item->test_name }}
                                                        @empty
                                                    @endforelse

                                                </select>
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput1">Report Issue Date</label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="Date" class="form-control newinput" readonly value="{{$edit_test->report_issue_date}}" name="report_issue_date"
                                                    required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput1">Test Amount</label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="Number" readonly class="form-control newinput"
                                                    id="test_amount" name="test_amount" readonly required=""  value="{{$edit_test->test_amount}}" placeholder="Amount">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput1">Discount in %:</label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="Number" id="discount_amount"  readonly value="{{$edit_test->test_discount_amount}}" class="form-control newinput test-dis" name="test_discount_amount"
                                                   placeholder="Discount">
                                            </div>
                                        </div>

                                         <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput1">Additional Discount in %:</label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="Number" id="additional_discount_amount" readonly  value="{{$edit_test->additional_discount_amount}}" class="form-control newinput additional-dis" name="additional_discount_amount"
                                                     placeholder="Additional Discount">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput1">Total Amount</label>
                                            <div class="col-md-9 mx-auto">
                                                <input type="Number" id="total_test_amount" readonly value="{{$edit_test->total_test_amount}}" readonly class="form-control newinput" name="total_test_amount"
                                                    required="" placeholder="Total Amount">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control mr-2" for="projectinput1">Note</label>
                                            <textarea id="w3review" name="test_notes" readonly rows="4" cols="50">
                                                {!!$edit_test->test_notes!!}
                                                </textarea>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                            <a href="{{ route('test_report.index') }}" type="submit"
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
            const TOKEN = $("#token").val();
            $(document).ready(function() {
                $('.select2').select2({
                    closeOnSelect: false
                });
            });

            $(function() {
                $("#add_new")
                    .select2({
                        placeholder: 'Select type',
                        width: '50%',
                        minimumResultsForSearch: Infinity
                    })
                    .on('select2:close', function() {
                        var el = $(this);
                        if (el.val() === "NEW") {
                            var newval = prompt("Add New Categary: ");
                            if (newval !== null) {
                                el.append('<option>' + newval + '</option>')
                                    .val(newval);

                            }
                        }
                    });
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
                            document.getElementById("test_amount").value = response.data.test_amount;
                            document.getElementById("patient_test_name").value = response.data.test_name;
                            document.getElementById("patient_test_name_id").value = response.data.id;

                        }
                    });

                });


            }

            $(".test-dis").on('keyup',()=>{

                test_amount = document.getElementById("test_amount").value;
                discount_amount = document.getElementById("discount_amount").value;
                console.log(test_amount);
                console.log(discount_amount);
                calcultedDiscountAmount = test_amount - (test_amount * (discount_amount/100));
                document.getElementById("total_test_amount").value = calcultedDiscountAmount;
            })
            $(".additional-dis").on('keyup',()=>{

                test_amount = document.getElementById("test_amount").value;
                discount_amount = document.getElementById("discount_amount").value;
                additional_discount_amount = document.getElementById("additional_discount_amount").value;
                console.log(test_amount);
                console.log(discount_amount);
                calcultedDiscountAmount = test_amount - (test_amount * (discount_amount/100));
                add_dis_amount = calcultedDiscountAmount - (calcultedDiscountAmount * (additional_discount_amount/100));
                document.getElementById("total_test_amount").value = add_dis_amount;
            })

        </script>
    @endsection
