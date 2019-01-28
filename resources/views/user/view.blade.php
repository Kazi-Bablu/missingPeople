@extends('layouts.app')

@section('title')
    view Users
@endsection
@section('message')
    @if(Session::has('message'))
        <div class="alert alert-success" role="alert">
            {{Session::get('message')}}
        </div>
    @endif
@endsection

@section('content')
    <div class="col-md-9 col-md-offset-2">
        <div class="btn-group pull-right">
            {{--<a href="{{url('/division/create')}}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i>--}}
                {{--Add Division</a>--}}
        </div>
        <br>
        <br>
        <br>
        <h2>View User</h2>
        <table class="table table-bordered">
            <tr class="success">
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>User Role</th>
                <th>Occupation</th>
                <th>Division Name</th>
                <th>District Name</th>
                <th>Upazila Name</th>

                <th>Action</th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->user_role}}</td>
                    <td>{{$user->occupation}}</td>
                    <td>{{$user->division_name}}</td>
                    <td>{{$user->district_name}}</td>
                    <td>{{$user->upazila_name}}</td>
                    <td>
                        <div class="btn btn-default">
                            <a href="{{ url('/user',[$user->id,'edit']) }}"><i class="fas fa-edit"></i> Edit</a>
                        </div>

                        <div class="btn btn-danger">
                            <a class="delete_link" href="{{ url('/user',[$user->id,'delete']) }}"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                        </div>
                    </td>

                </tr>
            @endforeach

        </table>
        {{ $users->render() }}
    </div>

@endsection

@section('js')

@endsection