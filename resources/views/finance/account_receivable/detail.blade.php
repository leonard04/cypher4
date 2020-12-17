@extends('layouts.template')

@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3>Invoice Detail</h3><br>
            </div>
            <div class="card-toolbar">
                @if($inv_detail->fin_approved_by != null)
                    <a href="{{route('ar.view_entry',['id' => $inv_detail->id,'act' => 'print'])}}" target="_blank" class="btn btn-xs btn-primary"><i class="fa fa-print"></i> Print Invoice</a>
                @endif
            </div>
        </div>

        <div class="card-body">
            <div class="card card-custom bg-primary m-5">
                <div class="separator separator-solid separator-white opacity-20"></div>
                <div class="card-body text-white">
                    <table class="text-white">
                        <tr>
                            <td><b>INVOICE NUMBER #</b></td>
                            <td>:</td>
                            <td><b>{{$inv_detail->no_inv}}</b></td>
                        </tr>
                        <tr>
                            <td>Invoice Date</td>
                            <td>:</td>
                            <td>{{date('d F Y', strtotime($inv_detail->date))}}</td>
                        </tr>
                        <tr>
                            <td>Contact</td>
                            <td>:</td>
                            <td>{{$client_pic}}</td>
                        </tr>
                        <tr>
                            <td>Project / Leads</td>
                            <td>:</td>
                            <td>{{$title_name}}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td>{{$client_address}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="separator separator-dashed separator-border-2 separator-primary"></div>
            @if($act != "view")
            <div class="row m-5">
                <div class="col-md-4 mx-auto">
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-9">
                                <select name="tax[]" multiple class="form-control select2" id="">
                                    @foreach($taxes as $tax)
                                        <option value="{{$tax->id}}" {{(in_array($tax->id, json_decode($inv_detail->taxes))) ? "SELECTED" : "" }}>{{$tax->tax_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-xs btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endif
            <div class="separator separator-dashed separator-border-2 separator-primary"></div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <form action="{{($act == "appr") ? ($inv_detail->fin_approved_by == null) ? route('ar.appr_manager') : route('ar.appr_finance') : route('ar.revise')}}" method="POST" id="form-entry">
                        @csrf
                        <table class="table table-responsive-xl">
                            <thead>
                            <tr class="border border-top-light">
                                <th class="text-center">Description</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Uom</th>
                                <th class="text-right">Unit Price</th>
                                <th class="text-right">Amount</th>
                            </tr>
                            </thead>
                            <tbody class="border border-light" id="tbody_clone">
                            @foreach($inv_prints as $key => $item)
                                <tr>
                                    <td>{{strip_tags($item->description)}}</td>
                                    <td align="center">{{$item->qty}}</td>
                                    <td align="center">{{$item->uom}}</td>
                                    <td align="right">{{number_format($item->unit_price, 2)}}</td>
                                    <td align="right">
                                        <label for="" class="amount">{{number_format($item->qty * $item->unit_price, 2)}}</label>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="4" align="right">Sub Total</td>
                                <td align="right">
                                    <label id="sub-total" class="col-form-label">{{number_format(0, 2)}}</label>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right">
                                    <label for="" class="col-form-label">Discount</label>
                                </td>
                                <td align="right">
                                    <input type="number" step=".01" value="{{$inv_detail->discount}}" readonly name="discount" class="form-control" style="width: 30%;text-align: end" id="discount">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right">Total</td>
                                <td align="right">
                                    <label id="total-net" class="col-form-label">{{number_format(0, 2)}}</label>
                                </td>
                            </tr>
                            @foreach(json_decode($inv_detail->taxes) as $key => $tax)
                                <tr>
                                    <td colspan="4" align="right"><label for="" class="col-form-label">{{$tax_name[$tax]}}</label></td>
                                    <td align="right">
                                        <label id="tax{{$tax}}" class="col-form-label">{{number_format(0, 2)}}</label>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" align="right"><label for="" class="col-form-label">Amount Payable</label></td>
                                <td align="right">
                                    <label id="payable" class="col-form-label">{{number_format(0, 2)}}</label>
                                </td>
                            </tr>
                            @if($act == "appr")
                                <tr>
                                    <td colspan="5">
                                        <label for="" class="col-form-label">Notes</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <textarea name="notes" id="notes" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @if($inv_detail->fin_approved_by != null)
                                <tr>
                                    <td colspan="5">
                                        <div class="alert alert-warning col-md-6">
                                            <i class="fa fa-info-circle text-white"></i> Approval of this invoice will result in addition of funds in the treasury
                                        </div>
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td colspan="5">
                                        <input type="hidden" name="id_detail" value="{{$inv_detail->id}}">
                                        <button type="button" id="btn-submit" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Approve</button>
                                    </td>
                                </tr>
                            @else
                                @if($inv_detail->fin_approved_by != null && $inv_detail->req_revise_date == null)
                                    <tr>
                                        <td colspan="5">
                                            <label for="" class="col-form-label">Notes</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <textarea name="notes" id="notes" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <input type="hidden" name="id_detail" value="{{$inv_detail->id}}">
                                            <button type="button" id="btn-submit" class="btn btn-success btn-xs"><i class="fa fa-recycle"></i> Revise</button>
                                        </td>
                                    </tr>
                                @endif
                            @endif
                            </tfoot>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_script')
    <script src="{{asset('theme/tinymce/jquery.tinymce.min.js')}}"></script>
    <script src="{{asset('theme/tinymce/tinymce.min.js')}}"></script>
    <script>
        $(document).ready(function(){

            init_tinymce("#description")
            init_tinymce("#notes")
            $("select.select2").select2({
                width: "100%"
            })

            $("#btn-submit").click(function(){
                Swal.fire({
                    title: "Submit",
                    text: "Are you sure you want to submit?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Submit",
                    cancelButtonText: "Cancel",
                    reverseButtons: true,
                }).then(function(result){
                    if(result.value){
                        $("#form-entry").submit()
                    }
                })
            })

            $("#btn-list").click(function(){
                $("select.select2").select2("destroy")
                tinymce.remove()
                var textareas = $("textarea.form-control").toArray()
                var tbody = $("#tbody_clone")
                var trLast = tbody.find("tr:last")
                var trNew = trLast.clone()
                trNew.find('input[type=number]').val('')
                trNew.find('input[type=text]').val('')
                trNew.find('input[type=number]').val('')
                var textarea = trNew.find('textarea')
                textarea.attr("id", "description"+textareas.length)
                trLast.after(trNew)
                $("select.select2").select2({
                    width: "100%"
                })
                $("textarea.form-control").each(function(){
                    init_tinymce("#"+$(this).attr('id'))
                })
            })


            $("table.display").DataTable()

            $("#disc-perc").keyup(function(){
                var disc = ($("#disc-perc").val()/100) * $("#sub-total").text()
                $("#discount").val(disc.toFixed(2))
                sum_amount()
            })

            $("#discount").keyup(function(){
                var disc = ($(this).val() / $("#sub-total").text()) * 100
                $("#disc-perc").val(disc.toFixed(1))
                sum_amount()
            })

            sum_amount()
        })

        function init_tinymce(description) {
            tinymce.init({
                selector:description,
                mode : "textarea",
                menubar: false,
                toolbar: false
            });
        }

        function calc(){
            var qty = $(".qty").toArray()
            var price = $(".price").toArray()
            var amount = $(".amount").toArray()
            for (let i = 0; i < qty.length; i++) {
                var sum = qty[i].value * price[i].value
                amount[i].innerHTML = sum.toFixed(2)
            }
            sum_amount()
        }

        function sum_amount(){
            var jsontaxformula = "{{json_encode($tax_formula)}}".replaceAll("&quot;", "\"")
            var taxformula = JSON.parse(jsontaxformula)
            var _jsontax = "{{$inv_detail->taxes}}".replaceAll("&quot;", "\"")
            var _tax = JSON.parse(_jsontax)

            var amount = $(".amount").toArray()
            var sub = 0;
            var am = 0;
            for (let i = 0; i < amount.length; i++) {
                sub += parseInt(amount[i].innerHTML.replaceAll(",", ""))
            }

            var disc = $("#discount").val()

            $("#sub-total").text(sub.toFixed(2))

            am = sub - disc

            $("#total-net").text(am.toFixed(2))


            for (let i = 0; i < _tax.length; i++) {
                var tx = document.getElementById("tax"+_tax[i])
                var $sum = am
                var tax_val = eval(taxformula[_tax[i]])
                tx.innerHTML = tax_val.toFixed(2)
                am += tax_val
            }
            console.log(formatter.format(am))
            $("#payable").text(am.toFixed(2))
        }
    </script>
@endsection
