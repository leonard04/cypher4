@if(!(session()->has('seckey_payroll')) || (session()->has('seckey_payroll') < 10))
    <script>window.location = "{{route('payroll.needsec')}}";</script>
@endif
@extends('layouts.template')

@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3>Payroll</h3><br>

            </div>
            <div class="card-toolbar">

                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <div class="col-md-8 mx-auto">
                <form method="post" action="{{URL::route('payroll.export')}}" id="form-export" target="_blank">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-2">
                            <select name="type" id="type" class="form-control">
                                @foreach($type as $key => $value)
                                    <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="month" id="month" class="form-control">
                                @foreach($month as  $key => $value)
                                    <option value="{{$key}}" {{($key == date('m')) ? "selected" : ""}}>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="years" id="year" class="form-control">
                                @foreach($years as $value)
                                    <option value="{{$value}}" {{($value == date('Y')) ? "selected" : ""}}>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <button type="button" id="btnSeacrh" class="btn btn-primary btn-xs"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <button type="button" id="btnExport" class="btn btn-primary btn-xs"><i class="fa fa-file-export"></i> Export</button>
                        <a id="btnPrint" class="btn btn-info ml-5 btn-xs"><i class="fa fa-print"></i> Print Bank Transfer</a>
                        <button type="button" id="btnUpdateArch" class="btn ml-5 btn-danger btn-xs"><i class="fa flaticon-refresh"></i> Refresh</button>
                    </div>
                </form>
            </div>

            <!-- Table Payroll -->
            <div id="table-payroll">
                <table id="table-display" class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th class="text-center" colspan="21">
                                Data Source : <span id="title-table"></span>
                            </th>
                        </tr>
                        <tr>
                            <th class="text-center" rowspan="2">No.</th>
                            <th rowspan="2">Name/Position</th>
                            <th class="text-center" rowspan="2">Salary *)</th>
                            <th class="text-center" colspan="3">Overtime </th>
                            <th class="text-center" colspan="3">Activity</th>
{{--                            <th class="text-center" colspan="3">Warehouse</th>--}}
{{--                            <th class="text-center" colspan="3">ODO</th>--}}
                            <th class="text-center" rowspan="2">Allowance<br />BPJS-TK<br />BPJS-Kes<br />JSHK</th>
                            <th class="text-center" rowspan="2">Voucher</th>
                            <th class="text-center" rowspan="2">Total<br>Salary</th>
                            <th class="text-center" colspan="3">Deduction</th>
                            <th class="text-center" rowspan="2">Deduction<br />BPJS-TK<br />BPJS-Kes<br />JSHK</th>
                            <th class="text-center" rowspan="2">Bonus</th>
                            <th class="text-center" rowspan="2">THR</th>
                            <th class="text-center" rowspan="2">PPH21</th>
                            <th class="text-center" rowspan="2">Proportional</th>
                            <th class="text-center" rowspan="2">THP</th>
                        </tr>
                        <tr>
                            <th class="text-center">Rate</th>
                            <th class="text-center">Hours</th>
                            <th class="text-center">Total</th>
{{--                            <th class="text-center">Rate</th>--}}
{{--                            <th class="text-center">Days</th>--}}
{{--                            <th class="text-center">Total</th>--}}
{{--                            <th class="text-center">Rate</th>--}}
{{--                            <th class="text-center">Days</th>--}}
{{--                            <th class="text-center">Total</th>--}}
                            <th class="text-center">Rate</th>
                            <th class="text-center">Days</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Sanction</th>
                            <th class="text-center">Absence</th>
                            <th class="text-center">Loan</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" align="right">
                                <b>Total :</b>
                            </td>
                            <td align="right"></td>
                            <td align="right"></td>
{{--                            <td align="right"></td>--}}
{{--                            <td align="right"></td>--}}
{{--                            <td align="right"></td>--}}
{{--                            <td align="right"></td>--}}
{{--                            <td align="right"></td>--}}
{{--                            <td align="right"></td>--}}
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                            <td align="right"></td>
                        </tr>
                        <tr>
                            <td colspan="27">
                                <div class='alert alert-warning'>
                                    Note:
                                    <ul>
                                        <li><sup><small>*)</small></sup>Salary column is sum of basic salary basic salary + health allowance + transport allowance + meal allowance + house allowance + position allowance. </li>
                                        <li>The calculation of basic salary is started from the 16th to the 15th of the following month</li>
                                        <li>ODO (One Day Off) On at Off time</li>
                                        <li>The amount of overtime is the result of rounding up per hour</li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="27">
                                <div id="table-signature"></div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('custom_script')
    <script>
        $(document).ready(function(){

            $("#table-payroll").hide()
            $("#btnPrint").hide()
            $("#btnUpdateArch").hide()

            $("#btnExport").click(function(){
                $("#form-export").submit()
            })

            $("#btnUpdateArch").click(function () {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // do the remove
                        var t = $("#type option:selected").val()
                        var m = $("#month option:selected").val()
                        var y = $("#year option:selected").val()
                        $.ajax({
                            url: "{{route('payroll.update')}}",
                            type: "post",
                            dataType: "json",
                            data: {
                                "_token" : "{{csrf_token()}}",
                                'type': t,
                                'month': m,
                                'years': y,
                            },
                            cache: false,
                            success: function(response){
                                if (response.error == 0){
                                    $("#btnSeacrh").click()
                                } else {
                                    Swal.fire('Error Occured', 'Please contact your system administrator', 'error')
                                }
                            }
                        })
                    }
                })
            })

            $("#btnSeacrh").click(function(){
                var t = $("#type option:selected").val()
                var m = $("#month option:selected").val()
                var y = $("#year option:selected").val()
                Swal.fire({
                    title: "Loading Data",
                    timer: 1000,
                    onOpen: function() {
                        Swal.showLoading()
                    }
                }).then(function(result) {
                    if (result.dismiss === "timer") {
                        $.ajax({
                            url: "{{URL::route('payroll.show')}}",
                            type: 'POST',
                            dataType: 'json',
                            cache: false,
                            data: {
                                'type': t,
                                'month': m,
                                'years': y,
                                '_token': '{{csrf_token()}}',
                            },
                            success: function(response){
                                console.log(response.data)
                                if (response.error == 0) {
                                    var datafoot = response.footer;
                                    $("#table-payroll").fadeIn()
                                    $("#btnPrint").show()
                                    $("#btnPrint").attr('href', "{{route('payroll.print_btl')}}?act=remarks&t="+t+"&m="+m+"&y="+y+"")
                                    $('#table-display').DataTable().clear();
                                    $('#table-display').DataTable().destroy();
                                    $("#table-display").DataTable({
                                        "data" : response.data,
                                        paging: false,
                                        dom: 'Bfrtip',
                                        fixedHeader: true,
                                        fixedHeader: {
                                            headerOffset: 90
                                        },
                                        buttons : [
                                            { extend: 'excelHtml5', footer: true },
                                            { extend: 'csvHtml5', footer: true }
                                        ],
                                        'footerCallback' : function(tfoot, data, start, end, display) {
                                            var resp = datafoot
                                            console.log(datafoot)
                                            if (resp) {
                                                var td = $(tfoot).find('td')
                                                td.eq(1).html(currencyFormat(resp.sum_salary))
                                                td.eq(4).html(currencyFormat(resp.sum_ovt))
                                                td.eq(7).html(currencyFormat(resp.sum_fld))
                                                // td.eq(10).html(currencyFormat(resp.sum_wh))
                                                // td.eq(13).html(currencyFormat(resp.sum_odo))
                                                td.eq(8).html(currencyFormat(resp.sum_tk) + "<br>" + currencyFormat(resp.sum_ks) + "<br>" + currencyFormat(resp.sum_jshk))
                                                td.eq(9).html(currencyFormat(resp.sum_voucher))
                                                td.eq(10).html(currencyFormat(resp.sum_tot_salary))
                                                td.eq(11).html(currencyFormat(resp.sum_sanction))
                                                td.eq(13).html(currencyFormat(resp.sum_loan))
                                                td.eq(14).html(currencyFormat(resp.sum_ded_tk) + "<br>" + currencyFormat(resp.sum_ded_ks) + "<br>" + currencyFormat(resp.sum_ded_jshk))
                                                td.eq(15).html(currencyFormat(resp.sum_bonus))
                                                td.eq(16).html(currencyFormat(resp.sum_thr))
                                                td.eq(17).html(currencyFormat(resp.sum_pph21))
                                                td.eq(18).html(currencyFormat(resp.sum_prop))
                                                td.eq(19).html(currencyFormat(resp.sum_thp))
                                            }
                                        },
                                        "columnDefs": [{
                                            targets : [2, 3, 5, 6, 8, 9, 11, 12, 14, 15, 16, 17, 18, 19, 20],
                                            className: 'text-right',
                                        }]
                                    })
                                    if (response.source == "Archive"){
                                        $("#btnUpdateArch").show()
                                    }
                                    $("#title-table").text(response.source)
                                    $("#table-signature").html(response.table_signature)
                                } else {
                                    $("#table-payroll").fadeIn()
                                    $('#table-display').DataTable().clear();
                                    $('#table-display').DataTable().destroy();
                                    $("#table-display").DataTable()
                                }
                            }
                        })
                    }
                })
            })
        })
        function currencyFormat(num) {
            return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }
    </script>
@endsection

