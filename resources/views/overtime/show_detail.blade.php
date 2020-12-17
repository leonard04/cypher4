@extends('layouts.template')
@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Overtime - <b>{{$emp->emp_name}}</b></h3>
                <!-- <span class="d-block text-muted pt-2 font-size-sm">Datatable initialized from HTML table</span></h3> -->
            </div>
        </div>
        <hr>
        <div class="card-body">
            <form method="post" action="{{route('overtime.storeOvertime')}}">
                <input type="hidden" name="id_emp" id="" value="{{$emp->id}}">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center info" colspan="2">{{date("F Y", mktime(0,0,0,$month-1))}}</th>
                            </tr>
                            <tr>
                                <th class="text-center">Date</th>
                                <th class="text-center">Time In</th>
                                <th class="text-center">Time Out</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i = 16; $i<= $max_col1; $i++)
                                @php
                                    $index = date("Ymd", mktime(0,0,0,$month-1,$i,$year));
                                @endphp
                                @if(in_array(date("w", strtotime($index)), array(0,6)))
                                    @php  $bgcolor = "orange"; @endphp
                                @else
                                    @php  $bgcolor = "white"; @endphp
                                @endif
                                <tr bgcolor="{{$bgcolor}}">
                                    <td align="center">{{date("d M", mktime(0,0,0,$month-1,$i,$year))}}</td>
                                    <td align="center">
                                        <input type="hidden" name="id_ovt[{{$index}}]" value="{{(!empty($idovt[$index]))?$idovt[$index]:''}}">
                                        <input name="overtime[{{$index}}]" type="time" class="form-control" value="{{(!empty($overtime[$index]))?$overtime[$index]:''}}" />
                                    </td>
                                    <td align="center">
                                        <input name="overtimeout[{{$index}}]" type="time" class="form-control" value="{{(!empty($overtimeOut[$index]))?$overtimeOut[$index]:''}}" />
                                    </td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center info" colspan="2">{{date("F Y", mktime(0,0,0,$month))}}</th>
                            </tr>
                            <tr>
                                <th class="text-center">Date</th>
                                <th class="text-center">Time In</th>
                                <th class="text-center">Time Out</th>
                            </tr>
                            </thead>
                            <tbody>

                            @for($i = 1; $i<= 15; $i++)
                                @php
                                    $index = date("Ymd", mktime(0,0,0,$month,$i,$year));
                                @endphp
                                @if(in_array(date("w", strtotime($index)), array(0,6)))
                                    @php  $bgcolor = "orange"; @endphp
                                @else
                                    @php  $bgcolor = "white"; @endphp
                                @endif
                                <tr bgcolor="{{$bgcolor}}">
                                    <td align="center">{{date("d M", mktime(0,0,0,$month,$i,$year))}}</td>
                                    <td align="center">
                                        <input type="hidden" name="id_ovt[{{$index}}]" value="{{(!empty($idovt[$index]))?$idovt[$index]:''}}">
                                        <input name="overtime[{{$index}}]" type="time" class="form-control" value="{{(!empty($overtime[$index]))?$overtime[$index]:''}}" />
                                    </td>
                                    <td align="center">
                                        <input name="overtimeout[{{$index}}]" type="time" class="form-control" value="{{(!empty($overtimeOut[$index]))?$overtimeOut[$index]:''}}" />
                                    </td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                        @csrf
                        <div class="col-md-3">
                            <button class="btn btn-primary" type="submit" name="save">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('custom_script')
    <script>
        $(document).ready(function () {
            $('.display').DataTable({
                responsive: true,
            });
        });
    </script>
@endsection
