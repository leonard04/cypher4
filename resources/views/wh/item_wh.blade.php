@extends('layouts.template')

@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3>Item List - <span class="text-primary"><strong>{{$wh->name}}</strong></span></h3><br>
            </div>
            <div class="card-toolbar">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{route('wh.index')}}" class="btn btn-xs btn-success ml-3"><i class="fa fa-arrow-left"></i></a>
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
                    <th class="text-left">Item Name</th>
                    <th class="text-left">Category</th>
                    <th class="text-left">Type</th>
                    <th class="text-center">Code</th>
                    <th class="text-center">Stock in Warehouse</th>
                    <th class="text-center">Company</th>
                </tr>
                </thead>
                <tbody>
                @for($i=0;$i<count($itemsId); $i++)
                    <tr>
                        <td align="center">{{$i + 1}}</td>
                        <td>{{$item_name[$itemsId[$i]]['name']}}</td>
                        <td>{{$item_category[$itemsId[$i]]['cat']}}</td>
                        <td>{{($item_type[$itemsId[$i]]['type'] == 1) ? "Consumable" : "Non Consumable"}}</td>
                        <td align="center">{{$item_code[$itemsId[$i]]['code']}}</td>
                        <td align="center">{{$itemsQty[$itemsId[$i]]['qty']}}&nbsp;{{$item_uom[$itemsId[$i]]['uom']}}</td>
                        <td align="center">
                            {{$company[$item_comp_id[$itemsId[$i]]['comp_id']]['comp_name']}}
                        </td>

                    </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('custom_script')
    <script>
        $(document).ready(function() {
            $("table.display").DataTable({
                fixedHeader: true,
                fixedHeader: {
                    headerOffset: 90
                }
            })
        })
    </script>
@endsection
