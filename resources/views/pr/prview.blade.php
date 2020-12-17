@extends('layouts.template')
@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3>Purchase Request Detail</h3><br>
            </div>
        </div>
        <div class="card-body">
            <div class="well">
                <table align="left" style="margin-right: 100px">
                    <tr>
                        <td>PRE #</td><td>:</td>
                        <td>{{$pr->pre_num}}</td>
                    </tr>
                    <tr>
                        <td>PRE Date</td><td>:</td>
                        <td>{{date('d F Y',strtotime($pr->fr_approved_at))}}</td>
                    </tr>
                    <tr>
                        <td>FR #</td><td>:</td>
                        <td>{{$pr->fr_num}}</td>
                    </tr>
                    <tr>
                        <td>FR Date</td><td>:</td>
                        <td>{{date('d F Y',strtotime($pr->request_at))}}</td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td>Due Date</td><td>:</td>
                        <td>{{date('d F Y',strtotime($pr->due_date))}}</td>
                    </tr>
                    <tr>
                        <td>Project</td><td>:</td>
                        <td>{{$project->prj_name}}</td>
                    </tr>
                    <tr>
                        <td valign="top">Division</td><td>:</td>
                        <td>
                            {{$pr->division}}
                        </td>
                    </tr>
                    <tr>
                        <td>Notes</td><td>:</td>
                        <td>{{$pr->fr_notes}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if($code == 'dir_appr')
                <form action="{{route('fr.appr.dir')}}" method="post">
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
                                        <th class="text-center">Stock</th>
                                        <th class="text-center" width="15%">Quantity Approve</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pr_detail as $key => $val)
                                        <tr>
                                            <td class="text-center">{{($key+1)}}</td>
                                            <input type="hidden" name="item[]" value="{{$val->item_id}}">
                                            <input type="hidden" name="itemID[]" value="{{$val->id}}">
                                            <td class="text-center">{{$val->item_id}}</td>
                                            <td class="text-left">{{$val->itemName}}</td>
                                            <td class="text-center">{{$val->uom}}</td>
                                            <td class="text-center">{{$val->qty}}</td>
                                            <td class="text-center"></td>
                                            <td class="text-center">
                                                <input type="number" name="qty_appr[]" class="form-control" value="{{$val->qty}}">
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
                                <input type="hidden" name="fr_num" value="{{$pr->fr_num}}" id="">
                                <input type="hidden" name="id" value="{{$pr->id}}" id="">
                                <div class="col-md-6">
                                    <textarea class="form-control" name="notes" placeholder="Write note for approve of reject here (optional)" rows="5">{{$pr->fr_notes}}</textarea>
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
                                @foreach($pr_detail as $key => $val)
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
