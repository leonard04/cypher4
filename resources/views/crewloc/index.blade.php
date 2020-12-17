@extends('layouts.template')
@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3>Crew Location</h3>
            </div>
            <div class="card-toolbar">
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#all">
                        <span class="nav-icon">
                            <i class="flaticon-folder-1"></i>
                        </span>
                        <span class="nav-text">Crew View</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#sales" aria-controls="profile">
                        <span class="nav-icon">
                            <i class="flaticon-folder-2"></i>
                        </span>
                        <span class="nav-text">Planning View</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content mt-5" id="myTabContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="home-tab">
                    <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <table class="table table-bordered table-hover display font-size-sm" style="margin-top: 13px !important; width: 100%;">
                            <thead>
                            <tr border ="0">
                                <th colspan="3">Field Officer List</th>
                            </tr>
                            <tr>
                                <th class="text-center" width="5%">#</th>
                                <th class="text-left">Name</th>
                                <th class="text-center" width="15%">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($kruoff as $key => $val)
                                @php
                                    $spanday =[];
                                @endphp
                                @if(count($spandays)>0)
                                    @php
                                        $spanday = (strtotime(date('Y-m-d')) - strtotime($spandays[$val->id][0]))/86400;
                                    @endphp
                                @endif
                                <tr>
                                    <td class="text-center">{{($key+1)}}</td>
                                    <td>
                                        <b class="font-size-h6-sm">{{$val->emp_name}}</b>
                                        <i class="text-black-50"><small class="font-size-h6-sm">
                                                {{'('}}return {{$spanday}} day(s) ago on {{date('d-M-Y',strtotime($spandays[$val->id][0]))}}
                                                    @foreach($to_plan as $toplan)
                                                        @if($toplan->emp_id == $val->id) Planned for
                                                            @foreach($projects as $key2 => $val2)
                                                                @if($val2->id == $toplan->project)
                                                                    {{$val2->prj_name}}
                                                                @endif
                                                            @endforeach
                                                            on {{date('d-M-Y',strtotime($toplan->assign_date))}}, remark: {{$toplan->remark}}
                                                        @else
                                                            {{'Not planned yet'}}
                                                        @endif
                                                    @endforeach
                                                {{')'}}
                                            </small></i>
                                       </td>
                                    <td class="text-center"> @if($spanday >= 0) Available @else @php echo $spanday * (-1)." day(s)"; @endphp @endif</td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        <table class="table table-bordered table-hover display font-size-sm" style="margin-top: 13px !important; width: 100%;">
                            <thead>
                            <tr border ="0">
                                <th colspan="3">Local Crew List</th>
                            </tr>
                            <tr>
                                <th class="text-center" width="5%">#</th>
                                <th class="text-left">Name</th>
                                <th class="text-center" width="15%">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($localkruoff as $key => $val)
                                <tr>
                                    <td class="text-center">{{($key+1)}}</td>
                                    <td><b class="font-size-h6-sm">{{$val->emp_name}}</b> </td>
                                    <td class="text-center"> </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>
                </div>
                <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="profile-tab">

                    <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <table class="table table-bordered table-hover display font-size-sm" style="margin-top: 13px !important; width: 100%;">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Position</th>
                                <th class="text-center">Span Day</th>
                                <th class="text-center">Assign Date</th>
                                <th class="text-center" width="50%">Project</th>
                                <th class="text-center">Remark</th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($kruoff as $key => $val)
                                <form method="post" action="{{route('crewloc.storeplan')}}">
                                    @csrf
                                    @php
                                        $spanday =[];
                                    @endphp
                                    @if(count($spandays)>0)
                                        @php
                                            $spanday = (strtotime(date('Y-m-d')) - strtotime($spandays[$val->id][0]))/86400;
                                        @endphp
                                    @endif
                                    @if($spanday >= 0)
                                        <tr>
                                            <td class="text-center">{{($key+1)}}</td>
                                            <td class="text-center">
                                                {{$val->emp_name}}
                                                <input type="hidden" name="emp_id" value="{{$val->id}}">
                                            </td>
                                            <td class="text-center">{{$val->emp_position}}</td>
                                            <td class="text-center">{{$spanday}} day(s)</td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="date" class="form-control" name="date_assign" @foreach($to_plan as $toplan) @if($toplan->emp_id == $val->id) value="{{date('Y-m-d',strtotime($toplan->assign_date))}}" @else value="{{date('Y-m-d')}}" @endif @endforeach/>
                                                </div>
                                            </td>
                                            <td>
                                                <select class="form-control" name="project">
                                                    <option>Choose Project</option>
                                                    @foreach($projects as $key2 => $val2)
                                                        <option value="{{$val2->id}}" @foreach($to_plan as $toplan) @if($toplan->emp_id == $val->id) @if($toplan->project == $val2->id) SELECTED @endif @endif @endforeach>{{$val2->prj_name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <textarea class="form-control" name="remark">@foreach($to_plan as $toplan) @if($toplan->emp_id == $val->id) {{$toplan->remark}} @endif @endforeach</textarea>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <button type="submit" name="submit" class="btn btn-success font-weight-bold">
                                                        <i class="fa fa-check"></i>
                                                        Save</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif

                                </form>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_script')
    <script>
        $(document).ready(function(){
            $("table.display").DataTable({
                fixedHeader: true,
                fixedHeader: {
                    headerOffset: 90
                }
            })
        })
    </script>
@endsection
