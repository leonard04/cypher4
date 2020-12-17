@extends('layouts.template')
@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3>Request Action</h3><br>
            </div>
        </div>
        <div class="card-body">
            <div class="well">
                <table align="left" style="margin-right: 100px">
                    <tr>
                        <td>RQ #</td><td>:</td>
                        <td>{{$fr->fr_num}}</td>
                    </tr>
                    <tr>
                        <td>Request By</td><td>:</td>
                        <td>{{$fr->request_by}}</td>
                    </tr>
                    <tr>
                        <td>Division</td><td>:</td>
                        <td>{{$fr->division}}</td>
                    </tr>
                    <tr>
                        <td>Request Date</td><td>:</td>
                        <td>{{date('d F Y',strtotime($fr->request_at))}}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td>Due Date</td><td>:</td>
                        <td>{{date('d F Y',strtotime($fr->due_date))}}</td>
                    </tr>
                    <tr>
                        <td>Project</td><td>:</td>
                        <td>{{$project->prj_name}}</td>
                    </tr>
                    <tr>
                        <td valign="top">Payment Method</td><td>:</td>
                        <td>
                            {{($fr->bd != '0')? 'Back Date' : 'Paid By Company'}}
                        </td>
                    </tr>
                    <tr>
                        <td>Notes</td><td>:</td>
                        <td>{{$fr->fr_notes}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if($code == 'div_appr')
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <table class="table table-bordered table-hover display font-size-sm" style="margin-top: 13px !important; width: 100%;">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Item Code</th>
                                    <th class="text-left">Item Name</th>
                                    <th class="text-center">UoM</th>
                                    <th class="text-center">Quantity Request</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($fr_detail as $key => $val)
                                    <tr>
                                        <td class="text-center">{{($key+1)}}</td>
                                        <td class="text-center">{{$val->item_id}}</td>
                                        <td class="text-left">{{$val->itemName}}</td>
                                        <td class="text-center">{{$val->uom}}</td>
                                        <td class="text-center">{{$val->qty}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <em style="font-size:10pt">*UoM is Unit of Measurement</em>
                        <br><br>
                        <h4>Confirmation</h4>
                        <hr>
                        <div class="col-md-12">
                            <form action="{{route('fr.appr.div')}}" method="post">
                                @csrf
                                <input type="hidden" name="fr_id" value="{{$fr->id}}" id="">
                                <div class="col-md-6">
                                    <textarea class="form-control" name="notes" placeholder="Write note for approve of reject here (optional)" rows="5">{{$fr->fr_notes}}</textarea>
                                    <br>
                                    <button class="btn btn-success" type="submit" name="submit" value="Approve" onclick="return confirm('Are you sure want to approve?')">
                                        <i class="fa fa-check"></i>&nbsp;&nbsp;Approve
                                    </button>

                                    &nbsp;&nbsp;
                                    <button class="btn btn-danger" type="submit" name="submit" value="Reject" onclick="return confirm('Are you sure want to reject?')">
                                        <i class="fa fa-times"></i>&nbsp;&nbsp;Reject
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @elseif($code == 'asset_appr')
                <form action="{{route('fr.appr.asset')}}" method="post">
                    @csrf
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <table class="table table-bordered table-hover display font-size-sm" style="margin-top: 13px !important; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Item Code</th>
                                        <th class="text-left">Item Name</th>
                                        <th class="text-center">UoM</th>
                                        <th class="text-center">Quantity Request</th>
                                        <th class="text-center" width="15%">Quantity To Buy</th>
                                        <th class="text-center" width="15%">Quantity To Deliver</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <input type="hidden" name="fr_num" id="" value="{{$fr->fr_num}}">
                                    @foreach($fr_detail as $key => $val)
                                        <tr>
                                            <td class="text-center">{{($key+1)}}</td>
                                            <td class="text-center">{{$val->item_id}}</td>
                                            <td class="text-left">{{$val->itemName}}</td>
                                            <td class="text-center">{{$val->uom}}</td>
                                            <td class="text-center">{{$val->qty}}</td>
                                            <td class="text-center">
                                                <input type="number" name="qty_buy[]" value="{{$val->qty}}" class="form-control" >
                                                <input type="hidden" name="fr_detail_id[]" value="{{$val->id}}">
                                                <input type="hidden" name="fr_detail_code[]" value="{{$val->item_id}}">
                                            </td>
                                            <td class="text-center">
                                                <input type="number" name="qty_deliver[]" value="0" class="form-control" >
                                                <!--<br>
                                                <select name="wh[]" class="form-control">
                                                    <option value="">-Choose-</option>

                                                </select>-->
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <em style="font-size:10pt">*UoM is Unit of Measurement</em>
                            <br><br>
                            <h4>Confirmation</h4>
                            <hr>
                            <div class="col-md-12">
                                <input type="hidden" name="fr_id" value="{{$fr->id}}" id="">
                                <div class="col-md-6">
                                    <textarea class="form-control" name="notes" placeholder="Write note for approve of reject here (optional)" rows="5">{{$fr->fr_notes}}</textarea>
                                    <br>
                                    <button class="btn btn-success" type="submit" name="submit" value="Approve" onclick="return confirm('Are you sure want to approve?')">
                                        <i class="fa fa-check"></i>&nbsp;&nbsp;Approve
                                    </button>

                                    &nbsp;&nbsp;
                                    <button class="btn btn-danger" type="submit" name="submit" value="Reject" onclick="return confirm('Are you sure want to reject?')">
                                        <i class="fa fa-times"></i>&nbsp;&nbsp;Reject
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            @elseif($code == 'deliver')
                <form action="{{route('fr.appr.deliver')}}" method="post">
                    @csrf
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <table class="table table-bordered table-hover display font-size-sm" style="margin-top: 13px !important; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Item Code</th>
                                        <th class="text-left">Item Name</th>
                                        <th class="text-center">UoM</th>
                                        <th class="text-center">Quantity Request</th>
                                        <th class="text-center" width="15%">Delivered</th>
                                        <th class="text-center" width="15%">Remnant</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <input type="hidden" name="fr_num" id="" value="{{$fr->fr_num}}">
                                    <input type="hidden" name="fr_id" id="" value="{{$fr->fr_id}}">
                                    @foreach($fr_detail as $key => $val)
                                        <tr>
                                            <td class="text-center">{{($key+1)}}</td>
                                            <td class="text-center">{{$val->item_id}}</td>
                                            <td class="text-left">{{$val->itemName}}</td>
                                            <td class="text-center">{{$val->uom}}</td>
                                            <td class="text-center">{{$val->qty}}</td>

                                            <td class="text-center">{{$val->delivered}}</td>
                                            <td class="text-center">
                                                <input type="number" name="remnant[]" class="form-control" placeholder="{{(intval($val->qty) - intval($val->delivered))}}">
                                                <input type="hidden" name="qty_remnant[]" value="{{(intval($val->qty) - intval($val->delivered))}}">
                                                <input type="hidden" name="qty_deliver[]" value="{{(intval($val->qty_deliver))}}">
                                                <input type="hidden" name="fr_detail_id[]" value="{{$val->id}}">
                                                <input type="hidden" name="fr_detail_code[]" value="{{$val->item_id}}">
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <em style="font-size:10pt">*UoM is Unit of Measurement</em>
                            <br><br>
                            <h4>Confirmation</h4>
                            <hr>
                            <div class="col-md-12">
                                <input type="hidden" name="fr_id" value="{{$fr->id}}" id="">
                                <div class="col-md-6">
                                    <textarea class="form-control" name="notes" placeholder="Write note for approve of reject here (optional)" rows="5">{{$fr->fr_notes}}</textarea>
                                    <br>
                                    <button class="btn btn-success" type="submit" name="submit" value="Approve" onclick="return confirm('Are you sure want to approve?')">
                                        <i class="fa fa-check"></i>&nbsp;&nbsp;Approve
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            @else
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <table class="table table-bordered table-hover display font-size-sm" style="margin-top: 13px !important; width: 100%;">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Item Code</th>
                                    <th class="text-left">Item Name</th>
                                    <th class="text-center">UoM</th>
                                    <th class="text-center">Quantity Request</th>
                                    <th class="text-center">Quantity Delivered</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($fr_detail as $key => $val)
                                    <tr>
                                        <td class="text-center">{{($key+1)}}</td>
                                        <td class="text-center">{{$val->item_id}}</td>
                                        <td class="text-left">{{$val->itemName}}</td>
                                        <td class="text-center">{{$val->uom}}</td>
                                        <td class="text-center">{{$val->qty}}</td>
                                        <td class="text-center">{{($val->delivered != null)?$val->delivered:'-'}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <em style="font-size:10pt">*UoM is Unit of Measurement</em>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('custom_script')
@endsection
