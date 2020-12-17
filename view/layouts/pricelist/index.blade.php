@extends('layouts.template')
@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3>Price List</h3><br>

            </div>

        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#all">
                        <span class="nav-icon">
                            <i class="flaticon-folder-1"></i>
                        </span>
                        <span class="nav-text">Item PO</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#cost" aria-controls="profile">
                        <span class="nav-icon">
                            <i class="flaticon-folder-3"></i>
                        </span>
                        <span class="nav-text">Job Desc WO</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content mt-5" id="myTabContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="home-tab">
                    <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <table class="table table-bordered table-hover display font-size-sm" style="margin-top: 13px !important; width: 100%;">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-left">Item Code</th>
                                <th class="text-left">Item Name</th>
                                <th class="text-left">Category</th>
                                <th class="text-right">Price</th>
                                <th class="text-right">UoM</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pricelists as $key =>$val)
                                <tr>
                                    <td class="text-center">{{($key+1)}}</td>
                                    <td class="text-left"><a href="#" class="btn btn-xs btn-link"><i class="fa fa-search"></i>{{$val->item_id}}</a> </td>
                                    <td class="text-left">{{$val->itemName}}</td>
                                    <td class="text-left">{{$val->catName}}</td>
                                    <td class="text-right">{{$val->itemPrice}}</td>
                                    <td class="text-right">{{$val->itemUom}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="cost" role="tabpanel" aria-labelledby="contact-tab">
                    <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <table class="table table-bordered table-hover display font-size-sm" style="margin-top: 13px !important; width: 100%;">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-left">Paper Number#</th>
                                <th class="text-left">Job Description</th>
                                <th class="text-left">Supplier</th>
                                <th class="text-left">Project</th>
                                <th class="text-right">Price</th>
                                <th class="text-right">Qty</th>
                                <th class="text-right">Total Price</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_script')

@endsection
