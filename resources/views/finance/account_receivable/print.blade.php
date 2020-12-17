@extends('layouts.template')

@section('content')
    <style type="text/css">
        @media print
        {
            body * { visibility: hidden; }
            .print * { visibility: visible; }
            .notprint * { visibility: hidden; }
        }
    </style>
<div class="print">
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!-- begin::Card-->
            <div class="card card-custom overflow-hidden">
                <div class="card-body p-0">
                    <!-- begin: Invoice-->
                    <!-- begin: Invoice header-->
                    <div class="row justify-content-center py-8 px-8 py-md-27 px-md-0">
                        <div class="col-md-9">
                            <div class="d-flex justify-content-between pb-10 pb-md-20 flex-column flex-md-row">
                                <h1 class="display-4 font-weight-boldest mb-10">INVOICE</h1>
                                <div class="d-flex flex-column align-items-md-end px-0">
                                    <!--begin::Logo-->
                                    <a href="#" class="mb-5">
                                        <img src="{{str_replace("public", "public_html", asset('images/'.\Session::get('company_app_logo')))}}" class="h-md-100px" alt="" />
                                    </a>
                                    <!--end::Logo-->
                                    <span class="d-flex flex-column align-items-md-end opacity-70">
                                        <span>{{Session::get('company_name_parent')}}</span>
                                        <span>{{Session::get('company_address')}}</span>
                                    </span>
                                </div>
                            </div>
                            <div class="border-bottom w-100"></div>
                            <div class="d-flex justify-content-between pt-6">
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">Issue Date</span>
                                    <span class="opacity-70">{{date('d M Y', strtotime($inv_detail->date))}}</span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">INVOICE NO.</span>
                                    <span class="opacity-70"><b>{{$inv_detail->no_inv}}</b></span>
                                </div>
                                <div class="d-flex flex-column flex-root">
                                    <span class="font-weight-bolder mb-2">INVOICE TO.</span>
                                    <span class="opacity-70">{{strtoupper($data_client->company_name)}}
														<br />{{$data_client->address}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice header-->
                    <!-- begin: Invoice body-->
                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-9">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="pl-0 font-weight-bold text-muted text-uppercase">Description</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">Quantity</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">UoM</th>
                                        <th class="text-right font-weight-bold text-muted text-uppercase">Unit Price</th>
                                        <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($inv_prints as $key => $item)
                                        <tr class="font-weight-boldest font-size-lg">
                                            <td class="pl-0 pt-7">{{strip_tags($item->description)}}</td>
                                            <td class="text-right pt-7">{{$item->qty}}</td>
                                            <td class="text-right pt-7">{{$item->uom}}</td>
                                            <td class="text-right pt-7">{{number_format($item->unit_price, 2)}}</td>
                                            <td class="text-danger pr-0 pt-7 text-right">
                                                <label for="" class="amount">{{number_format($item->qty * $item->unit_price, 2)}}</label>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr class="font-weight-boldest font-size-lg">
                                        <td colspan="4" class="text-right">Sub Total</td>
                                        <td class="text-right">
                                            <label id="sub-total" class="col-form-label">{{number_format(0, 2)}}</label>
                                        </td>
                                    </tr>
                                    <tr class="font-weight-boldest font-size-lg">
                                        <td colspan="4" class="text-right">
                                            <label for="" class="col-form-label">Discount</label>
                                        </td>
                                        <td class="text-right">
                                            <label id="discount" class="col-form-label">{{$inv_detail->discount}}</label>
                                        </td>
                                    </tr>
                                    <tr class="font-weight-boldest font-size-lg">
                                        <td colspan="4" class="text-right">Total</td>
                                        <td class="text-right">
                                            <label id="total-net" class="col-form-label">{{number_format(0, 2)}}</label>
                                        </td>
                                    </tr>
                                    @foreach(json_decode($inv_detail->taxes) as $key => $tax)
                                        <tr class="font-weight-boldest font-size-lg">
                                            <td colspan="4" class="text-right">{{$tax_name[$tax]}}</td>
                                            <td align="right">
                                                <label id="tax{{$tax}}" class="col-form-label">{{number_format(0, 2)}}</label>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice body-->
                    <!-- begin: Invoice footer-->
                    <div class="row justify-content-center bg-gray-100 py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-9">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="font-weight-bold text-muted text-uppercase">BANK</th>
                                        <th class="font-weight-bold text-muted text-uppercase">ACC.NO.</th>
                                        <th class="font-weight-bold text-muted text-uppercase">DUE DATE</th>
                                        <th class="font-weight-bold text-muted text-uppercase" colspan="2">TOTAL AMOUNT</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="font-weight-bolder">
                                        <td>{{$payment_account->source}}</td>
                                        <td>{{$payment_account->account_number}}</td>
                                        <td>{{date("d M Y", strtotime(date("Y-m-d", strtotime($inv_detail->date)) . "+1 month"))}}</td>
                                        <td class="text-danger font-size-h3 font-weight-boldest">
                                            <span class="font-size-h2 font-weight-boldest text-danger mb-1" id="payable"></span>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice footer-->
                    <!-- begin: Invoice action-->
                    <div class="row justify-content-center py-8 px-8 py-md-10 px-md-0">
                        <div class="col-md-9">
                            <div class="d-flex justify-content-between notprint">
                                <button type="button" class="btn btn-primary font-weight-bold" onclick="window.print();">Print Invoice</button>
                            </div>
                        </div>
                    </div>
                    <!-- end: Invoice action-->
                    <!-- end: Invoice-->
                </div>
            </div>
            <!-- end::Card-->
        </div>
        <!--end::Container-->
    </div>
</div>

@endsection
@section('custom_script')
    <script type="text/javascript">
        $(document).ready(function(){
            sum_amount()
        })
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


            $("#payable").text(am.toFixed(2))
        }
    </script>
@endsection
