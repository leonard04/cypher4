@extends('layouts.template')
@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3>Training - <label class="text-primary">{{$detail->title}}</label></h3><br>
            </div>
            <div class="card-toolbar">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{route('training.index')}}" class="btn btn-success btn-xs"><i class="fa fa-backspace"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#all">
                        <span class="nav-icon">
                            <i class="flaticon-folder-1"></i>
                        </span>
                        <span class="nav-text">Detail</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#sales" aria-controls="profile">
                        <span class="nav-icon">
                            <i class="flaticon-folder-2"></i>
                        </span>
                        <span class="nav-text">Participants</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content mt-5" id="myTabContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-custom gutter- bg-secondary">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h3>Training Detail</h3>
                                    </div>
                                    <div class="card-toolbar">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#editItem"><i class="fa fa-edit"></i>Edit Detail</button>
                                        </div>
                                    </div>
                                </div>
                                {{-- BEGIN MODAL EDIT --}}
                                <div class="modal fade" id="editItem" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Training</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <i aria-hidden="true" class="ki ki-close"></i>
                                                </button>
                                            </div>
                                            <form method="post" action="{{URL::route('training.update',$detail->id)}}">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="detail" id="detail" value="{{$detail->id}}">
                                                    <div class="form-group">
                                                        <label>Title</label>
                                                        <input type="text" class="form-control" name="title" required="true" value="{{$detail->title}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <textarea class="form-control" name="description" required="true">{!!$detail->description!!}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Training Website</label>
                                                        <input type="text" class="form-control" name="link" required="true" placeholder="URL" value="{{$detail->link}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Type</label>
                                                        <select class="form-control" name="type" id="type{{$detail->id}}" required="true" onChange="changetrainingtype{{$detail->id}}();">
                                                            <option value="">Choose</option>
                                                            <option value="Mandatory" {{($detail->type === "Mandatory")? 'selected="selected"':""}}>Mandatory</option>
                                                            <option value="Optional" {{($detail->type === "Optional")? 'selected="selected"':""}}>Optional</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Completion Point</label>
                                                        <input type="number" class="form-control" id="complete_point{{$detail->id}}"  min="0" name="complete_point" required="true" value="{{$detail->complete_point}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Minus Point</label>
                                                        <div class="input-group">
                                                            <input type="number" class="form-control" id="minus_point{{$detail->id}}" name="minus_point" min="0" required="true" aria-describedby="basic-addon2" value="{{$detail->minus_point}}">
                                                            <div class="input-group-append"><span class="input-group-text" id="basic-addon2">/ Day</span></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Pass Score</label>
                                                        <input type="number" class="form-control" id="pass_score{{$detail->id}}" name="pass_score" min="0" required="true" value="{{$detail->pass_score}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Start Date</label>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="date" min="{{date('Y-m-d')}}" class="form-control" id="start_date" name="start_date" required="true" value="{{date('Y-m-d',strtotime($detail->start_date))}}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="time" class="form-control" id="start_date2" name="start_date2" required="true" value="{{date('H:i',strtotime($detail->start_date))}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Deadline</label>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="date" class="form-control" id="deadline" name="deadline" required="true" value="{{date('Y-m-d',strtotime($detail->deadline))}}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="time" class="form-control" id="deadline2" name="deadline2" required="true" value="{{date('H:i',strtotime($detail->deadline))}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Syllabus Document</label>
                                                        <input type="file" multiple="multiple" accept=".xlsx,.xls,.doc, .docx,.ppt, .pptx,.txt,.pdf" class="form-control" name="syllabus_document[]" required="true">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Syllabus Video</label>
                                                        <div id="divVidLink{{$detail->id}}">
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                    <input type="text" name="video_link[]" class="form-control" placeholder="URL">&nbsp;
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <button type="button" class="btn btn-success" id="editVidLinkBtn{{$detail->id}}">+</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        function changetrainingtype{{$detail->id}}()
                                                        {
                                                            if ($("#type{{$detail->id}}").val() === "Mandatory") {
                                                                console.log("ini")
                                                                $("#complete_point{{$detail->id}}").prop("readonly", true);
                                                                $("#complete_point{{$detail->id}}").val({{$settingPoint['complete_point']}});
                                                                $("#minus_point{{$detail->id}}").prop("readonly", true);
                                                                $("#minus_point{{$detail->id}}").val({{$settingPoint['minus_point']}});
                                                            }
                                                            else
                                                            {
                                                                $("#complete_point{{$detail->id}}").prop("readonly", false);
                                                                $("#minus_point{{$detail->id}}").prop("readonly", false);
                                                            }
                                                        }

                                                        $("#editVidLinkBtn{{$detail->id}}").click(function(){
                                                            console.log('asdasd');
                                                            $('#divVidLink{{$detail->id}}').append(
                                                                '<div class="row">'
                                                                +'<div class="col-md-9">'
                                                                +'<input type="text" name="video_link[]" class="form-control" placeholder="URL">&nbsp;'
                                                                +'</div>'
                                                                +'<div class="col-md-3">'
                                                                +'<button type="button" class="btn btn-danger delVidLinkBtn">x</button>'
                                                                +'</div>'
                                                                +'</div>'
                                                            );
                                                        });

                                                        $("#divVidLink{{$detail->id}}").on('click','.delVidLinkBtn',function(){
                                                            $(this).parent().parent().remove();
                                                        });
                                                    </script>

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
                                {{-- END MODAL EDIT --}}
                                <div class="card-body">
                                    <table>
                                        <tr>
                                            <td>Title</td>
                                            <td>:</td>
                                            <td>{{$detail->title}}</td>
                                        </tr>
                                        <tr>
                                            <td>Description</td>
                                            <td>:</td>
                                            <td>{{$detail->description}}</td>
                                        </tr>
                                        <tr>
                                            <td>Type</td>
                                            <td>:</td>
                                            <td>{{$detail->type}}</td>
                                        </tr>
                                        <tr>
                                            <td>Complete Point</td>
                                            <td>:</td>
                                            <td>{{$detail->complete_point}}</td>
                                        </tr>
                                        <tr>
                                            <td>Start Date</td>
                                            <td>:</td>
                                            <td>{{date('d M Y, H:i',strtotime($detail->start_date))}}</td>
                                        </tr>
                                        <tr>
                                            <td>Deadline</td>
                                            <td>:</td>
                                            <td>{{date('d M Y, H:i',strtotime($detail->deadline))}}</td>
                                        </tr>
                                        <tr></tr>
                                        <tr>
                                            <td>Syllabus Document</td>
                                            <td>:</td>
                                            <td>
                                                @foreach($syllabus as $key => $value)
                                                    <a href="{{asset('../public_html/hrd/uploads')}}/{{$value->name}}" target="_blank"><i class="fa fa-download"></i></a> {{$value->name}}
                                                    <br>
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Syllabus Link</td>
                                            <td>:</td>
                                            <td>
                                                @foreach($syllabus as $key => $value)
                                                    <a href="{{$value->link}}" target="_blank">{{$value->link}}</a>
                                                    <br>
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Link</td>
                                            <td>:</td>
                                            <td>
                                                <a href='{{$detail->link}}' target="_blank" class="btn btn-link btn-xs" alt="Go to Training" title="Go to Training"><i class="fa fa-link"></i> Go to Training Website</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Training Status</td>
                                            <td>:</td>
                                            <td>
                                                <label class=" @if($trainingStatus[$detail->id] == 'FINISHED') text-success @elseif($trainingStatus[$detail->id] == 'ONGOING') text-warning @else text-info @endif">
                                                    {{$trainingStatus[$detail->id]}}
                                                </label>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="profile-tab">

                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom_script')
    <script>
        $("table.display").DataTable({
            fixedHeader: true,
            fixedHeader: {
                headerOffset: 90
            }
        })
    </script>
@endsection
