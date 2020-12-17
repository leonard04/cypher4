@extends('layouts.template')

@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3>Leasing</h3><br>

            </div>
            <div class="card-toolbar">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addItem"><i class="fa fa-plus"></i>Add Leasing</button>
                </div>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            {{--            <h5><span class="span">This page contains a list of Travel Order which has been formed.</span></h5>--}}
            <table class="table display">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-left">Subject</th>
                    <th class="text-center">Vendor</th>
                    <th class="text-center">Currency</th>
                    <th class="text-center">Total Amount</th>
                    <th class="text-center">Payment</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($loans as $key => $loan)
                        <tr>
                            <td align="center">{{$key + 1}}</td>
                            <td>
                                <a href="{{URL::route('leasing.detail', $loan->id)}}" class="text-hover-danger"><i class="fa fa-search text-primary icon-sm"></i> {{$loan->subject}}</a>
                            </td>
                            <td align="center">{{strip_tags($loan->vendor)}}</td>
                            <td align="center">{{$loan->currency}}</td>
                            <td align="center">{{number_format($loan->value)}}</td>
                            <td align="center">
                                @if(!isset($plan_date[$loan->id]))
                                    <span class="label label-inline label-danger">Leasing has not been planned</span>
                                @else
                                    @if(isset($plan_date[$loan->id]['paid']) && count($plan_date[$loan->id]['paid']) == $loan->period)
                                        <span class="label label-inline label-success">Leasing Finished</span>
                                    @elseif(count($plan_date[$loan->id]['planned']) == $loan->period)
                                        <span class="label label-inline label-info">Waiting for the first payment</span>
                                    @else
                                        <span class="label label-inline">{{end($plan_date[$loan->id]['paid'])}}</span>
                                    @endif
                                @endif
                            </td>
                            <td align="center">
{{--                                <button class="btn btn-icon btn-primary btn-xs"><i class="fa fa-pencil-alt"></i></button>--}}
                                <button class="btn btn-icon btn-danger btn-xs" onclick="button_delete({{$loan->id}})"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Leasing</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form method="post" action="{{URL::route('leasing.add')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Basic Info</h3>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">Subject</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Subject" name="subject" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">Vendor</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Vendor" name="vendor" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3>Detail Leasing</h3>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">Currency</label>
                                    <div class="col-md-9">
                                        <select name="currency" class="form-control select2" required>
                                            @foreach(json_decode($list_currency) as $key => $value)
                                                <option value="{{$key}}" {{($key == "IDR") ? "selected" : ""}}>{{strtoupper($key."-".$value)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">Price</label>
                                    <div class="col-md-9">
                                        <input type="number" value="0" class="form-control" placeholder="Price" name="price" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">Down Payment</label>
                                    <div class="col-md-9">
                                        <input type="number" value="0" class="form-control" placeholder="Down Payment" name="dp" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">Administration Cost</label>
                                    <div class="col-md-9">
                                        <input type="number" value="0" class="form-control" placeholder="Administration Cost" name="ac" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">Insurance Cost</label>
                                    <div class="col-md-9">
                                        <input type="number" value="0" class="form-control" placeholder="Insurance Cost" name="ic" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">Interest Percentage</label>
                                    <div class="col-md-7">
                                        <input type="number" value="0" step=".01" class="form-control" placeholder="Interest Percentage" name="int_percentage" required>
                                        <span class="text-primary">(Fill with percent per month. If interest is 1% per year, and there are 2 years, then fill with 2%)</span>
                                    </div>
                                    <label class="col-md-2 col-form-label text-right">%</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">Leasing Duration</label>
                                    <div class="col-md-7">
                                        <input type="number" value="0" class="form-control" placeholder="Leasing Duration" name="loan_duration" required>
                                    </div>
                                    <label class="col-md-2 col-form-label text-right">month(s)</label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label text-right">Leasing Start</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" name="loan_start" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary font-weight-bold">
                            <i class="fa fa-check"></i>
                            Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom_script')
    <script src="{{asset('theme/assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js?v=7.0.5')}}"></script>
    <script>
        function submit_edit_form(){
            Swal.fire({
                title: "Update",
                text: "Are you sure you want to update this data?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Submit",
                cancelButtonText: "Cancel",
                reverseButtons: true,
            }).then(function(result){
                if(result.value){
                    $("#btn-submit-edit").click()
                }
            })
        }
        function button_delete(x){
            Swal.fire({
                title: "Reject",
                text: "Are you sure you want to delete?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
                reverseButtons: true,
            }).then(function(result){
                if(result.value){
                    $.ajax({
                        url: "{{URL::route('leasing.delete')}}",
                        type: "POST",
                        dataType: "json",
                        data: {
                            '_token' : '{{csrf_token()}}',
                            'val' : x
                        },
                        cache: false,
                        success: function(response){
                            if (response.error == 0) {
                                location.reload()
                            } else {
                                Swal.fire({
                                    title: "Error Occured",
                                    icon: "error"
                                })
                            }
                        }
                    })
                }
            })
        }
        function button_edit(x){
            $.ajax({
                url: "{{URL::route('treasury.find')}}",
                type: "POST",
                dataType: "json",
                data: {
                    '_token' : '{{csrf_token()}}',
                    'val' : x
                },
                cache: false,
                success: function(response){
                    $("#bank_name").val(response.source)
                    $("#branch_name").val(response.branch)
                    $("#account_name").val(response.account_name)
                    $("#account_number").val(response.account_number)
                    $("#currency").val(response.currency).trigger('change')
                    $("#id_tre").val(response.id)
                }
            })
        }
        $(document).ready(function(){
            $("#btn-submit-edit").hide()
            $("#btn-submit").hide()
            $("#btn-deposit").click(function(){
                Swal.fire({
                    title: "Add Deposit",
                    text: "Are you sure you want to submit this data?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Submit",
                    cancelButtonText: "Cancel",
                    reverseButtons: true,
                }).then(function(result){
                    if(result.value){
                        $("#btn-submit").click()
                    }
                })
            })

            $("table.display").DataTable({
                responsive: true,
                fixedHeader: true,
                fixedHeader: {
                    headerOffset: 90
                }
            })
            $("select.select2").select2({
                width: "100%"
            })
        })
    </script>
@endsection
