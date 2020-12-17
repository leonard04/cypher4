@extends('layouts.template')

@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3>Schedule Payment</h3><br>

            </div>
            <div class="card-toolbar">

                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <div class="col-md-8 mx-auto">
                <form method="post" action="{{URL::route('sp.index')}}" id="form-export">
                    @csrf
                    <div class="form-group row">
                        <label for="" class="col-md-2 col-form-label text-right">Select Periode </label>
                        <div class="col-md-2">
                            <select name="month" id="month" class="form-control">
                                @foreach($data['month'] as  $key => $value)
                                    <?php
                                        if ($data['m'] != ""){
                                            $selected = ($key == $data['m']) ? "selected" : "";
                                        } else {
                                            $selected = ($key == date('m')) ? "selected" : "";
                                        }
                                    ?>
                                    <option value="{{$key}}" {{$selected}}>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="years" id="year" class="form-control">
                                @foreach($data['years'] as $value)
                                    <?php
                                    if ($data['y'] != ""){
                                        $selected = ($value == $data['y']) ? "selected" : "";
                                    } else {
                                        $selected = ($value == date('Y')) ? "selected" : "";
                                    }
                                    ?>
                                    <option value="{{$value}}" {{$selected}}>{{$value}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" name="search" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                            @if(isset($data['find']))
                            <button type="button" id="switch-btn" class="btn btn-info btn-icon"><i class="fa fa-calendar" id="fa-switch"></i></button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            <!-- Table Payroll -->
            @if(isset($data['find']))
                <div id="table-payroll">
                    <table class="table display table-responsive-xl table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Paper</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Amount</th>
                        <th class="text-center">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($val as $key => $item)
                            <tr bgcolor="{{$item['bgcolor']}}" {{--{{($item['status'] == 1) ? "style=display:none" : ""}}--}} class="text-white">
                                <td align="center"></td>
                                <td>{{date('d F Y', strtotime($item['date']))}} </td>
                                <td>{{($item['paper'] != null) ? $item['paper'] : $item['description']}} <button type="button" onclick="edit_date('{{$item['type']}}', '{{$item['id']}}', '{{$item['date']}}')" class="btn btn-xs btn-primary btn-icon"><i class="fa fa-calendar-check"></i></button></td>
                                <td>{{($item['paper'] != null) ? $item['description'] : ""}}</td>
                                <td>{{number_format($item['amount'], 2)}}</td>
                                <td align="center">
                                    @if($item['status'] == 1)
                                        <span class="label label-inline label-success">PAID</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                <div class="row" id="calendar-view">
                    <div class="col-md-12">
                        <table class="table display table-responsive-xl table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" colspan="{{date('t', strtotime($data['y']."-".$data['m'])) + 1}}">{{date('F', strtotime($data['y']."-".$data['m'])).", ".$data['y']}}</th>
                                </tr>
                                <tr>
                                    @for($i = 1; $i <= date('t', strtotime($data['y']."-".$data['m'])); $i++)
                                        <th class="text-center">{{$i}}</th>
                                    @endfor
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sum = array();
                            $paid = array();
                            ?>
                            @foreach($val as $key => $item)
                                <tr>
                                    @for($i = 1; $i <= date('t', strtotime($data['y']."-".$data['m'])); $i++)
                                        <th class="text-right" {{($item['status'] == 1) ? "style=display:none" : ""}} {{(strtotime($data['y']."-".$data['m']."-".$i) == strtotime($item['date'])) ? "style=background-color:".$item['bgcolor'].";min-width:110px;" : ""}}>
                                            @if(strtotime($data['y']."-".$data['m']."-".$i) == strtotime($item['date']))
                                                <div>
                                                    <span class="label label-inline label-secondary">{{$i}}</span>
                                                </div>
                                                <div class="mt-3">
                                                    @if($item['status'] == 1)
                                                        <span class="label label-inline label-success">PAID</span>
                                                    @endif
                                                </div>
                                                <?php
                                                if ($item['status'] == 1){
                                                    $paid[$i][] = 1;
                                                } else {
                                                    $paid[$i][] = 0;
                                                }
                                                ?>
                                                <div class="mt-3">
                                                    <button type="button" onclick="edit_date('{{$item['type']}}', '{{$item['id']}}', '{{$item['date']}}')" class="btn btn-xs btn-primary btn-icon"><i class="fa fa-calendar-check"></i></button>
                                                </div>
                                                <br>
                                                {{$item['paper']}}<br>
                                                {{number_format($item['amount'], 2)}}
                                                <?php
                                                $sum[$i][] = $item['amount'];
                                                ?>
                                            @endif
                                        </th>
                                    @endfor
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    @for($i = 1; $i <= date('t', strtotime($data['y']."-".$data['m'])); $i++)
                                        <th class="text-center">
                                            @if(isset($sum[$i]))
                                                {{number_format(array_sum($sum[$i]), 2)}}
                                            @endif
                                        </th>
                                    @endfor
                                </tr>
                                <tr>
                                    @for($i = 1; $i <= date('t', strtotime($data['y']."-".$data['m'])); $i++)
                                        <th class="text-center">
                                            @if(isset($sum[$i]))
                                                @if(array_sum($paid[$i]) == count($paid[$i]))
                                                    <a href='' class='btn btn-primary btn-xs font-size-sm mt-2'><i class='fa fa-history'></i> History</a>
                                                @else
                                                    <a href='{{URL::route('sp.pay', $data['y']."-".$data['m']."-".$i)}}' class='btn btn-success btn-xs font-size-sm'><i class='fa fa-check'></i> Pay</a>
                                                    @if(array_sum($paid[$i]) > 0)
                                                        <a href='' class='btn btn-primary btn-xs font-size-sm mt-2'><i class='fa fa-history'></i> History</a>
                                                    @endif
                                                @endif
                                            @endif
                                        </th>
                                    @endfor
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="modal fade" id="editDate" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Date</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <hr>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label text-right">Change Date</label>
                        <div class="col-md-9">
                            <input type="date" class="form-control" placeholder="Item Name" name="date" id="date_item" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="type" id="type">
                    <input type="hidden" name="id_item" id="id_item">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                    <button type="button" name="submit" id="btn-submit" class="btn btn-primary font-weight-bold">
                        <i class="fa fa-check"></i>
                        Edit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_script')
    <script>
        function edit_date(type, id, date){
            $("#editDate").modal('show')
            $("#date_item").val(date)
            $("#type").val(type)
            $("#id_item").val(id)
        }
        $(document).ready(function(){
            $("#btn-submit").click(function () {
                $.ajax({
                    url: "{{URL::route('sp.edit_date')}}",
                    type: "post",
                    dataType: "json",
                    cache: false,
                    data: {
                        "_token" : "{{csrf_token()}}",
                        "id_item" : $("#id_item").val(),
                        "type" : $("#type").val(),
                        "date_item" : $("#date_item").val()
                    },
                    success: function (response) {
                        let timerInterval
                        Swal.fire({
                            title: 'Wait for a second!',
                            html: 'Processing',
                            timer: 1000,
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            timerProgressBar: true,
                            willOpen: () => {
                                Swal.showLoading()
                                timerInterval = setInterval(() => {
                                    const content = Swal.getContent()
                                    if (content) {
                                        const b = content.querySelector('b')
                                        if (b) {
                                            b.textContent = Swal.getTimerLeft()
                                        }
                                    }
                                }, 100)
                            },
                            onClose: () => {
                                clearInterval(timerInterval)
                                location.reload()
                            }
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                location.reload()
                            }
                        })
                    }
                })
            })
            init_table()

            var panel = 1;

            $("#calendar-view").hide()



            $("#switch-btn").click(function(){
                var i = $("#fa-switch")
                console.log(i)
                if (panel === 1){
                    i.removeClass("fa-calendar")
                    i.addClass("fa-list")
                    $("#calendar-view").show()
                    $("#table-payroll").hide()
                    init_calendar()
                    $("#table-payroll table.display").DataTable().destroy()
                    panel = 2
                } else {
                    i.removeClass("fa-list")
                    i.addClass("fa-calendar")
                    $("#calendar-view").hide()
                    $("#table-payroll").show()
                    init_table()
                    $("#calendar-view table.display").DataTable().destroy()
                    panel = 1
                }
            })


            $("#btnExport").click(function(){
                $("#form-export").submit()
            })


        })

        function init_table() {
            $("#table-payroll table.display").DataTable().destroy()
            var t = $("#table-payroll table.display").DataTable({
                "columnDefs": [ {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                } ],
                fixedHeader: true,
                fixedHeader: {
                    headerOffset: 90
                },
                "aaSorting" : [[ 1, "asc" ]],
                rowGroup: {
                    startRender: null,
                    endRender: function ( rows, group ) {
                        console.log(group)
                        var salaryAvg = rows
                            .data()
                            .pluck(4)
                            .reduce( function (a, b) {
                                return a + b.replace(/[,]/g, '')*1;
                            }, 0);
                        salaryAvg = $.fn.dataTable.render.number(',', '.', 2, '').display( salaryAvg );
                        var tes = rows
                            .data()
                            .pluck(5)

                        var isPaid = []
                        var btnHistory = "<br><a href='' class='btn btn-primary btn-xs font-size-sm mt-2'><i class='fa fa-history'></i> History</a>"

                        for (let i = 0; i < tes.length; i++) {
                            if (tes[i] != null && tes[i] != ""){
                                isPaid[i] = 1;
                            } else {
                                isPaid[i] = 0;
                            }
                        }

                        console.log(isPaid)
                        var paid = isPaid.reduce(function(a, b){
                            return a + b
                        })

                        var date = formatDate(group)

                        if (paid == isPaid.length){
                            var btnPay = ""
                            var btnHistory = "<br><a href='' class='btn btn-primary btn-xs font-size-sm mt-2'><i class='fa fa-history'></i> History</a>"
                        } else if(paid < isPaid.length){
                            var btnPay = "<a href='{{URL::route('sp.pay')}}/"+date+"' class='btn btn-success btn-xs font-size-sm'><i class='fa fa-check'></i> Pay</a>"
                            var btnHistory = ""
                        } else {
                            var btnPay = "<a href='{{URL::route('sp.pay')}}/"+date+"' class='btn btn-success btn-xs font-size-sm'><i class='fa fa-check'></i> Pay</a>"
                            var btnHistory = ""
                        }


                        return $('<tr/>')
                            .append( '<td colspan="4">Total Payment for '+group+'</td>' )
                            .append( '<td>'+salaryAvg+'</td>' )
                            .append( "<td align='center'>"+btnPay + btnHistory +"</td>")
                    },
                    dataSrc: 1
                }
            })
            t.on( 'order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
        }

        function init_calendar() {
            $("#calendar-view table.display").DataTable().destroy()
            $("#calendar-view table.display").DataTable({
                ordering: false,
                fixedHeader: true,
                fixedHeader: {
                    headerOffset: 90,
                    heeader: true
                },
            })
        }

        function currencyFormat(num) {
            return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }

        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('-');
        }
    </script>
@endsection

