@extends('layouts.template')
@section('content')
    <div class="container-fluid">

{{--        @actionStart('general', 'access')--}}
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
        <div class="row">
            <!--begin::Subheader-->
            <!--end::Subheader-->
            <div class="col-lg-2 draggable-zone">
                <!--begin::Card-->
                <div class="card card-custom gutter-b draggable d-flex align-items-center">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{route('fr.index')}}" class="btn btn-icon btn-lg btn-secondary draggable-handle">
                                <i class="fa fa-cube"></i>
                            </a>
                        </div>
                    </div>
                    <h5>Item Request</h5>
                </div>
                <!--end::Card-->
            </div>
            <div class="col-lg-2 draggable-zone">
                <!--begin::Card-->
                <div class="card card-custom gutter-b draggable d-flex align-items-center">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{route('general.so')}}" class="btn btn-icon btn-lg btn-danger draggable-handle">
                                <i class="fa fa-clipboard-list"></i>
                            </a>
                        </div>
                    </div>
                    <h5>Service Order</h5>
                </div>
                <!--end::Card-->
            </div>
            <div class="col-lg-2 draggable-zone">
                <!--begin::Card-->
                <div class="card card-custom gutter-b draggable d-flex align-items-center">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="#" class="btn btn-icon btn-lg btn-info draggable-handle">
                                <i class="fa fa-money-bill-wave"></i>
                            </a>
                        </div>
                    </div>
                    <h5>Cashbond</h5>
                </div>
                <!--end::Card-->
            </div>

            <div class="col-lg-2 draggable-zone">
                <!--begin::Card-->
                <div class="card card-custom gutter-b draggable d-flex align-items-center">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="#" class="btn btn-icon btn-lg btn-primary draggable-handle">
                                <i class="fa fa-file-invoice-dollar"></i>
                            </a>
                        </div>
                    </div>
                    <h5>Reimburse</h5>
                </div>
                <!--end::Card-->
            </div>
            <div class="col-lg-2 draggable-zone">
                <!--begin::Card-->
                <div class="card card-custom gutter-b draggable d-flex align-items-center">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{route('leave.index')}}" class="btn btn-icon btn-lg btn-warning draggable-handle">
                                <i class="fa fa-luggage-cart"></i>
                            </a>
                        </div>
                    </div>
                    <h5>Leave Request</h5>
                </div>
                <!--end::Card-->
            </div>
            <div class="col-lg-2 draggable-zone">
                <!--begin::Card-->
                <div class="card card-custom gutter-b draggable d-flex align-items-center">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{route('to.index')}}" class="btn btn-icon btn-lg btn-success draggable-handle">
                                <i class="fa fa-plane-departure"></i>
                            </a>
                        </div>
                    </div>
                    <h5>Travel Order</h5>
                </div>
                <!--end::Card-->
            </div>
        </div>
{{--        @actionEnd--}}

        <div class="row">
            <div class="subheader subheader-transparent " id="kt_subheader">
                <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center flex-wrap mr-1">
                        <!--begin::Page Heading-->
                        <div class="d-flex align-items-baseline flex-wrap mr-5">
                            <!--begin::Page Title-->
                            <h5 class="text-dark font-weight-bold my-1 mr-5">Asset</h5>
                            <!--end::Page Title-->
                            <!--end::Page Heading-->
                        </div>
                        <!--end::Info-->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!--begin::Subheader-->
            <!--end::Subheader-->
            <div class="col-lg-2 draggable-zone">
                <!--begin::Card-->
                <div class="card card-custom gutter-b draggable d-flex align-items-center">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{route('items.index')}}" class="btn btn-icon btn-lg btn-warning draggable-handle">
                                <i class="fa la-cubes"></i>
                            </a>
                        </div>
                    </div>
                    <h5>Items</h5>
                </div>
                <!--end::Card-->
            </div>
            <div class="col-lg-2 draggable-zone">
                <!--begin::Card-->
                <div class="card card-custom gutter-b draggable d-flex align-items-center">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="#" class="btn btn-icon btn-lg btn-primary draggable-handle">
                                <i class="fa fa-warehouse"></i>
                            </a>
                        </div>
                    </div>
                    <h5>Warehouse</h5>
                </div>
                <!--end::Card-->
            </div>
        </div>

        <div class="row">
            <div class="subheader subheader-transparent " id="kt_subheader">
                <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center flex-wrap mr-1">
                        <!--begin::Page Heading-->
                        <div class="d-flex align-items-baseline flex-wrap mr-5">
                            <!--begin::Page Title-->
                            <h5 class="text-dark font-weight-bold my-1 mr-5">Procurement</h5>
                            <!--end::Page Title-->
                            <!--end::Page Heading-->
                        </div>
                        <!--end::Info-->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!--begin::Subheader-->
            <!--end::Subheader-->
            <div class="col-lg-2 draggable-zone">
                <!--begin::Card-->
                <div class="card card-custom gutter-b draggable d-flex align-items-center">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{route('vendor.index')}}" class="btn btn-icon btn-lg btn-danger draggable-handle">
                                <i class="fa fa-handshake"></i>
                            </a>
                        </div>
                    </div>
                    <h5>Vendor</h5>
                </div>
                <!--end::Card-->
            </div>
            <div class="col-lg-2 draggable-zone">
                <!--begin::Card-->
                <div class="card card-custom gutter-b draggable d-flex align-items-center">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="#" class="btn btn-icon btn-lg btn-info draggable-handle">
                                <i class="fa fa-money-check-alt"></i>
                            </a>
                        </div>
                    </div>
                    <h5>Price List</h5>
                </div>
                <!--end::Card-->
            </div>
        </div>
        <div class="row">
            <div class="subheader subheader-transparent " id="kt_subheader">
                <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center flex-wrap mr-1">
                        <!--begin::Page Heading-->
                        <div class="d-flex align-items-baseline flex-wrap mr-5">
                            <!--begin::Page Title-->
                            <h5 class="text-dark font-weight-bold my-1 mr-5">PO & WO</h5>
                            <!--end::Page Title-->
                            <!--end::Page Heading-->
                        </div>
                        <!--end::Info-->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!--begin::Subheader-->
            <!--end::Subheader-->
            <div class="col-lg-2 draggable-zone">
                <!--begin::Card-->
                <div class="card card-custom gutter-b draggable d-flex align-items-center">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{route('pr.index')}}" class="btn btn-icon btn-lg btn-info draggable-handle">
                                <i class="fa fa-cash-register"></i>
                            </a>
                        </div>
                    </div>
                    <h5>Purchase Request</h5>
                </div>
                <!--end::Card-->
            </div>

            <div class="col-lg-2 draggable-zone">
                <!--begin::Card-->
                <div class="card card-custom gutter-b draggable d-flex align-items-center">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{route('pe.index')}}" class="btn btn-icon btn-lg btn-warning draggable-handle">
                                <i class="fa fa-search-dollar"></i>
                            </a>
                        </div>
                    </div>
                    <h5>Purchase Evaluation</h5>
                </div>
                <!--end::Card-->
            </div>
            <div class="col-lg-2 draggable-zone">
                <!--begin::Card-->
                <div class="card card-custom gutter-b draggable d-flex align-items-center">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{route('po.index')}}" class="btn btn-icon btn-lg btn-secondary draggable-handle">
                                <i class="fa fa-cart-arrow-down"></i>
                            </a>
                        </div>
                    </div>
                    <h5>Purchase Order</h5>
                </div>
                <!--end::Card-->
            </div>
            <div class="col-lg-2 draggable-zone">
                <!--begin::Card-->
                <div class="card card-custom gutter-b draggable d-flex align-items-center">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{route('general.wo')}}" class="btn btn-icon btn-lg btn-danger draggable-handle">
                                <i class="fa fa-headset"></i>
                            </a>
                        </div>
                    </div>
                    <h5>Service Request</h5>
                </div>
                <!--end::Card-->
            </div>
            <div class="col-lg-2 draggable-zone">
                <!--begin::Card-->
                <div class="card card-custom gutter-b draggable d-flex align-items-center">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="#" class="btn btn-icon btn-lg btn-success draggable-handle">
                                <i class="fa fa-users-cog"></i>
                            </a>
                        </div>
                    </div>
                    <h5>Work Order</h5>
                </div>
                <!--end::Card-->
            </div>
        </div>
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
        <div class="row">
            <!--begin::Subheader-->
            <!--end::Subheader-->
            <div class="col-lg-2 draggable-zone">
                <!--begin::Card-->
                <div class="card card-custom gutter-b draggable d-flex align-items-center">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{route('marketing.project')}}" class="btn btn-icon btn-lg btn-primary draggable-handle">
                                <i class="fa fa-folder-open"></i>
                            </a>
                        </div>
                    </div>
                    <h5>Projects</h5>
                </div>
                <!--end::Card-->
            </div>
            <div class="col-lg-2 draggable-zone">
                <!--begin::Card-->
                <div class="card card-custom gutter-b draggable d-flex align-items-center">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="#" class="btn btn-icon btn-lg btn-danger draggable-handle">
                                <i class="fa fa-users"></i>
                            </a>
                        </div>
                    </div>
                    <h5>Clients</h5>
                </div>
                <!--end::Card-->
            </div>
        </div>
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
        <div class="row">
            <!--begin::Subheader-->
            <!--end::Subheader-->
            <div class="col-lg-2 draggable-zone">
                <!--begin::Card-->
                <div class="card card-custom gutter-b draggable d-flex align-items-center">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{route('employee.index')}}" class="btn btn-icon btn-lg btn-success draggable-handle">
                                <i class="fa fa-users"></i>
                            </a>
                        </div>
                    </div>
                    <h5>Employee</h5>
                </div>
                <!--end::Card-->
            </div>
            <div class="col-lg-2 draggable-zone">
                <!--begin::Card-->
                <div class="card card-custom gutter-b draggable d-flex align-items-center">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{route('overtime.index')}}" class="btn btn-icon btn-lg btn-warning draggable-handle">
                                <i class="fa fa-moon"></i>
                            </a>
                        </div>
                    </div>
                    <h5>Overtime</h5>
                </div>
                <!--end::Card-->
            </div>
            <div class="col-lg-2 draggable-zone">
                <!--begin::Card-->
                <div class="card card-custom gutter-b draggable d-flex align-items-center">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{route('employee.loan')}}" class="btn btn-icon btn-lg btn-primary draggable-handle">
                                <i class="fa fa-newspaper"></i>
                            </a>
                        </div>
                    </div>
                    <h5>Employee Loan</h5>
                </div>
                <!--end::Card-->
            </div>
            <div class="col-lg-2 draggable-zone">
                <!--begin::Card-->
                <div class="card card-custom gutter-b draggable d-flex align-items-center">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{route('leave.index')}}" class="btn btn-icon btn-lg btn-secondary draggable-handle">
                                <i class="fa fa-luggage-cart"></i>
                            </a>
                        </div>
                    </div>
                    <h5>Leave Approval</h5>
                </div>
                <!--end::Card-->
            </div>
            <div class="col-lg-2 draggable-zone">
                <!--begin::Card-->
                <div class="card card-custom gutter-b draggable d-flex align-items-center">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{route('subsidies.index')}}" class="btn btn-icon btn-lg btn-info draggable-handle">
                                <i class="fa fa-hand-holding-usd"></i>
                            </a>
                        </div>
                    </div>
                    <h5>Subsidies</h5>
                </div>
                <!--end::Card-->
            </div>
            <div class="col-lg-2 draggable-zone">
                <!--begin::Card-->
                <div class="card card-custom gutter-b draggable d-flex align-items-center">
                    <div class="card-header">
                        <div class="card-title">
                            <a href="{{route('payroll.index')}}" class="btn btn-icon btn-lg btn-danger draggable-handle">
                                <i class="fa fa-award"></i>
                            </a>
                        </div>
                    </div>
                    <h5>Payroll</h5>
                </div>
                <!--end::Card-->
            </div>

        </div>
    </div>
@endsection
@section('custom_script')
    <script src='{{asset('theme/assets/plugins/custom/draggable/draggable.bundle.js')}}'></script>
    <script src='{{asset('theme/assets/js/pages/features/cards/draggable.js')}}'></script>
@endsection
