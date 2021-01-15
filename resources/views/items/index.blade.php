@extends('layouts.template')

@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3>Item Database</h3><br>
            </div>
            @actionStart('item_database', 'create')
            <div class="card-toolbar">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{URL::route('items.revision')}}" class="btn btn-warning mr-2"><span class="label label-light-danger mr-2">{{$itemsup}}</span> Item Revision</a>
                    <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#addItem"><i class="fa fa-plus"></i>New Items</button>
{{--                    <a href="{{URL::route('item_class.index',['category'=>$categories->id])}}" class="btn btn-info mr-2"><i class="fa fa-object-group"></i> Item Classification</a>--}}
                    <a href="{{route('items.class.index',['category' =>$categories->id])}}" class="btn btn-xs btn-success ml-3"><i class="fa fa-arrow-left"></i></a>
                </div>
                <!--end::Button-->
            </div>
            @actionEnd
        </div>
        <div class="card-body">
            <table class="table display">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-left">Item Name</th>
                        <th class="text-left">Category</th>
                        <th class="text-left">Type</th>
                        <th class="text-center">Code</th>
                        <th class="text-center">Minimal Stock</th>
                        <th class="text-center">UoM</th>
                        <th class="text-center">Company</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @actionStart('item_database', 'read')
                    @foreach($items as $key => $item)
                        <tr>
                            <td align="center">{{$key + 1}}</td>
                            <td><button class="btn btn-link"  data-toggle="modal" data-target="#editItem" onclick="edit_item({{$item->id}})">{{$item->name}}</button></td>
                            <td>{{$item->catName}}</td>
                            <td>{{($item->type_id == 1) ? "Consumable" : "Non Consumable"}}</td>
                            <td align="center">{{$item->item_code}}</td>
                            <td align="center">{{$item->minimal_stock}}</td>
                            <td align="center">{{$item->uom}}</td>
                            <td align="center">
                                {{$view_company[$item->company_id]->tag}}
                            </td>
                            <td align="center">
                                <button class="btn btn-danger btn-xs btn-icon" onclick="delete_item({{$item->id}})"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    @actionEnd
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="addEmployee" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form method="post" action="{{URL::route('items.add')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <h4>Basic Information</h4>
                        <hr>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-right">Item Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Item Name" name="item_name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-right">Item Category</label>
                            <div class="col-md-6">
                                <input type="text" readonly name="" id="" class="form-control" value="{{$categories->name}}">
                                <input type="hidden" name="category" id="category" value="{{$categories->id}}">
                                <input type="hidden" name="category_code" id="category_code" value="{{$categories->code}}">
                                <input type="hidden" name="inventory" value="1">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-right">Item Classification</label>
                            <div class="col-md-6">
                                <select name="classification" id="classification" class="form-control">
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-right">Brand Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Brand Name" name="item_series" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-right">Serial Number</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Serial Number" name="serial_number" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-right">Item Code</label>
                            <div class="col-md-6">
                                <input type="hidden" name="code" id="code">
                                <input type="text" class="form-control" placeholder="Item Code" name="item_code" id="item_code" readonly>
                            </div>
                        </div>

                        <br>
                        <h4>Detail Info</h4>
                        <hr>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-right">Type</label>
                            <div class="col-md-6">
                                <select name="type" id="" class="form-control" required>
                                    <option value="1">Consumable</option>
                                    <option value="2">Non Consumable</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-right">Minimal Stock</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" placeholder="Minimal Stock" name="min_stock" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-right">UoM</label>
                            <div class="col-md-6">
                                <select name="uom" id="uom" class="form-control" required>
                                    <option value="">- Select UOM -</option>
                                    @foreach($uom as $v)
                                        <option value="{{$v}}">{{$v}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-right">Picture</label>
                            <div class="col-md-6">
                                <div class="col-lg-9 col-xl-6">
                                    <div class="image-input image-input-outline" id="printed_logo">
                                        <div class="image-input-wrapper"></div>
                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" name="pict" id="p_logo_add" accept=".png, .jpg, .jpeg" />
                                        </label>
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-right">Notes</label>
                            <div class="col-md-6">
                                <textarea name="notes" class="form-control" id="" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-right">Specification</label>
                            <div class="col-md-6">
                                <textarea name="specification" class="form-control" id="" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary font-weight-bold">
                            <i class="fa fa-check"></i>
                            Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editItem" tabindex="-1" role="dialog" aria-labelledby="addEmployee" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form method="post" action="{{URL::route('items.edit')}}" id="form-edit" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h4>Basic Information</h4>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Item Name</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Item Name" name="item_name" id="item_name" required>
                                    </div>
                                </div>
{{--                                <div class="form-group row">--}}
{{--                                    <label class="col-md-2 col-form-label text-right">Item Code</label>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <input type="text" class="form-control" placeholder="Item Code" name="item_code" required>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Brand Name</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Brand Name" id="item_series" name="item_series" required>
                                    </div>
                                </div>
{{--                                <div class="form-group row">--}}
{{--                                    <label class="col-md-2 col-form-label text-right">Supplier</label>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <select name="supplier" id="supplier" class="form-control select2" required>--}}
{{--                                            <option value="">Select Supplier</option>--}}
{{--                                            @foreach($vendor as $value)--}}
{{--                                                <option value="{{$value->id}}">{{ucwords($value->name)}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Item Category</label>
                                    <div class="col-md-6">
                                        <input type="text" readonly name="" id="" class="form-control" value="{{$categories->name}}">
                                        <input type="hidden" name="category"value="{{$categories->id}}">
                                    </div>
                                </div>
{{--                                <div class="form-group row">--}}
{{--                                    <label class="col-md-2 col-form-label text-right">Price</label>--}}
{{--                                    <div class="col-md-6">--}}
{{--                                        <input type="number" class="form-control" placeholder="Price" id="price" name="price" required>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <input type="hidden" name="class_hidden" id="class_hidden" value="{{$class}}">
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Serial Number</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Serial Number" id="serial_number" name="serial_number" required>
                                    </div>
                                </div>
                                <br>
                                <h4>Detail Info</h4>
                                <hr>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Type</label>
                                    <div class="col-md-6">
                                        <select name="type" id="type" class="form-control" required>
                                            <option value="1">Consumable</option>
                                            <option value="2">Non Consumable</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Minimal Stock</label>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" placeholder="Minimal Stock" id="minimal_stock" name="min_stock" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">UoM</label>
                                    <div class="col-md-6">
                                        <select name="uom" id="uomedit" class="form-control" required>
                                            <option value="">- Select UOM -</option>
                                            @foreach($uom as $v)
                                                <option value="{{$v}}">{{$v}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Picture</label>
                                    <div class="col-md-9">
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="image-input image-input-outline" id="app_logo">
                                                <div class="image-input-wrapper"></div>
                                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change">
                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                    <input type="file" name="pict" id="p_logo_edit" accept=".png, .jpg, .jpeg" />
                                                </label>
                                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                            </div>
                                            <span class="form-text text-muted">
                                        <div class="checkbox-inline">
                                            <label class="checkbox checkbox-success">
                                                <input type="checkbox" name="del_pict"/>
                                                <span></span>
                                                Check this to delete the picture
                                            </label>
                                        </div>
                                    </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Notes</label>
                                    <div class="col-md-6">
                                        <textarea name="notes" class="form-control" id="notes" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 col-form-label text-right">Specification</label>
                                    <div class="col-md-6">
                                        <textarea name="specification" class="form-control" id="specification" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
{{--                            <div class="col-md-4">--}}
{{--                                <h4>Quantity</h4>--}}
{{--                                <hr>--}}
{{--                                @foreach($warehouses as $key => $value)--}}
{{--                                    <div class="form-group row">--}}
{{--                                        <label class="col-md-4 col-form-label">{{$value->name}}</label>--}}
{{--                                        <div class="col-md-8">--}}
{{--                                            <input type="number" class="form-control stocks" id="wh{{$value->id}}" name="wh[{{$value->id}}]" readonly>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
{{--                                <div class="form-group row">--}}
{{--                                    <label for="" class="col-md-4 col-form-label">Total stock</label>--}}
{{--                                    <div class="col-md-8">--}}
{{--                                        <input type="number" readonly id="total-stock" class="form-control">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="form-group row" id="alert-stock">--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="alert alert-custom alert-light-danger">--}}
{{--                                            <div class="alert-icon">--}}
{{--                                                <i class="flaticon2-warning"></i>--}}
{{--                                            </div>--}}
{{--                                            <div class="alert-text">--}}
{{--                                                Please re-stock the item!--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="id_item" name="id_item">
                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                        <button type="button" onclick="button_edit()" class="btn btn-primary font-weight-bold">
                            <i class="fa fa-check"></i>
                            Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <input type="hidden" name="" id="jsonwh" value="{{json_encode($warehouses)}}">
@endsection

@section('custom_script')
    <script>

        var dataCategory, dataClass,dataCategoryCode,dataClassCode,paramItemCode,dataClas2;
        function delete_item(id) {
            Swal.fire({
                title: "Delete",
                text: "Delete this item?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
                reverseButtons: true,
            }).then(function(result){
                if(result.value){
                    $.ajax({
                        url: '{{URL::route('items.delete')}}',
                        data: {
                            '_token': '{{csrf_token()}}',
                            'id': id
                        },
                        type: "POST",
                        cache: false,
                        dataType: 'json',
                        success : function(response){
                            if (response.del = 1){
                                location.reload()
                            } else {
                                Swal.fire({
                                    title: "Delete",
                                    text: "Error",
                                    icon: "error"
                                })
                            }
                        }
                    })
                }
            })
        }
        function edit_item(id){
            $.ajax({
                url: '{{URL::route('items.find')}}',
                data: {
                    '_token': '{{csrf_token()}}',
                    'id': id
                },
                type: "POST",
                cache: false,
                dataType: 'json',
                success : function(response){
                    // console.log(response)
                    var json_wh = "{{json_encode($warehouses)}}".replaceAll("&quot;", "\"")
                    var wh = $("#jsonwh").val()
                    for (let i = 0; i < wh.length; i++) {
                        console.log(response.qtywh[wh[i].id])
                        var stock = 0
                        if (response.qtywh[wh[i].id] === null || response.qtywh[wh[i].id] === undefined){
                            stock = 0
                        } else {
                            stock = response.qtywh[wh[i].id]
                        }
                        $("#wh"+wh[i].id).val(stock)
                    }
                    // console.log(json_wh)
                    $("#id_item").val(response.item.id)
                    $("#item_name").val(response.item.name)
                    $("#item_code").val(response.item.item_code)
                    $("#item_series").val(response.item.item_series)
                    $("#serial_number").val(response.item.serial_number)
                    $("#price").val(response.item.price)
                    $("#notes").val(response.item.notes)
                    $("#specification").val(response.item.specification)
                    $("#minimal_stock").val(response.item.minimal_stock)
                    $("#supplier").val(response.item.supplier).trigger('change')
                    $("#category").val(response.item.category_id).trigger('change')
                    $("#type").val(response.item.type_id).trigger('change')
                    $("#uomedit").val(response.item.uom).trigger('change')
                    var stock = $(".stocks").toArray()
                    var total_stock = 0
                    for (const i in stock) {
                        console.log(stock[i].value)
                        total_stock += parseInt(stock[i].value)
                    }
                    $("#total-stock").val(total_stock)
                    if (total_stock < $("#minimal_stock").val()){
                        $("#alert-stock").show()
                    } else {
                        $("#alert-stock").hide()
                    }
                    if (response.item.picture !== null){
                        var imgUrl = "{{str_replace("\\", "/", asset('media/asset/'))}}/" + response.item.picture
                        $("#app_logo .image-input-wrapper").css('background-image', "url('"+imgUrl+"')")
                    }
                }
            })
        }
        function button_edit(){
            Swal.fire({
                title: "Edit data",
                text: "Are you sure you want to edit this data?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Edit",
                cancelButtonText: "Cancel",
                reverseButtons: true,
            }).then(function(result){
                if(result.value){
                    $("#form-edit").submit()
                }
            })
        }
        $(document).ready(function(){
            $("table.display").DataTable({
                fixedHeader: true,
                fixedHeader: {
                    headerOffset: 90
                }
            })
            // $("select.select2").select2({
            //     width: "100%"
            // })
            dataCategory = $('#category').val();
            dataClas2 = $('#class_hidden').val();
            dataCategoryCode = $('#category_code').val();
            // console.log(dataCategory)
            function getURLClass(){
                var url = "{{route('item_class.getclass',['id' => ':id1','class_id' => ':id2'])}}";
                url = url.replace(':id1', dataCategory);
                url = url.replace(':id2', dataClas2)
                return url;
            }

            $('#classification').select2({
                ajax:{
                    url: function (params) {
                        return getURLClass()
                    },
                    type: "GET",
                    placeholder: 'Choose Classification',
                    allowClear: true,
                    dataType: 'json',
                    data: function (params) {
                        return {
                            searchTerm: params.term,
                            "_token": "{{ csrf_token() }}",
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: false
                },
                width:"100%",
            }).on('select2:select',function () {
                dataClass = $('#classification').text();
                var code = dataClass.split("/")
                dataClassCode = code[1]
                // $('#opt4').show();

                // alert(dataClassCode)
                paramItemCode = dataCategoryCode+dataClassCode;
                // alert(paramItemCode)
                $.ajax({
                    url:"{{route('items.itemCodeFunction')}}",
                    type: 'GET',
                    data: {
                        classification: paramItemCode,
                    },
                    success: function(response){
                        var res = JSON.parse(response);
                        console.log(res.data)
                        $("#item_code").val(res.data);
                    }
                })

            })
        })
    </script>
@endsection
