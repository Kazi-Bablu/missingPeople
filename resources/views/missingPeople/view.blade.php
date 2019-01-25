@extends('layouts.app')

@section('title')
    view Missing People
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
            <a href="{{url('/missing/people/create')}}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i>
                Add Missing People</a>
        </div>
        <br>
        <br>
        <br>
        <h2>View Missing People</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr class="success">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Contact</th>
                    <th>Missing Date</th>
                    <th>Division</th>
                    <th>District</th>
                    <th>Upazila</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Post Creator</th>
                    <th>Action</th>
                </tr>
                @foreach($missingPeoples as $missingPeople)
                    <tr style="font-size: small">
                        <td>{{$missingPeople->id}}</td>
                        <td>{{$missingPeople->missing_person_name}}</td>
                        <td>{{$missingPeople->missing_person_age}}</td>
                        <td>{{$missingPeople->contact_number}}</td>
                        <td>{{date('d-m-Y', strtotime($missingPeople->missing_date))}}</td>
                        <td>{{$missingPeople->division_name}}</td>
                        <td>{{$missingPeople->district_name}}</td>
                        <td>{{$missingPeople->upazila_name}}</td>
                        <td>{{$missingPeople->missing_person_description}}</td>
                        <td><img class="img-responsive"
                                 src="{{ asset('storage/images/'.$missingPeople->missing_image) }}"/></td>
                        {{--<td>{{$missingPeople->missing_image}}</td>--}}
                        <td>{{$missingPeople->name}}</td>
                        <td>
                            <div class="btn btn-default">
                                <a href="{{ url('/missing/people',[$missingPeople->id,'edit']) }}"><i
                                            class="fas fa-edit"></i> Edit</a>
                            </div>

                            <div class="btn btn-danger">
                                <a class="delete_link"
                                   href="{{ url('/missing/people',[$missingPeople->id,'delete']) }}"><i
                                            class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                            </div>
                        </td>

                    </tr>
                @endforeach

            </table>
        </div>
        {{ $missingPeoples->render() }}
    </div>

@endsection

@section('js')

@endsection