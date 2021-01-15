@extends('layouts.template')
@section('content')
@actionStart('fr', 'access')
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3>List Item Request</h3><br>

            </div>
            @actionStart('fr', 'create')
            <div class="card-toolbar">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addItem"><i class="fa fa-plus"></i>Form Request</button>
                </div>
                <!--end::Button-->
            </div>
            @actionEnd
        </div>
        <div class="card-body">
            <div class="row mb-5 mt-5">
                <div class="col-md-12">
                    <img src="{{asset('media/ir.png')}}" alt="" style="width: 35%">
                </div>
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @actionStart('frwaiting', 'access')
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#all">
                        <span class="nav-icon">
                            <i class="flaticon-folder-1"></i>
                        </span>
                        <span class="nav-text">IR Waiting</span>
                    </a>
                </li>
                @actionEnd
                @actionStart('frbank', 'access')
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#sales" aria-controls="profile">
                        <span class="nav-icon">
                            <i class="flaticon-folder-2"></i>
                        </span>
                        <span class="nav-text">IR Bank</span>
                    </a>
                </li>
                @actionEnd
                @actionStart('frrejected', 'access')
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#cost" aria-controls="profile">
                        <span class="nav-icon">
                            <i class="flaticon-folder-3"></i>
                        </span>
                        <span class="nav-text">IR Rejected</span>
                    </a>
                </li>
                @actionEnd
            </ul>
            <div class="tab-content mt-5" id="myTabContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="home-tab">
                    <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <table class="table table-bordered table-hover display font-size-sm frwaiting" style="margin-top: 13px !important; width: 100%;">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-left">Request Date</th>
                                <th class="text-center">IR Code</th>
                                <th class="text-center">Request by</th>
                                <th class="text-center">Division</th>
                                <th class="text-left">Project</th>
                                <th class="text-center">Company</th>
                                <th class="text-center">Item(s)</th>
                                <th class="text-center">Division Approval</th>
                                <th class="text-center">Asset Approval</th>
                                <th class="text-center">Delivery Status</th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>

                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="profile-tab">
                    <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <table class="table table-bordered table-hover display font-size-sm frbank" style="margin-top: 13px !important; width: 100%;">
                            <thead class="table-success">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-left">Request Date</th>
                                <th class="text-center">IR Code</th>
                                <th class="text-center">Request by</th>
                                <th class="text-center">Division</th>
                                <th class="text-left">Project</th>
                                <th class="text-center">Company</th>
                                <th class="text-center">Item(s)</th>
                                <th class="text-center">Division Approval</th>
                                <th class="text-center">Asset Approval</th>
                                <th class="text-center">Delivery Status</th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>

                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="cost" role="tabpanel" aria-labelledby="contact-tab">
                    <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <table class="table table-bordered table-hover display font-size-sm frreject" style="margin-top: 13px !important; width: 100%;">
                            <thead class="table-danger">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-left">Request Date</th>
                                <th class="text-center">IR Code</th>
                                <th class="text-center">Request by</th>
                                <th class="text-center">Division</th>
                                <th class="text-left">Project</th>
                                <th class="text-center">Company</th>
                                <th class="text-center">Item(s)</th>
                                <th class="text-center">Division Reject</th>
                                <th class="text-center">Asset Reject</th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="addEmployee" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Request Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form method="post" id="form-add" action="{{URL::route('fr.add')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <span class="form-text text-dark">Please kindly fill in the form below for your requested asset.The form will be used by Asset Division to check for the availability in the warehouse.</span>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Request By</h4>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Name</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Name" name="request_by" value="{{Auth::user()->username}}" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Division Type</label>
                                    <div class="col-md-6">
                                        <select name="division" id="division" class="form-control">
                                            <!-- CONSULTANT 13-09-2018 Aldi-->
                                            <!-- ========================================================================================================== -->
                                            <!-- ========================================================================================================== -->

                                            <option value="">-Choose-</option>
                                            <option value="Asset">Asset</option>
                                            <option value="Consultant">Consultant</option>
                                            <option value="Finance">Finance</option>
                                            <option value="GA">GA</option>
                                            <option value="HRD">HRD</option>
                                            <option value="IT">IT</option>
                                            <option value="Laboratory">Laboratory</option>
                                            <option value="Maintenance">Maintenance</option>
                                            <option value="Marketing">Marketing</option>
                                            <option value="Operation">Operation</option>
                                            <option value="Procurement">Procurement</option>
                                            <option value="Production">Production</option>
                                            <option value="QC">QC</option
                                            ><option value="QHSSE">QHSSE</option>
                                            <option value="Receiptionist">Receiptionist</option>
                                            <option value="Secretary">Secretary</option>
                                            <option value="Technical">Technical</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">FR Type</label>
                                    <div class="col-md-6">
                                        <select name="fr_type" class="form-control">
                                            <option value="">-Choose-</option>
                                            <option value="ATK">[3] ATK</option>
                                            <option value="INVESTASI">[4] INVESTASI</option>
                                            <option value="MATERIAL">[5] MATERIAL</option>
                                            <option value="SPARE PART">[6] SPARE PART</option>
                                            <option value="HSE &amp; PPE">[7] HSE &amp; PPE</option>
                                            <option value="FUEL SOLAR/BENSIN">[8] FUEL SOLAR/BENSIN</option>
                                            <option value="OLI MESIN">[9] OLI MESIN</option>
                                            <option value="LABORATORIUM">[10] LABORATORIUM</option>
                                            <option value="FURNITURE">[11] FURNITURE</option>
                                            <option value="MEKANIKAL N ELECTRICAL">[12] MEKANIKAL N ELECTRICAL</option>
                                            <option value="ELECTRONIC AND TOOLS">[13] ELECTRONIC AND TOOLS</option>
                                            <option value="KONSTRUKSI">[14] KONSTRUKSI</option>
                                            <option value="OFFICE SUPPORTING">[15] OFFICE SUPPORTING</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Request Date</label>
                                    <div class="col-md-6">
                                        <input type="date" name="request_date" id="request_time" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Due Date</label>
                                    <div class="col-md-6">
                                        <input type="date" name="due_date" id="due_date" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Project Category</label>
                                    <div class="col-md-6">
                                        <select name="category" id="pr_cat" class="form-control">
                                            <option value="">Choose</option>
                                            <option value="cost">cost</option>
                                            <option value="sale">sale</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row" id="opt">
                                    <label class="col-md-2 col-form-label text-right">Project</label>
                                    <div class="col-md-6">
                                        <select name="project" id="project" class="form-control">

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Payment Method</label>
                                    <div class="col-md-6 col-form-label">
                                        <div class="checkbox-inline">
                                            <label class="checkbox checkbox-outline checkbox-success">
                                                <input type="checkbox" name="payment_method"/>
                                                <span></span>
                                                BACK DATE
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Notes</label>
                                    <div class="col-md-6">
                                        <textarea name="notes" id="fr_note" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4>Request Item</h4>
                                <hr>
                                <div class="form-group row">
                                    <table class="table table-bordered" id="list_item">
                                        <thead>
                                        <tr>
                                            <th>Item Code</th>
                                            <th>Item Name</th>
                                            <th>UoM</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tr>
                                            <td colspan="2"  width="450">
                                                <div class="form-group" id="div-target">
                                                    <form class="eventInsForm" action="#" method="post">
                                                        <input type="text" style="width:100%" class="form-control" id="item" placeholder="Item Name/Code" />
                                                    </form>
                                                    <input type="hidden" id="id" />
                                                    <input type="hidden" id="code" />
                                                    <input type="hidden" id="name" />
                                                    <input type="hidden" id="category" />
                                                    <div id="autocomplete-div"></div>
                                                </div>
                                            </td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                <span id="uom"></span>
                                            </td>
                                            <td class="text-center"><input type="number" size="2" id="qty" placeholder="Qty" class="form-control" /></td>
                                            <td class="text-center">
                                                <input type="button" class="btn btn-primary btn-md" value="Add" onClick="addInput('list_item');"/>
                                            </td>
                                        </tr>
                                    </table>
                                    <span class="form-text text-muted">* UoM is Unit of Measurement</span>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-right">Justification</label>
                                    <div class="col-md-6">
                                        <input type="file" name="justification" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary font-weight-bold">
                            <i class="fa fa-check"></i>
                            Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<style>
    .select2-results__options {
        max-height: 500px;
    }
</style>
@section('custom_script')
    <script src="{{asset('theme/assets/js/pages/crud/forms/widgets/typeahead.js?v=7.0.5')}}"></script>
    <link href="{{asset('theme/jquery-ui/jquery-ui.css')}}" rel="Stylesheet"></link>
    <script src="{{asset('theme/jquery-ui/jquery-ui.js')}}"></script>
    <script>
        $('#opt').hide();
        var cat;
        var srcItem = [];
        $('#form-add').submit(function () {
            var division = $.trim($('#division').val());
            var request_time = $.trim($('#request_time').val());
            var due_date = $.trim($('#due_date').val());
            var pr_cat = $.trim($('#pr_cat').val());
            var project = $.trim($('#project').val());
            var fr_note = $.trim($('#fr_note').val());

            if (division  === '') { alert('Division is mandatory.'); return false; }
            if (request_time  === '') { alert('Request Date is mandatory.'); return false; }
            if (due_date  === '') { alert('Due Date is mandatory.'); return false; }
            if (pr_cat  === '') { alert('Project Category is mandatory.'); return false; }
            if (project  === '') { alert('Project is mandatory.'); return false; }
            if (fr_note  === '') { alert('Note is mandatory.'); return false; }
        });

        $(document).ready(function(){
            $("#item").autocomplete({
                source: "{{route('fr.getItems')}}",
                minLength: 1,
                appendTo: "#autocomplete-div",
                select: function(event, ui) {
                    $('#category').val(ui.item.item_category);
                    $('#id').val(ui.item.item_id);
                    $('#code').val(ui.item.item_code);
                    $('#name').val(ui.item.item_name);
                    $('#uom').val(ui.item.item_uom);
                    $('#uom').html(ui.item.item_uom);
                }
            });
        });

        function deleteRow(o){
            var p = o.parentNode.parentNode;
            p.parentNode.removeChild(p);
        }
        function addInput(trName) {
            var newrow = document.createElement('tr');
            newrow.innerHTML = "<td align='center'>" +
                "<input type='hidden' name='id_item[]' value='" + $("#id").val() + "'>" +
                "<input type='hidden' name='code[]' value='" + $("#code").val() + "'>" + $("#code").val() +
                "</td>" +
                "<td align='center'>" +
                "<input type='hidden' name='name[]' value='" + $("#name").val() + "'><b>" + $("#name").val() + "</b><br /><em style='font-size:9px'>" + $("#category").val() + "</em>" +
                "</td>" +
                "<td align='center'>" +
                "<input type='hidden' name='uom[]' value='" + $("#uom").val() + "'>" + $("#uom").val() +
                "</td>" +
                "<td align='center'>" +
                "<input type='hidden' name='qty[]' value='" + $("#qty").val() + "'>" + $("#qty").val() +
                "</td>" +
                "<td align='center'>" +
                "<button type='submit' onClick='deleteRow(this)' class='btn btn-xs btn-danger'><i class='fa fa-trash'></i></button>" +
                "</td>";
            document.getElementById(trName).appendChild(newrow);
            $("#item").val("");
            $("#uom").html("");
            $("#qty").val("");
        }

        $(document).ready(function(){

            $("table.frwaiting").DataTable({
                fixedHeader: true,
                fixedHeader: {
                    headerOffset: 90
                },
                'ajax': '{{route('fr.getFrWaiting')}}',
                'type': 'GET',
                dataSrc: 'responseData',
                'columns' :[
                    { "data": "no" },
                    { "data": "req_date" },
                    { "data": "id_code" },
                    { "data": "req_by" },
                    { "data": "division" },
                    { "data": "project" },
                    { "data": "company" },
                    { "data": "items" },
                    { "data": "div_appr" },
                    { "data": "asset_appr" },
                    { "data": "deliv_status" },
                    { "data": "action" },
                ],
                'columnDefs': [
                    {
                        "targets": 0,
                        "className": "text-center",
                    },
                    {
                        "targets": 2,
                        "className": "text-center",
                    },
                    {
                        "targets": 3,
                        "className": "text-center",
                    },
                    {
                        "targets": 4,
                        "className": "text-center",
                    },
                    {
                        "targets": 6,
                        "className": "text-center",
                    },
                    {
                        "targets": 7,
                        "className": "text-center",
                    },
                    {
                        "targets": 8,
                        "className": "text-center",
                    },
                    {
                        "targets": 9,
                        "className": "text-center",
                    },
                    {
                        "targets": 10,
                        "className": "text-center",
                    },
                    {
                        "targets": 11,
                        "className": "text-center",
                    },

                ],
            });
            $("table.frbank").DataTable({
                fixedHeader: true,
                fixedHeader: {
                    headerOffset: 90
                },
                'ajax': '{{route('fr.getFrBank')}}',
                'type': 'GET',
                dataSrc: 'responseData',
                'columns' :[
                    { "data": "no" },
                    { "data": "req_date" },
                    { "data": "id_code" },
                    { "data": "req_by" },
                    { "data": "division" },
                    { "data": "project" },
                    { "data": "company" },
                    { "data": "items" },
                    { "data": "div_appr" },
                    { "data": "asset_appr" },
                    { "data": "deliv_status" },
                    { "data": "action" },
                ],
                'columnDefs': [
                    {
                        "targets": 0,
                        "className": "text-center",
                    },
                    {
                        "targets": 2,
                        "className": "text-center",
                    },
                    {
                        "targets": 3,
                        "className": "text-center",
                    },
                    {
                        "targets": 4,
                        "className": "text-center",
                    },
                    {
                        "targets": 6,
                        "className": "text-center",
                    },
                    {
                        "targets": 7,
                        "className": "text-center",
                    },
                    {
                        "targets": 8,
                        "className": "text-center",
                    },
                    {
                        "targets": 9,
                        "className": "text-center",
                    },
                    {
                        "targets": 10,
                        "className": "text-center",
                    },
                    {
                        "targets": 11,
                        "className": "text-center",
                    },

                ],
            });
            $("table.frreject").DataTable({
                fixedHeader: true,
                fixedHeader: {
                    headerOffset: 90
                },
                'ajax': '{{route('fr.getFrReject')}}',
                'type': 'GET',
                dataSrc: 'responseData',
                'columns' :[
                    { "data": "no" },
                    { "data": "req_date" },
                    { "data": "id_code" },
                    { "data": "req_by" },
                    { "data": "division" },
                    { "data": "project" },
                    { "data": "company" },
                    { "data": "items" },
                    { "data": "div_appr" },
                    { "data": "asset_appr" },
                    { "data": "action" },
                ],
                'columnDefs': [
                    {
                        "targets": 0,
                        "className": "text-center",
                    },
                    {
                        "targets": 2,
                        "className": "text-center",
                    },
                    {
                        "targets": 3,
                        "className": "text-center",
                    },
                    {
                        "targets": 4,
                        "className": "text-center",
                    },
                    {
                        "targets": 6,
                        "className": "text-center",
                    },
                    {
                        "targets": 7,
                        "className": "text-center",
                    },
                    {
                        "targets": 8,
                        "className": "text-center",
                    },
                    {
                        "targets": 9,
                        "className": "text-center",
                    },
                    {
                        "targets": 10,
                        "className": "text-center",
                    },

                ],
            });
        });

        $("#pr_cat").change(function(){
            cat = $("#pr_cat").val();
            $('#opt').show();
        });

        function getURLProject(){
            var url = "{{URL::route('fr.getProject',['cat' => ':id1'])}}";
            url = url.replace(':id1', cat);
            return url;
        }

        $('#project').select2({
            ajax: {
                url: function (params) {
                    return getURLProject()
                },
                type: "GET",
                placeholder: 'Choose Project',
                allowClear: true,
                dataType: 'json',
                data: function (params) {
                    return {
                        searchTerm: params.term,
                        "_token": "{{ csrf_token() }}",
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: false
            },
            width:"100%"
        })

    </script>
@endsection
@actionEnd
