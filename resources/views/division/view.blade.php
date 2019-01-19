@extends('layouts.app')

@section('title')
    view Division
@endsection
@section('message')
    @if(Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{Session::get('message')}}
        </div>
    @endif
@endsection

@section('content')
    <div class="col-md-12">
        <div class="btn-group pull-right">
            <a href="{{url('/division/create')}}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i>
                Add Division</a>
        </div>
        <br>
        <br>
        <br>
        <table class="table table-bordered">
            <tr class="success">
                <th>ID</th>
                <th>Division Name</th>

                <th>Action</th>
            </tr>
            @foreach($divisions as $division)
                <tr>
                    <td>{{$division->id}}</td>
                    <td>{{$division->division_name}}</td>
                    <td>
                        <div class="btn btn-default">
                            <a href="{{ url('/division',[$division->id,'edit']) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>
                        </div>

                        <div class="btn btn-danger">
                            <a class="delete_link" href="{{ url('/division',[$division->id,'delete']) }}"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a>
                        </div>
                    </td>

                </tr>
            @endforeach

        </table>
        {{ $divisions->render() }}
    </div>

@endsection

@section('js')

@endsection