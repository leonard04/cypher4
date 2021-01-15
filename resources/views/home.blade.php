@extends('layouts.template')
@section('content')

<!--begin::Row-->
<div class="row">
    <div class="col-xl-6">
        <!--begin::List Widget 10-->
        <div class="card card-custom  card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">Notifications</h3>
            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div class="card-body pt-0">
                @if(count($data) > 0)
                    @foreach($data as $key => $value)
                        @if($value['count'] > 0)
                            <!--begin::Item-->
                                <div class="mb-6">
                                    <!--begin::Content-->
                                    <div class="d-flex align-items-center flex-grow-1">
                                        <!--begin::Checkbox-->
                                        <label class="checkbox checkbox-lg checkbox-lg flex-shrink-0 mr-4">
                                            <input type="checkbox" value="1"/>
                                            <span></span>
                                        </label>
                                        <!--end::Checkbox-->

                                        <!--begin::Section-->
                                        <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                            <!--begin::Info-->
                                            <div class="d-flex flex-column align-items-cente py-2 w-75">
                                                <!--begin::Title-->
                                                <a href="{{route($value['route'])}}" class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">
                                                    {{$value['label']}}
                                                </a>
                                                <!--end::Title-->

                                                <!--begin::Data-->
                                                {{--                            <span class="text-muted font-weight-bold">--}}
                                                {{--                            since 13/11/2020 08:00--}}
                                                </span>
                                                <!--end::Data-->
                                            </div>
                                            <!--end::Info-->

                                            <!--begin::Label-->
                                            <span class="label label-lg label-{{$value['bg']}} label-inline font-weight-bold py-4">{{$value['count']}}</span>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Section-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                            <!--end::Item-->
                        @endif
                    @endforeach
                @else
                        <div class="mb-6">
                            <!--begin::Content-->
                            <div class="d-flex align-items-center flex-grow-1">
                                <!--begin::Checkbox-->
                                <label class="checkbox checkbox-lg checkbox-lg flex-shrink-0 mr-4">
                                    <input type="checkbox" value="1"/>
                                    <span></span>
                                </label>
                                <!--end::Checkbox-->

                                <!--begin::Section-->
                                <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column align-items-cente py-2 w-75">
                                        <!--begin::Title-->
                                        <span class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">No data available</span>
                                        <!--end::Title-->

                                        <!--begin::Data-->
                                        {{--                            <span class="text-muted font-weight-bold">--}}
                                        {{--                            since 13/11/2020 08:00--}}
                                        </span>
                                        <!--end::Data-->
                                    </div>
                                    <!--end::Info-->

                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Content-->
                        </div>
                @endif
            </div>
            <!--end: Card Body-->
        </div>
        <!--end: Card-->
        <!--end: List Widget 10-->
    </div>
    <div class="col-xl-6">
        <!--begin::List Widget 11-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">Meetings</h3>
            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div class="card-body pt-0">
                @if(count($meeting) > 0)
                    @foreach($meeting as $value)
                        <?php
                        /** @var TYPE_NAME $value */
                        $date1 = date_create($value->tanggal);
                        $date2 = date_create(date('Y-m-d'));
                        $diff = date_diff($date2, $date1);
                        $diff_num = intval($diff->format("%a"));
                        if ($diff_num < 3){
                            $bg = "danger";
                        } elseif ($diff_num >= 3 && $diff_num < 5){
                            $bg = "warning";
                        } elseif ($diff_num > 5){
                            $bg = "success";
                        }
                        ?>
                        <!--begin::Item-->
                            <div class="d-flex align-items-center mb-9 bg-light-{{$bg}} rounded p-5">
                                <!--begin::Icon-->
                                <span class="svg-icon svg-icon-{{$bg}} mr-5">
                        <span class="svg-icon svg-icon-lg"><!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24"/>
                <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000"/>
                <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519) " x="16.3255682" y="2.94551858" width="3" height="18" rx="1"/>
            </g>
        </svg><!--end::Svg Icon--></span>            </span>
                                <!--end::Icon-->

                                <!--begin::Title-->
                                <div class="d-flex flex-column flex-grow-1 mr-2">
                                    <a href="#" class="font-weight-bold text-dark-75 text-hover-primary font-size-lg mb-1">{{(isset($detail_meeting['topic'][$value->id]['topic_meeting']))?$detail_meeting['topic'][$value->id]['topic_meeting']:''}}</a>
                                    <span class="text-muted font-weight-bold">{{(isset($detail_meeting['room'][$value->id_ruangan]['nama_ruangan']))?$detail_meeting['room'][$value->id_ruangan]['nama_ruangan']:''}}</span>
                                </div>
                                <!--end::Title-->

                                <!--begin::Lable-->
                                <span class="font-weight-bolder text-{{$bg}} py-1 font-size-lg">{{date('d/m/Y', strtotime($value->tanggal))}}<br />{{$detail_meeting['time'][$value->id][0]['jam']}} - {{end($detail_meeting['time'][$value->id])['jam']}}</span>
                                <!--end::Lable-->
                            </div>
                            <!--end::Item-->
                        @endforeach
                @else
                    <!--begin::Item-->
                        <div class="d-flex align-items-center mb-9 bg-light-secondary rounded p-5">
                            <!--begin::Title-->
                            <div class="d-flex flex-column flex-grow-1 mr-2">
                                <span class="text-muted font-weight-bold">No data available</span>
                            </div>
                        </div>
                        <!--end::Item-->
                @endif
            </div>
            <!--end::Body-->
        </div>
        <!--end::List Widget 11-->
    </div>
</div>
<!--end::Row-->



    <div class="subheader py-2 py-lg-4 subheader-transparent" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">Menu</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->

                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Actions-->
                <button data-toggle="modal" type="button" data-target="#modalGuide" class="btn btn-light font-weight-bold btn-sm">Guide</button>
                <!--end::Actions-->
                <!--begin::Dropdown-->
                <!--end::Dropdown-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>

    <div class="separator separator-solid separator-border-2 separator-primary mt-5 mb-5"></div>

    <div class="container-fluid">

        @actionStart('general', 'access')
        <div class="row">
            <div class="subheader subheader-transparent " id="kt_subheader">
                <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center flex-wrap mr-1">
                        <!--begin::Page Heading-->
                        <div class="d-flex align-items-baseline flex-wrap mr-5">
                            <!--begin::Page Title-->
                            <h5 class="text-dark font-weight-bold my-1 mr-5">General</h5>
                            <!--end::Page Title-->
                            <!--end::Page Heading-->
                        </div>
                        <!--end::Info-->
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row mb-5">
            <div class="col-lg-2 col-xl-2 draggable-zone">
                <!--begin::Iconbox-->
                <div class="card card-custom wave gutter-b draggable wave-animate-slow wave-danger mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center p-5">
                            <div class="">
                                    <span class="svg-icon svg-icon-4x">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                        <div class="symbol symbol-danger">
                                            <span class="symbol-label font-size-h5">
                                                <a href="{{route('fr.index')}}" class="btn btn-icon btn-lg draggable-handle">
                                                    <i class="fa fa-cube text-white"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <!--end::Svg Icon-->
                                    </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <a href="{{route('fr.index')}}"><span class="text-dark font-weight-bold mb-3">Item Request</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xl-2 draggable-zone">
                <!--begin::Iconbox-->
                <div class="card card-custom wave gutter-b draggable wave-animate-slow wave-info mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center p-5">
                            <div class="">
                                    <span class="svg-icon svg-icon-4x">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                        <div class="symbol symbol-info">
                                            <span class="symbol-label font-size-h5">
                                                <a href="{{route('pr.index')}}" class="btn btn-icon btn-lg draggable-handle">
                                                    <i class="fa fa-cash-register text-white"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <!--end::Svg Icon-->
                                    </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <a href="{{route('pr.index')}}" class="text-dark font-weight-bold mb-3">Purchase Request</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xl-2 draggable-zone">
                <!--begin::Iconbox-->
                <div class="card card-custom wave gutter-b draggable wave-animate-slow wave-warning mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center p-5">
                            <div class="">
                                    <span class="svg-icon svg-icon-4x">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                        <div class="symbol symbol-warning">
                                            <span class="symbol-label font-size-h5">
                                                <a href="{{route('pe.index')}}" class="btn btn-icon btn-lg draggable-handle">
                                                    <i class="fa fa-search-dollar text-white"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <!--end::Svg Icon-->
                                    </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <a href="{{route('pe.index')}}" class="text-dark font-weight-bold mb-3">Purchase Evaluation</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xl-2 draggable-zone">
                <!--begin::Iconbox-->
                <div class="card card-custom wave gutter-b draggable wave-animate-slow mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center p-5">
                            <div class="">
                                    <span class="svg-icon svg-icon-4x">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                        <div class="symbol symbol-dark">
                                            <span class="symbol-label font-size-h5">
                                                <a href="{{route('po.index')}}" class="btn btn-icon btn-lg draggable-handle">
                                                    <i class="fa fa-cart-arrow-down text-white"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <!--end::Svg Icon-->
                                    </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <a href="{{route('po.index')}}" class="text-dark font-weight-bold mb-3">Purchase Order</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xl-2 draggable-zone">
                <!--begin::Iconbox-->
                <div class="card card-custom wave gutter-b draggable wave-animate-slow wave-info mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center p-5">
                            <div class="">
                                    <span class="svg-icon svg-icon-4x">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                        <div class="symbol symbol-info">
                                            <span class="symbol-label font-size-h5">
                                                <a href="{{route('cashbond.index')}}" class="btn btn-icon btn-lg draggable-handle">
                                                    <i class="fa fa-money-bill-wave text-white"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <!--end::Svg Icon-->
                                    </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <a href="{{route('cashbond.index')}}" class="text-dark font-weight-bold mb-3">Cashbond</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-lg-2 col-xl-2 draggable-zone">
                <!--begin::Iconbox-->
                <div class="card card-custom wave gutter-b draggable wave-animate-slow wave-danger mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center p-5">
                            <div class="">
                                    <span class="svg-icon svg-icon-4x">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                        <div class="symbol symbol-danger">
                                            <span class="symbol-label font-size-h5">
                                                <a href="{{route('general.so')}}" class="btn btn-icon btn-lg draggable-handle">
                                                    <i class="fa fa-clipboard-list text-white"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <!--end::Svg Icon-->
                                    </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <a href="{{route('general.so')}}" class="text-dark font-weight-bold mb-3">Service Order</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xl-2 draggable-zone">
                <!--begin::Iconbox-->
                <div class="card card-custom wave gutter-b draggable wave-animate-slow wave-danger mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center p-5">
                            <div class="">
                                    <span class="svg-icon svg-icon-4x">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                        <div class="symbol symbol-danger">
                                            <span class="symbol-label font-size-h5">
                                                <a href="{{route('sr.index')}}" class="btn btn-icon btn-lg draggable-handle">
                                                    <i class="fa fa-headset text-white"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <!--end::Svg Icon-->
                                    </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <a href="{{route('sr.index')}}" class="text-dark font-weight-bold mb-3">Service Request</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xl-2 draggable-zone">
                <!--begin::Iconbox-->
                <div class="card card-custom wave gutter-b draggable wave-animate-slow wave-warning mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center p-5">
                            <div class="">
                                    <span class="svg-icon svg-icon-4x">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                        <div class="symbol symbol-warning">
                                            <span class="symbol-label font-size-h5">
                                                <a href="{{route('se.index')}}" class="btn btn-icon btn-lg draggable-handle">
                                                    <i class="fa fa-edit text-white"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <!--end::Svg Icon-->
                                    </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <a href="{{route('se.index')}}" class="text-dark font-weight-bold mb-3">Service Evaluation</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xl-2 draggable-zone">
                <!--begin::Iconbox-->
                <div class="card card-custom wave gutter-b draggable wave-animate-slow wave-success mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center p-5">
                            <div class="">
                                    <span class="svg-icon svg-icon-4x">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                        <div class="symbol symbol-success">
                                            <span class="symbol-label font-size-h5">
                                                <a href="{{route('po.index')}}" class="btn btn-icon btn-lg draggable-handle">
                                                    <i class="fa fa-users-cog text-white"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <!--end::Svg Icon-->
                                    </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <a href="{{route('po.index')}}" class="text-dark font-weight-bold mb-3">Work Order</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xl-2 draggable-zone">
                <!--begin::Iconbox-->
                <div class="card card-custom wave gutter-b draggable wave-animate-slow wave-primary mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center p-5">
                            <div class="">
                                    <span class="svg-icon svg-icon-4x">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                        <div class="symbol symbol-primary">
                                            <span class="symbol-label font-size-h5">
                                                <a href="{{route('reimburse.index')}}" class="btn btn-icon btn-lg draggable-handle">
                                                    <i class="fa fa-file-invoice-dollar text-white"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <!--end::Svg Icon-->
                                    </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <a href="{{route('reimburse.index')}}" class="text-dark font-weight-bold mb-3 text-nowrap">Reimburse</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @actionEnd
        <hr>
        <div class="row">
            <div class="subheader subheader-transparent " id="kt_subheader">
                <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center flex-wrap mr-1">
                        <!--begin::Page Heading-->
                        <div class="d-flex align-items-baseline flex-wrap mr-5">
                            <!--begin::Page Title-->
                            <h5 class="text-dark font-weight-bold my-1 mr-5">Asset & Procurement</h5>
                            <!--end::Page Title-->
                            <!--end::Page Heading-->
                        </div>
                        <!--end::Info-->
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row mb-5">
            <div class="col-lg-2 col-xl-2 draggable-zone">
                <!--begin::Iconbox-->
                <div class="card card-custom wave gutter-b draggable wave-animate-slow wave-warning mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center p-5">
                            <div class="">
                                    <span class="svg-icon svg-icon-4x">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                        <div class="symbol symbol-warning">
                                            <span class="symbol-label font-size-h5">
                                                <a href="{{route('items.index')}}" class="btn btn-icon btn-lg draggable-handle">
                                                    <i class="fa la-cube text-white"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <!--end::Svg Icon-->
                                    </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <a href="{{route('items.index')}}" class="text-dark font-weight-bold mb-3">Items</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xl-2 draggable-zone">
                <!--begin::Iconbox-->
                <div class="card card-custom wave gutter-b draggable wave-animate-slow wave-primary mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center p-5">
                            <div class="">
                                    <span class="svg-icon svg-icon-4x">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                        <div class="symbol symbol-primary">
                                            <span class="symbol-label font-size-h5">
                                                <a href="#" class="btn btn-icon btn-lg draggable-handle">
                                                    <i class="fa fa-warehouse text-white"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <!--end::Svg Icon-->
                                    </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <a href="#" class="text-dark font-weight-bold mb-3">Storages</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xl-2 draggable-zone">
                <!--begin::Iconbox-->
                <div class="card card-custom wave gutter-b draggable wave-animate-slow wave-danger mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center p-5">
                            <div class="">
                                    <span class="svg-icon svg-icon-4x">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                        <div class="symbol symbol-danger">
                                            <span class="symbol-label font-size-h5">
                                                <a href="{{route('vendor.index')}}" class="btn btn-icon btn-lg draggable-handle">
                                                    <i class="fa fa-handshake text-white"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <!--end::Svg Icon-->
                                    </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <a href="{{route('vendor.index')}}" class="text-dark font-weight-bold mb-3">Vendors</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xl-2 draggable-zone">
                <!--begin::Iconbox-->
                <div class="card card-custom wave gutter-b draggable wave-animate-slow wave-info mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center p-5">
                            <div class="">
                                    <span class="svg-icon svg-icon-4x">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                        <div class="symbol symbol-info">
                                            <span class="symbol-label font-size-h5">
                                                <a href="#" class="btn btn-icon btn-lg draggable-handle">
                                                    <i class="fa fa-money-check-alt text-white"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <!--end::Svg Icon-->
                                    </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <a href="#" class="text-dark font-weight-bold mb-3">Price Lists</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="subheader subheader-transparent " id="kt_subheader">
                <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center flex-wrap mr-1">
                        <!--begin::Page Heading-->
                        <div class="d-flex align-items-baseline flex-wrap mr-5">
                            <!--begin::Page Title-->
                            <h5 class="text-dark font-weight-bold my-1 mr-5">Marketing</h5>
                            <!--end::Page Title-->
                            <!--end::Page Heading-->
                        </div>
                        <!--end::Info-->
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row mb-5">
            <div class="col-lg-2 col-xl-2 draggable-zone">
                <!--begin::Iconbox-->
                <div class="card card-custom wave gutter-b draggable wave-animate-slow wave-primary mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center p-5">
                            <div class="">
                                    <span class="svg-icon svg-icon-4x">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                        <div class="symbol symbol-primary">
                                            <span class="symbol-label font-size-h5">
                                                <a href="{{route('marketing.project')}}" class="btn btn-icon btn-lg draggable-handle">
                                                    <i class="fa fa-folder text-white"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <!--end::Svg Icon-->
                                    </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <a href="{{route('marketing.project')}}" class="text-dark font-weight-bold mb-3">Projects</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xl-2 draggable-zone">
                <!--begin::Iconbox-->
                <div class="card card-custom wave gutter-b draggable wave-animate-slow wave-danger mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center p-5">
                            <div class="">
                                    <span class="svg-icon svg-icon-4x">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                        <div class="symbol symbol-danger">
                                            <span class="symbol-label font-size-h5">
                                                <a href="{{route('marketing.client.index')}}" class="btn btn-icon btn-lg draggable-handle">
                                                    <i class="fa fa-users text-white"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <!--end::Svg Icon-->
                                    </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <a href="{{route('marketing.client.index')}}" class="text-dark font-weight-bold mb-3">Clients</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="subheader subheader-transparent " id="kt_subheader">
                <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center flex-wrap mr-1">
                        <!--begin::Page Heading-->
                        <div class="d-flex align-items-baseline flex-wrap mr-5">
                            <!--begin::Page Title-->
                            <h5 class="text-dark font-weight-bold my-1 mr-5">HRD</h5>
                            <!--end::Page Title-->
                            <!--end::Page Heading-->
                        </div>
                        <!--end::Info-->
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row mb-5">
            <div class="col-lg-2 col-xl-2 draggable-zone">
                <!--begin::Iconbox-->
                <div class="card card-custom wave gutter-b draggable wave-animate-slow wave-success mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center p-5">
                            <div class="">
                                    <span class="svg-icon svg-icon-4x">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                        <div class="symbol symbol-success">
                                            <span class="symbol-label font-size-h5">
                                                <a href="{{route('employee.index')}}" class="btn btn-icon btn-lg draggable-handle">
                                                    <i class="fa fa-users text-white"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <!--end::Svg Icon-->
                                    </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <a href="{{route('employee.index')}}" class="text-dark font-weight-bold mb-3">Employee</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xl-2 draggable-zone">
                <!--begin::Iconbox-->
                <div class="card card-custom wave gutter-b draggable wave-animate-slow wave-warning mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center p-5">
                            <div class="">
                                    <span class="svg-icon svg-icon-4x">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                        <div class="symbol symbol-warning">
                                            <span class="symbol-label font-size-h5">
                                                <a href="{{route('overtime.index')}}" class="btn btn-icon btn-lg draggable-handle">
                                                    <i class="fa fa-moon text-white"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <!--end::Svg Icon-->
                                    </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <a href="{{route('overtime.index')}}" class="text-dark font-weight-bold mb-3">Overtime</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xl-2 draggable-zone">
                <!--begin::Iconbox-->
                <div class="card card-custom wave gutter-b draggable wave-animate-slow wave-primary mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center p-5">
                            <div class="">
                                    <span class="svg-icon svg-icon-4x">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                        <div class="symbol symbol-primary">
                                            <span class="symbol-label font-size-h5">
                                                <a href="{{route('employee.loan')}}" class="btn btn-icon btn-lg draggable-handle">
                                                    <i class="fa fa-newspaper text-white"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <!--end::Svg Icon-->
                                    </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <a href="{{route('employee.loan')}}" class="text-dark font-weight-bold mb-3">Employee Loan</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xl-2 draggable-zone">
                <!--begin::Iconbox-->
                <div class="card card-custom wave gutter-b draggable wave-animate-slow wave-warning mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center p-5">
                            <div class="">
                                    <span class="svg-icon svg-icon-4x">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                        <div class="symbol symbol-warning">
                                            <span class="symbol-label font-size-h5">
                                                <a href="{{route('leave.request')}}" class="btn btn-icon btn-lg draggable-handle">
                                                    <i class="fa fa-luggage-cart text-white"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <!--end::Svg Icon-->
                                    </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <a href="{{route('leave.request')}}" class="text-dark font-weight-bold mb-3">Leave Request</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xl-2 draggable-zone">
                <!--begin::Iconbox-->
                <div class="card card-custom wave gutter-b draggable wave-animate-slow mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center p-5">
                            <div class="">
                                    <span class="svg-icon svg-icon-4x">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                        <div class="symbol symbol-dark">
                                            <span class="symbol-label font-size-h5">
                                                <a href="{{route('leave.index')}}" class="btn btn-icon btn-lg draggable-handle">
                                                    <i class="fa fa-luggage-cart text-white"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <!--end::Svg Icon-->
                                    </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <a href="{{route('leave.index')}}" class="text-dark font-weight-bold mb-3">Leave Approval</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-lg-2 col-xl-2 draggable-zone">
                <!--begin::Iconbox-->
                <div class="card card-custom wave gutter-b draggable wave-animate-slow wave-danger mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center p-5">
                            <div class="">
                                    <span class="svg-icon svg-icon-4x">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                        <div class="symbol symbol-danger">
                                            <span class="symbol-label font-size-h5">
                                                <a href="{{route('payroll.index')}}" class="btn btn-icon btn-lg draggable-handle">
                                                    <i class="fa fa-award text-white"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <!--end::Svg Icon-->
                                    </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <a href="{{route('payroll.index')}}" class="text-dark font-weight-bold mb-3">Payroll</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xl-2 draggable-zone">
                <!--begin::Iconbox-->
                <div class="card card-custom wave gutter-b draggable wave-animate-slow wave-success mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center p-5">
                            <div class="">
                                    <span class="svg-icon svg-icon-4x">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                        <div class="symbol symbol-success">
                                            <span class="symbol-label font-size-h5">
                                                <a href="{{route('to.index')}}" class="btn btn-icon btn-lg draggable-handle">
                                                    <i class="fa fa-plane-departure text-white"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <!--end::Svg Icon-->
                                    </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <a href="{{route('to.index')}}"><a class="text-dark font-weight-bold mb-3">Travel Order</a></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-xl-2 draggable-zone">
                <!--begin::Iconbox-->
                <div class="card card-custom wave gutter-b draggable wave-animate-slow wave-info mb-8 mb-lg-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center p-5">
                            <div class="">
                                    <span class="svg-icon svg-icon-4x">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
                                        <div class="symbol symbol-info">
                                            <span class="symbol-label font-size-h5">
                                                <a href="{{route('subsidies.index')}}" class="btn btn-icon btn-lg draggable-handle">
                                                    <i class="fa fa-hand-holding-usd text-white"></i>
                                                </a>
                                            </span>
                                        </div>
                                        <!--end::Svg Icon-->
                                    </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <a href="{{route('subsidies.index')}}" class="text-dark font-weight-bold mb-3">Subsidies</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalGuide" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Guide</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{asset('media/Flowchart.png')}}" style="width: 100%" alt="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom_script')
    <script src='{{asset('theme/assets/plugins/custom/draggable/draggable.bundle.js')}}'></script>
    <script src='{{asset('theme/assets/js/pages/features/cards/draggable.js')}}'></script>
    <script>
        $(document).ready(function(){
        })
    </script>
@endsection
