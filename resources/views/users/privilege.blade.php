@extends('layouts.template')
@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">{{$user->username}} - Privilege</h3>
            </div>
            <div class="card-toolbar">

                <a href="{{route('company.detail', $companyId)}}" class="btn btn-secondary font-weight-bolder">
				<span class="svg-icon svg-icon-md">
					<i class="la la-angle-double-right"></i>
				</span>Company
                </a>&nbsp;
                <button class="btn btn-primary font-weight-bolder" id="selectButton">
				<span class="svg-icon svg-icon-md">
				</span>Select All / Deselect All
                </button>&nbsp;
                <button class="btn btn-info font-weight-bolder" id="saveUserPrivelege">
                    <i class="fa fa-check"></i>Save
                </button>
            </div>
        </div>
        <div class="card-body">
            <form id="userPrivelegeUpdate" action="{{route('user.uprivilege', $user->id)}}" method="post">
                @csrf
                <table class="table">
                    <thead>
                    <th></th>
                    @foreach($actionList as $key => $action)
                        <th style="text-align: center; max-width: 30px;">
							<span>
								{{$action}}
							</span>
                        </th>
                    @endforeach

                    </thead>
                    <tbody>
                    @foreach($moduleList as $moduleKey => $module)
                        <tr>
                            <td style="text-align: right; max-width: 100px;">
								<span data-container="body" data-toggle="kt-tooltip" data-placement="left">
									{{$module}}
								</span>
                            </td>
                            @foreach($actionList as $actionKey => $action)
                                <td style="text-align: center;">
                                    <label class="kt-checkbox kt-checkbox--success" data-container="body" data-html="true" data-placement="top" data-toggle="kt-tooltip">
                                        <input type="checkbox" name="privilege[{{$moduleKey}}][{{$actionKey}}]" id="privilege_{{$moduleKey}}_{{$actionKey}}" value="1">
                                        <span></span>
                                    </label>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </form>
        </div>
    </div>
@endsection
@section('custom_script')
    @if(isset($user))
        <script>
        jQuery.each({!! $user->privilege !!}, function(key, value)
        {
            console.log(value['id_rms_modules'], value['id_rms_actions'])
            $('#privilege_'+value['id_rms_modules']+'_'+value['id_rms_actions']).attr('checked', true);
        });
        </script>
    @endif
    <script type="text/javascript">
        $(document).ready(function() {
            var clicked = false;
            $("#selectButton").on("click", function() {
                $(":checkbox").prop("checked", !clicked);
                clicked = !clicked;
            });

            $("#saveUserPrivelege").click(function(){
            	$('#userPrivelegeUpdate').submit();
            });
        });
    </script>
@endsection
