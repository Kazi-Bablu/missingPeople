@extends('layouts.app')

@section('title')
    Add Upazila
@endsection

@section('message')

    @if(Session::has('message'))
        <div class="col-m-10">
            <div  class="alert alert-success" role="alert">
                {{session::get('message')}}
            </div>
        </div>
    @endif

@endsection

@section('content')
    <section class="content">
        <div class="container">
            <div class="btn-group pull-right">
                <a href="{{url('upazila/view')}}" class="btn btn-primary btn-flat"><i class="fa fa-list"></i>
                    View Upazila</a>
            </div>
            <br>
            <br>
            <h2>Add Upazila</h2>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        {!! Form::open(['id'=>'form','url'=> '/upazila/create']) !!}
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group {{$errors->has('district_id')?'has-error':''}}">
                                <label>District Name</label>
                                <select name="district_id" class="form-control selectpicker"
                                        data-live-search="true"
                                        data-size="6"
                                        title="Select District">
                                    @foreach($districts as $district)
                                        <option value="{!! $district->id !!}">{!! $district->district_name !!}</option>
                                    @endforeach
                                </select>
                                <p class="help-block">{{$errors->first('district_id')}}</p>
                            </div>
                            <div class="form-group {{$errors->has('upazila_name')?'has-error':''}}">
                                <label>Upazila Name</label>
                                <input type="text" name="upazila_name" class="form-control" value="{{old('upazila_name')}}">
                                <p class="help-block">{{$errors->first('upazila_name')}}</p>
                            </div>

                        </div>
                        <div class="box-footer">
                            <div class="col-md-12">
                                <button type="reset" value="Reset" class="btn btn-warning pull-left"><i
                                            class="fa fa-eraser"></i> Clear
                                </button>
                                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>Add Upazila
                                </button>
                            </div>
                        </div>

                    </div>


                    {!! Form::close() !!}

                </div>
            </div>
        </div>

    </section>

@endsection

@section('js')

@endsection