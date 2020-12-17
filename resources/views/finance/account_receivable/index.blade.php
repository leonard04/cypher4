@extends('layouts.template')
@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <a href="#" class="text-black-50">Contract List</a>
            </div>
            <div class="card-toolbar">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addLeads"><i class="fa fa-plus"></i>Add Contract</button>
                </div>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <div class="alert alert-primary">
                <i class="fa fa-info-circle text-white"></i> Please note that invoices with No Client and red box will need the clients data to appear on printed invoice out.
            </div>
            <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <table class="table table-bordered table-hover display font-size-sm" style="margin-top: 13px !important; width: 100%;">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th nowrap="nowrap" class="text-left">Title</th>
                        <th nowrap="nowrap" class="text-center">Type</th>
                        <th nowrap="nowrap" class="text-center">Invoice Date</th>
                        <th nowrap="nowrap" class="text-center">Total Value (IDR)</th>
                        <th nowrap="nowrap" class="text-center">Remaining Value (IDR)</th>
                        <th nowrap="nowrap" class="text-center"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invs as $key => $value)
                        <tr>
                            <td align="center">{{$key + 1}}</td>
                            <td>
                                <a href="{{URL::route('ar.view', $value->id_inv)}}" class="text-hover-danger">
                                    {{(json_decode($value->title)->type == "project") ? $prj_name[json_decode($value->title)->id] : $leads_name[json_decode($value->title)->id]}}
                                </a>
                            </td>
                            <td align="center">{{(json_decode($value->title)->type == "project") ? strtoupper("project") : strtoupper("leads")}}</td>
                            <td align="center">
                                @if(empty($i_date[$value->id_inv]))
                                    -
                                @else
                                    <div class="accordion accordion-toggle-arrow" id="accordionExample2">
                                        <div class="card">
                                            <div class="card-header" id="headingOne2">
                                                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapse{{$key}}">
                                                    Invoice Date
                                                </div>
                                            </div>
                                            <div id="collapse{{$key}}" class="collapse" data-parent="#accordionExample2">
                                                <div class="card-body">
                                                    @foreach($i_date[$value->id_inv] as $key => $dates)
                                                       {{$i_activity[$value->id_inv][$key]}} : {{date('d M Y', strtotime($dates))}} <br>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <td align="center">
                                @if(!empty($i_value_d[$value->id_inv]))
                                    {{number_format(array_sum($i_value_d[$value->id_inv]), 2)}}
                                @else
                                    {{number_format(0, 2)}}
                                @endif
                            </td>
                            <td align="center">
                                @if(!empty($i_value_d[$value->id_inv]) && !empty($i_approved[$value->id_inv]))
                                    {{number_format(array_sum($i_value_d[$value->id_inv]) - array_sum($i_approved[$value->id_inv]), 2)}}
                                @else
                                    {{number_format(0, 2)}}
                                @endif
                            </td>
                            <td align="center">
                                <button class="btn btn-icon btn-xs btn-danger" onclick="button_delete({{$value->id_inv}})"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addLeads" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="addProject" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Contract</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form method="POST" action="{{URL::route('ar.add')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12" id="form-leads">
                                <br>
                                <h4>Contract Info</h4><hr>
                                <div class="form-group">
                                    <label>Client</label>
                                    <select name="client" class="form-control select2" required id="client">
                                        <option value="">Select Client</option>
                                        @foreach($clients as $client)
                                            <option value="{{$client->id}}">{{$client->company_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Project</label>
                                    <select name="project_leads" class="form-control select2" required id="pl">
                                        <option value="">Please select client first</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Invoice Code</label>
                                    <input type="text" class="form-control" name="inv_code" required>
                                </div>
                                <div class="form-group">
                                    <div class="alert alert-info">
                                        <i class="fa fa-info-circle text-white"></i> Invoice code will be include in Invoice Number
                                        <br>e.g 001/INV-{{Session::get('company_tag')}}/[invoice_code]/X/2020
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                        <button type="submit" id="btn-save-leads" class="btn btn-primary font-weight-bold">
                            <i class="fa fa-check"></i>
                            Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('custom_script')
    <script>

        function button_delete(x){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url : "{{URL::route('ar.delete')}}/" + x,
                        type: "get",
                        dataType: "json",
                        cache: "false",
                        success: function(response){
                            if (response.error == 0){
                                location.reload()
                            } else {
                                Swal.fire('Error occured', 'Please contact your administrator!', 'error')
                            }
                        }
                    })
                }
            })
        }

        $(document).ready(function () {
            $("select.select2").select2({
                width: "100%"
            })

            $("#btn-save-leads").click(function(){
                console.log('submit cok')
            })

            $("#client").change(function(){
                var selected = $("#client option:selected").val()
                $.ajax({
                    url: "{{route('ar.getpl')}}/"+selected,
                    type: "GET",
                    dataType: "json",
                    cache: false,
                    success:function(response){
                        console.log(response)
                        $("#pl").val(null).trigger('change')
                        $("#pl").empty()
                        $("#pl").append("<option value=''>Select Project</option>")
                        $("#pl").select2({
                            data: response.results,
                            width: "100%"
                        })
                    }
                })
            })

            $("#pl").change(function(){
                var selected = $("#pl option:selected").val()
                $.ajax({
                    url: "{{route('ar.check_inv')}}/" + selected,
                    type: "GET",
                    dataType: "json",
                    cache: false,
                    success: function(response){
                        if (response > 0){
                            Swal.fire('Data Exist', "Please select for other project", 'warning')
                            $("#btn-save-leads").attr("disabled", true)
                        } else {
                            $("#btn-save-leads").attr("disabled", false)
                        }
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
        })


    </script>
@endsection
