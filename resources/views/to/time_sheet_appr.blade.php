@extends('layouts.template')
@section('content')

    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Timesheet Approval</h3>
            </div>
            <div class="card-toolbar">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{route('to.index')}}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="">
                        Personal Information
                    </h4>
                    <hr>
                    <table class="table">
                        <tr>
                            <td>Employee Name</td>
                            <td>:</td>
                            <td><b>{{$emp->emp_name}}</b></td>
                        </tr>
                        <tr>
                            <td>Employee ID</td>
                            <td>:</td>
                            <td><b>{{$emp->emp_id}}</b></td>
                        </tr>
                        <tr>
                            <td>Employee Position</td>
                            <td>:</td>
                            <td><b>{{$emp->emp_position}}</b></td>
                        </tr>
                    </table>
                    <br>
                    <h4 class="">
                        Document Information
                    </h4>
                    <hr>
                    <table class="table">
                        <tr>
                            <td>Document Number</td>
                            <td>:</td>
                            <td><b>{{$to->doc_num}}</b></td>
                        </tr>
                        <tr>
                            <td>Departure Date</td>
                            <td>:</td>
                            <td><b>{{$to->departure_dt}}</b></td>
                        </tr>
                        <tr>
                            <td>Return Date</td>
                            <td>:</td>
                            <td><b>{{$to->return_dt}}</b></td>
                        </tr>
                        <tr>
                            <td>Length</td>
                            <td>:</td>
                            <td><b>{{$to->duration}} day(s)</b></td>
                        </tr>
                        <tr>
                            <td>Destination</td>
                            <td>:</td>
                            <td><b>{{$to->destination}}</b></td>
                        </tr>
                        <tr>
                            <td>Destination Type</td>
                            <td>:</td>
                            <td><b>@if($to->dest_type=='vst') Visit @elseif($to->dest_type=='fld') Field @elseif($to->dest_type=='wh') Warehouse @else - @endif</b></td>
                        </tr>
                        <tr>
                            <td>Travel Type</td>
                            <td>:</td>
                            <td><b>{{($to->travel_type == 'reg')?'REGULAR':'On Days Off'}}</b></td>
                        </tr>
                    </table>
                    <br>
                    @php
                        $meal = intval($to->duration) * intval($to->to_meal);
                        $spending = intval($to->duration) * intval($to->to_spending);
                        $overnight = intval($to->duration) * intval($to->to_overnight);
                        $transport = intval($to->transport);
                        $local_trans = intval($to->to_transport);
                        $taxi = intval($to->taxi);
                        $carrent = intval($to->rent);
                        $airtax = intval($to->airtax);

                        $totalcostFT = $meal + $spending + $overnight + $transport + $local_trans + $taxi + $carrent + $airtax;
                    @endphp

                    @if($code == 'pay')
                        <h4 class="">
                            FT Total
                        </h4>
                        <hr>
                        <table class="table">
                            <tr>
                                <td style="text-align: right;background: #eaeaea">
                                    <h4 >{{number_format($totalcostFT,2)}}</h4>
                                </td>
                            </tr>
                        </table>

                        <br>
                    @endif
                </div>

                <div class="col-md-6">
                    <h4 class="">
                        Approval
                    </h4>
                    <hr>
                    @if($code == 'approve')
                        <form action='{{route('to.tsdoappr')}}' method='post'>
                            @csrf
                            <table class="table">
                                <tr>
                                    <td>Action</td>
                                    <td>:</td>
                                    <td><b>
                                            <select name="action" class="form-control">
                                                <option></option>
                                                <option value="approve"> Approve </option>
                                                <option value="disapprove"> Disapprove </option>
                                            </select>
                                        </b></td>
                                </tr>
                                <tr>
                                    <td>Notes</td>
                                    <td>:</td>
                                    <td><b><textarea class="form-control" name="action_notes" rows="3"></textarea></b></td>
                                </tr>
                            </table>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-md-10 col-sm-10">
                                    @php
                                        if (($to->to_cekoverngith == null) && ($to->dest_type=='vst')){
                                            $hotel = 1;
                                            $project = $to->project;
                                        } else {
                                            $hotel = 0;
                                            $project = "";
                                        }
                                    @endphp
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <input type="hidden" name="id_to" id="" value="{{$to->id}}">
                                    <button class="btn btn-success" name="submit" type="submit" value="Save">
                                        <i class="fa fa-check"></i> &nbsp;Submit
                                    </button>
                                </div>

                            </div>
                        </form>
                    @elseif($code == 'check')
                        <form action='{{route('to.doCheckAppr')}}' method='post'>
                            @csrf
                            <table class="table">
                                <tr>
                                    <td colspan="2">
                                        This Travel Order is completed, and is acknowledge by Operation Division
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="departure_date" value="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; With a change of "Departure Date" to this date
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="departs" value='{{$to->departure_dt}}'>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="return_date" value="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; With a change of "Return Date" to this date
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="date" class="form-control" name="returns" value='{{$to->return_dt}}'>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="spending_half" value="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Worked for more than 8 hours a day and staying over at a certain PSI location.
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <input type='hidden' name='id_to' value='{{$to->id}}'>
                            <input type="hidden" name="to_spending" value="@if($to->sppd_type == 'dom') {{$emp->dom_spending}} @else {{$emp->ovs_spending}} @endif">

                            <br>
                            <br>
                            <div class="row">
                                <div class="col-md-10 col-sm-10"></div>
                                <div class="col-md-2 col-sm-2">
                                    <button class="btn btn-success" name="submit" type="submit" value="Save">
                                        <i class="fa fa-check"></i> &nbsp;Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    @else
                        <form action='{{route('to.doPayAppr')}}' method='post'>
                            @csrf
                            <table class="table">
                                <tr>
                                    <td>
                                        This Travel Order's Financial Travelling is paid by Finance Division
                                    </td>
                                </tr>
                            </table>
                            <table class='table'>
                                <tr>
                                    <td align='right'>Bank Source : </td>
                                    <td>
                                        <select class="form-control" name="bank_sel" id="bank_sel">
                                            <option>..</option>
                                            <option value="1">Mandiri</option>
                                            <option value="2">BCA</option>
                                            <option value="3">Bank Sumsel</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>

                            <input type='hidden' name='sum' value='{{$totalcostFT}}'>
                            <input type='hidden' name='id' value='{{$to->id}}'>
                            <input type='hidden' name='subject' value='{{$to->doc_num}}'>

                            <br>
                            <br>
                            <div class="row">
                                <div class="col-md-10 col-sm-10"></div>
                                <div class="col-md-2 col-sm-2">
                                    <button class="btn btn-success pull-right" name="submit" value="Save">
                                        <i class="fa fa-check"></i> &nbsp;Approve
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom_script')
@endsection
