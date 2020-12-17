<!DOCTYPE html>
<html lang="en">
<head>
    @php
        $path = \Request::path();
        if (strpos($path, '/') !== false) {
            $path_ar = explode('/',$path);
            $title = '';
            $title = ucwords(str_replace('-',' ',$path_ar[1]));
        } else {
            $title = ucwords(str_replace('-',' ',$path));
        }

        if (strlen($title) <= 3){
            $title = strtoupper($title);
        }
    @endphp
    <title>{{$title}} | {{Session::get('company_name_parent')}} - {{Session::get('company_tag')}}</title>
    @include('layouts.head')
    @php
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        activity("view")
            ->causedBy(\Illuminate\Support\Facades\Auth::id())
            ->log($actual_link);
        $query = \Illuminate\Support\Facades\DB::getQueryLog();
        array_pop($query);
        foreach ($query as $item){
            activity("query")
                    ->causedBy(\Illuminate\Support\Facades\Auth::id())
                    ->withProperties(['url' => str_replace("\\", "", $actual_link)])
                    ->log($item['query']);
        }
    @endphp
    @yield('css')
    <style>
        input:required{
            border-color: orange;
        }
        select:required{
            border-color: orange;
        }
    </style>
</head>
<body id="kt_body" class="header-fixed header-mobile-fixed page-loading-enabled">
    <!--begin::Main-->
    <!--begin::Header Mobile-->
    @include('layouts.header_mobile')
    <!--end::Header Mobile-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            @include('layouts.header')
            <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" style="background-color: #e6e6e6" id="kt_content">
                    <!--begin::Entry-->
                    <div class="d-flex flex-column-fluid">
                        <!--begin::Container-->
                        <div class="container-fluid">
                            <!--begin::Dashboard-->
                            <!-- Content here -->
                        @yield('content')
                        <!--end::Dashboard-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Entry-->
                </div>
                <!--end::Content-->
                @include('layouts.footer')
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--begin::Quick Panel-->
    @include('layouts.quick_panel')
    <!--end::Quick Panel-->
    <!--begin::Quick User -->
    @include('layouts.quick_user')
    <!--end::Quick User -->
    @include('layouts.footer')

    @include('layouts.scripts')
    @yield('custom_script')
    <script>

        $(document).ready(function(){
            window.addEventListener("scroll", function () {
                var body = document.getElementById('kt_body')
                if (body.hasAttribute('data-header-scroll') === true){
                    $(".header-bottom").css('border-bottom', '5px solid #f1f1f6')
                }
            })

            $("input:required").each(function(){
                $(this).change(function(){
                    if ($(this).val() == "" || $(this).val() == undefined){
                        $(this).addClass('is-invalid')
                    } else {
                        $(this).addClass('is-valid')
                    }
                })
            })

            $("span.menu-text").addClass('text-dark')
        })
    </script>
</body>
</html>
