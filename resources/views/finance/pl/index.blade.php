@extends('layouts.template')
@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                Profit & Loss
            </div>
            <div class="card-toolbar">

                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 mx-auto row">
                    <div class="col-md-4">
                        <input type="date" id="start-date" class="form-control mr-3" value="{{date('Y')."-01-01"}}">
                    </div>
                    <div class="col-md-4">
                        <input type="date" id="end-date" class="form-control" value="{{date('Y')."-".date('m')."-".date('t')}}">
                    </div>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" id="btn-search" class="btn btn-primary" ><i class="fa fa-search"></i>Search</button>
                        <button type="button" id="btn-search" class="btn btn-light-dark ml-2" data-toggle="modal" data-target="#modalSetting"><i class="fa fa-cog"></i></button>
                    </div>
                </div>
            </div>
            <div class="row mt-10">
                <div class="col-md-8 mx-auto">
                    <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <table class="table table-bordered table-hover display font-size-sm" id="table-data" style="margin-top: 13px !important; width: 100%;">
                            <thead>
                            <tr>
                                <th nowrap="nowrap" class="text-left">Code</th>
                                <th nowrap="nowrap" class="text-center">Value</th>
                                <th nowrap="nowrap" class="text-center">Type</th>
                                <th nowrap="nowrap" class="text-center">Total</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalSetting" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Profit & Loss Setting</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form method="post" action="{{URL::route('pl.setting')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <hr>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-right">Operating Income</label>
                            <div class="col-md-9">
                                <select name="oi[]" class="form-control select2" multiple id="" required>
                                    <option value="">&nbsp;</option>
                                    @foreach($coa as $value)
                                        <option value="{{$value->id}}"
                                                @if($setting != null)
                                                    @foreach(json_decode($setting->operating_income) as $item)
                                                        {{($item == $value->id) ? "SELECTED" : ""}}
                                                    @endforeach
                                                @endif
                                        >{{"[".$value->code."] ".$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-right">Operating Expense</label>
                            <div class="col-md-9">
                                <select name="oe[]" class="form-control select2" multiple id="" required>
                                    <option value="">&nbsp;</option>
                                    @foreach($coa as $value)
                                        <option value="{{$value->id}}"
                                            @if($setting != null)
                                                @foreach(json_decode($setting->operating_expense) as $item)
                                                    {{($item == $value->id) ? "SELECTED" : ""}}
                                                @endforeach
                                            @endif
                                        >{{"[".$value->code."] ".$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-right">Other Incomes</label>
                            <div class="col-md-9">
                                <select name="oti[]" class="form-control select2" multiple id="" required>
                                    <option value="">&nbsp;</option>
                                    @foreach($coa as $value)
                                        <option value="{{$value->id}}"
                                            @if($setting != null)
                                                @foreach(json_decode($setting->other_income) as $item)
                                                    {{($item == $value->id) ? "SELECTED" : ""}}
                                                @endforeach
                                            @endif
                                        >{{"[".$value->code."] ".$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-right">Other Expenses</label>
                            <div class="col-md-9">
                                <select name="ote[]" class="form-control select2" multiple id="" required>
                                    <option value="">&nbsp;</option>
                                    @foreach($coa as $value)
                                        <option value="{{$value->id}}"
                                            @if($setting != null)
                                                @foreach(json_decode($setting->other_expense) as $item)
                                                    {{($item == $value->id) ? "SELECTED" : ""}}
                                                @endforeach
                                            @endif
                                        >{{"[".$value->code."] ".$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-right">Tax</label>
                            <div class="col-md-9 col-form-label">
                                <div class="radio-inline">
                                    <label class="radio radio-rounded">
                                        <input type="radio" value="25" {{($setting != null && $setting->tax == 25) ? "checked" : ""}} name="tax"/>
                                        <span></span>
                                        25 %
                                    </label>
                                    <label class="radio radio-rounded">
                                        <input type="radio" value="0.5" {{($setting != null && $setting->tax == 0.5) ? "checked" : ""}} name="tax"/>
                                        <span></span>
                                        0.5 %
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div id="coa-target"></div>
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
@section('custom_script')
    <link href="{{asset('theme/jquery-ui/jquery-ui.css')}}" rel="Stylesheet">
    <script src="{{asset('theme/jquery-ui/jquery-ui.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#table-data').DataTable({
                'searching' : false,
                'paging': false,
                'ordering': false,
                "responsive": true,
                "bInfo" : false,
                "columnDefs": [
                    { "visible": false, "targets": 2 }
                ],
                fixedHeader: true,
                fixedHeader: {
                    headerOffset: 90
                }
            })

            $("#btn-search").click(function(){
                $.ajax({
                    url: "{{route('pl.find')}}",
                    type: "post",
                    dataType: "json",
                    cache: false,
                    data: {
                        "_token" : "{{csrf_token()}}",
                        'start' : $("#start-date").val(),
                        'end' : $("#end-date").val(),
                    },
                    success: function(response){
                        $('#table-data').DataTable().clear();
                        $('#table-data').DataTable().destroy();
                        console.log(response)
                        var t = $('#table-data').DataTable({
                            'searching' : false,
                            'paging': false,
                            'ordering': false,
                            'data': response.data,
                            "bInfo" : false,
                            "columnDefs": [
                                { "visible": false, "targets": 2 },
                                {
                                    'targets': [1, 3],
                                    'className': "text-right"
                                }
                            ],
                            "drawCallback": function ( settings ) {
                                var api = this.api();
                                var rows = api.rows( {page:'current'} ).nodes();
                                var last=null;

                                api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                                    if ( last !== group ) {
                                        $(rows).eq( i ).before(
                                            '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                                        )

                                        last = group
                                    }
                                } )
                            },
                        })
                    }
                })
            })

            $("#modalSetting select.select2").select2({
                width: "100%"
            })

            var val = []
            val['data'] = src

            console.log(val)

            console.log(hisdata)

        });

        function loop_data(t, arguments){
            for (const argumentsKey in arguments) {
                var sum = 0
                for (let i = 0; i < arguments[argumentsKey].amount.length; i++) {
                    sum += parseInt(arguments[argumentsKey].amount[i])
                }

                t.row.add([
                    arguments[argumentsKey].code,
                    sum.toFixed(2),
                    ''
                ]).draw(false)
            }
        }
    </script>
@endsection
