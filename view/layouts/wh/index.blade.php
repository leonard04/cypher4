@extends('layouts.template')
@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3>Warehouse List</h3><br>

            </div>
            <div class="card-toolbar">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addItem"><i class="fa fa-plus"></i>Add Warehouse</button>
                </div>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            {{--            <h5><span class="span">This page contains a list of Travel Order which has been formed.</span></h5>--}}
            <table class="table display">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Warehouse Name</th>
                    <th class="text-center">Address</th>
                    <th class="text-center">Phone</th>
                    <th class="text-center">PIC</th>
                    <th class="text-center">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @foreach($whs as $key => $val)
                    <tr>
                        <td class="text-center">{{($key+1)}}</td>
                        <td class="text-center"><button type="button" class="btn btn-link" data-toggle="modal" data-target="#editItem{{$val->id}}">{{$val->name}}</button></td>
                        <div class="modal fade" id="editItem{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="addEmployee" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Warehouse</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <form method="post" action="{{route('wh.update')}}" >
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label text-right">Warehouse Name</label>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="name" placeholder="Warehouse Name" value="{{$val->name}}">
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" value="{{$val->id}}">
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label text-right">Address</label>
                                                <div class="col-md-6">
                                                    <textarea name="address" id="" class="form-control" cols="30" rows="10">{{$val->address}}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label text-right">Telephone</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="telephone" class="form-control" placeholder="Telephone" value="{{$val->telephone}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label text-right">PIC</label>
                                                <div class="col-md-6">
                                                    <input type="text" name="pic" class="form-control" placeholder="PIC" value="{{$val->pic}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                            <button type="submit" name="submit" class="btn btn-primary font-weight-bold">
                                                <i class="fa fa-check"></i>
                                                Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <td class="text-center">{{$val->address}}</td>
                        <td class="text-center">{{$val->telephone}}</td>
                        <td class="text-center">{{$val->pic}}</td>
                        <td class="text-center">
                            <a class="btn btn-danger btn-xs dttb" href="{{route('wh.delete',['id'=> $val->id])}}" title="Delete" onclick="return confirm('Are you sure you want to delete?'); ">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="addEmployee" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Warehouse</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form method="post" action="{{route('wh.store')}}" >
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-right">Warehouse Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" placeholder="Warehouse Name">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-right">Address</label>
                            <div class="col-md-6">
                                <textarea name="address" id="" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-right">Telephone</label>
                            <div class="col-md-6">
                                <input type="text" name="telephone" class="form-control" placeholder="Telephone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-right">PIC</label>
                            <div class="col-md-6">
                                <input type="text" name="pic" class="form-control" placeholder="PIC">
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
@endsection
@section('custom_script')
@endsection
