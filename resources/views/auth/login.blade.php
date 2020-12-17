@extends('layouts.templateauth2')
@section('title','Login | Cypher')
@section('content')
<form class="form" novalidate="novalidate" id="kt_login_signin_form" method="POST" action="{{route('login')}}">
    <!--begin::Title-->
    @csrf
    <div class="text-center pb-8">
        <h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Sign In</h2>
        <span class="font-weight-bold font-size-h4" id="company_name">

        </span>
    </div>
    <div class="d-flex align-items-center mb-6 mx-auto">
        <div class="mx-auto">
            @foreach($companies as $key => $value)
                <div class="symbol symbol-40 symbol-light-primary mr-5">
                    <span class="symbol-label">
                        <a href="javascript:;" onclick="getIdCompany({{$value->id}})">
                              <span class="svg-icon svg-icon-lg svg-icon-primary">
                                  <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                                  <img src='{{str_replace("public", "public_html", asset('images/'.$value->app_logo))}}' style="align-content: center; max-width: 95%" @if($value->tag == 'CYP') height='15px' @else height='30px' @endif alt="{{$value->company_name}}"/> &nbsp;&nbsp;
                                  <!--end::Svg Icon-->
                              </span>
                        </a>

                    </span>
                </div>
            @endforeach
        </div>

    </div>
    <!--end::Title-->
    <!--begin::Form group-->
    <div class="form-group">
        <label class="font-size-h6 font-weight-bolder text-dark">Username</label>
        <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="text" name="username" autocomplete="off" />
        <input type="hidden" name="id_company" id="id_company" value="1">
    </div>
    <!--end::Form group-->
    <!--begin::Form group-->
    <div class="form-group">
        <div class="d-flex justify-content-between mt-n5">
            <label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
        </div>
        <input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="password" name="password" autocomplete="off" />
    </div>
    <!--end::Form group-->
    <!--begin::Action-->
    <div class="text-center pt-2">
        <button type="submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Sign In</button>
    </div>
    <!--end::Action-->
</form>
@endsection
@section('custom_script')
    <script type="text/javascript">
        function getIdCompany(x){
            if(confirm('Switch Company. Are you sure?')){
                $('#id_company').val(x)
                company_name(x)
            }
            // console.log($('#id_company').val())
        }

        function company_name(x) {
            $.ajax({
                url: "{{route('home.get_company')}}/"+x,
                type: "get",
                dataType: "json",
                cache: false,
                success: function(response){
                    $("#company_name").text(response.company_name)
                    $("#company_name").css('color', response.bgcolor)
                }
            })
        }
        $(document).ready(function(){
            company_name(1)
        })

    </script>
@endsection
