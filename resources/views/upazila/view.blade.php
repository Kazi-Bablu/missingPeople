@extends('layouts.app')

@section('title')
    view District
@endsection
@section('message')
    @if(Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{Session::get('message')}}
        </div>
    @endif
@endsection

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="btn-group pull-right">
            <a href="{{url('/upazila/create')}}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i>
                Add Upazila</a>
        </div>
        <br>
        <br>
        <br>
        <h2>View Upazila</h2>
        <table class="table table-bordered">
            <tr class="success">
                <th>ID</th>
                <th>Division Name</th>
                <th>District Name</th>

                <th>Action</th>
            </tr>
            @foreach($upazilas as $upazila)
                <tr>
                    <td>{{$upazila->id}}</td>
                    <td>{{$upazila->district_name}}</td>
                    <td>{{$upazila->upazila_name}}</td>
                    <td>
                        <div class="btn btn-default">
                            <a href="{{ url('/upazila',[$upazila->id,'edit']) }}"><i class="fas fa-edit"></i> Edit</a>
                        </div>

                        <div class="btn btn-danger">
                            <a class="delete_link" href="{{ url('/upazila',[$upazila->id,'delete']) }}"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                        </div>
                    </td>

                </tr>
            @endforeach

        </table>
        {{ $upazilas->render() }}
    </div>

@endsection

@section('js')

@endsection