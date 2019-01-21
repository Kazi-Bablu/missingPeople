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
            <a href="{{url('/district/create')}}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i>
                Add District</a>
        </div>
        <br>
        <br>
        <br>
        <h2>View District</h2>
        <table class="table table-bordered">
            <tr class="success">
                <th>ID</th>
                <th>Division Name</th>
                <th>District Name</th>

                <th>Action</th>
            </tr>
            @foreach($districts as $district)
                <tr>
                    <td>{{$district->id}}</td>
                    <td>{{$district->division_name}}</td>
                    <td>{{$district->district_name}}</td>
                    <td>
                        <div class="btn btn-default">
                            <a href="{{ url('/district',[$district->id,'edit']) }}"><i class="fas fa-edit"></i> Edit</a>
                        </div>

                        <div class="btn btn-danger">
                            <a class="delete_link" href="{{ url('/district',[$district->id,'delete']) }}"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                        </div>
                    </td>

                </tr>
            @endforeach

        </table>
        {{ $districts->render() }}
    </div>

@endsection

@section('js')

@endsection