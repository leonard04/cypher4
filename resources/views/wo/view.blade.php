@extends('layouts.template')

@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3>Work Order Detail</h3><br>
            </div>
            <div class="card-toolbar">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{URL::route('general.wo')}}" class="btn btn-success btn-xs"><i class="fa fa-arrow-circle-left"></i></a>
                </div>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <div class="card card-custom bg-primary m-5">
                <div class="separator separator-solid separator-white opacity-20"></div>
                <div class="card-body text-white">
                    <div class="row">
                        <table class="text-white font-size-sm" style="margin-right: 100px">
                            <tbody>
                            <tr>
                                <td>PO#</td>
                                <td>:</td>
                                <td>
                                    <b>{{$po->wo_num}}</b>
                                </td>
                            </tr>
                            <tr>
                                <td>Request Date</td>
                                <td>:</td>
                                <td>
                                    {{date('d M Y', strtotime($po->created_at))}}
                                </td>
                            </tr>
                            <tr>
                                <td>Division</td>
                                <td>:</td>
                                <td>
                                    {{$po->division}}
                                </td>
                            </tr>
                            <tr>
                                <td>Reference</td>
                                <td>:</td>
                                <td>
                                    {{$po->reference}}
                                </td>
                            </tr>
                            <tr>
                                <td>Supplier</td>
                                <td>:</td>
                                <td>
                                    {{$vendor_name[$po->supplier_id]}}
                                </td>
                            </tr>
                            <tr>
                                <td>Currency</td>
                                <td>:</td>
                                <td>
                                    {{$po->currency}}
                                </td>
                            </tr>
                            <tr>
                                <td>Notes</td>
                                <td>:</td>
                                <td>
                                    {{strip_tags($po->notes)}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="text-white font-size-sm">
                            <tbody>
                            <tr>
                                <td>Project</td>
                                <td>:</td>
                                <td>
                                    <b>{{$pro_name[$po->project]}}</b>
                                </td>
                            </tr>
                            <tr>
                                <td>Deliver To</td>
                                <td>:</td>
                                <td>
                                    {{strip_tags($po->deliver_to)}}
                                </td>
                            </tr>
                            <tr>
                                <td>Deliver Time</td>
                                <td>:</td>
                                <td>
                                    {{strip_tags($po->deliver_time)}}
                                </td>
                            </tr>
                            <tr>
                                <td>Terms</td>
                                <td>:</td>
                                <td>
                                    {{strip_tags($po->terms)}}
                                </td>
                            </tr>
                            <tr>
                                <td>Terms of Payment</td>
                                <td>:</td>
                                <td>
                                    {{strip_tags($po->terms_payment)}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="separator separator-dashed separator-border-2 separator-primary"></div>
            <div class="m-5">
                <table class="table display table-bordered" width="100%">
                    <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-left">Job Description</th>
                        <th class="text-center">Qty</th>
                        <th class="text-right">Price per Unit</th>
                        <th class="text-right">Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $total =0; ?>
                    @foreach($po_detail as $key => $item)
                        <tr>
                            <td align="center">{{$key + 1}}</td>
                            <td>{{$item->job_desc}}</td>
                            <td align="center">{{$item->qty}}</td>
                            <td align="right">{{number_format($item->unit_price, 2)}}</td>
                            <td align="right">{{number_format($item->unit_price * $item->qty, 2)}}</td>
                            <?php
                            /** @var TYPE_NAME $item */
                            $total += ($item->unit_price * $item->qty);
                            ?>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="4" align="right">Sub Total</td>
                        <td align="right">{{number_format($total, 2)}}</td>
                    </tr>
                    <tr>
                        <td colspan="4" align="right">Discount</td>
                        <td align="right">{{number_format($po->discount, 2)}}</td>
                    </tr>
                    <tr>
                        <td colspan="4" align="right">Net include Discount</td>
                        <td align="right">{{number_format($total - $po->discount, 2)}}</td>
                    </tr>
                    <?php $tot = $total - $po->discount; ?>
                    @foreach(json_decode($po->ppn) as $kppn => $vppn)
                        <tr>
                            <td colspan="4" align="right">{{$tax_name[$vppn]}}</td>
                            <td align="right">
                                <?php
                                $sum = $total - $po->discount;
                                $p = eval('return '.$formula[$vppn].';');
                                $ppn_sum = $p;
                                $tot += $ppn_sum;
                                ?>
                                {{number_format($ppn_sum, 2)}}
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" align="right">Total After Tax</td>
                        <td align="right">{{number_format($tot, 2)}}</td>
                    </tr>
                    <tr>
                        <td colspan="4" align="right">Down Payment</td>
                        <td align="right">{{number_format($po->dp, 2)}}</td>
                    </tr>
                    <tr>
                        <td colspan="4" align="right">Total Due</td>
                        <td align="right">{{number_format($tot - $po->dp, 2)}}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <hr>
        </div>
    </div>
@endsection

@section('custom_script')
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{asset('theme/tinymce/tinymce.min.js')}}"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script>
        $(document).ready(function(){

            tinymce.init({
                editor_selector : ".form-control",
                selector:'textarea',
                mode : "textareas",
                menubar: false,
                toolbar: false
            });

            $("select.select2").select2({
                width: 200
            })
            $("table.display").DataTable({
                "searching": false,
                "lengthChange": false,
                "ordering": false,
                "aaSorting": [],
                "paging":   false,
                "info":     false,
            })

        })
    </script>
@endsection
