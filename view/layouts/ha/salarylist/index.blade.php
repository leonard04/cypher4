@extends('layouts.template')
@section('content')
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <h3>Salary List</h3><br>

            </div>

        </div>

        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach($types as $type)
                    <li class="nav-item">
                        <a class="nav-link @if($type->id == 1) active @endif" id="home-tab" data-toggle="tab" href="#list{{$type->id}}">
                        <span class="nav-icon">
                            <i class="flaticon-folder-1"></i>
                        </span>
                            <span class="nav-text">{{$type->name}}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content mt-5" id="myTabContent">
                @foreach($types as $type)
                    <div class="tab-pane fade show @if($type->id == 1) active @endif" id="list{{$type->id}}" role="tabpanel" aria-labelledby="home-tab">
                        {{$type->name}}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('custom_script')

@endsection
