@extends('layouts.app')

@section('title')
    Edit District
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
                <a href="{{url('district/view')}}" class="btn btn-primary btn-flat"><i class="fa fa-list"></i>
                    View District</a>
            </div>
            <br>
            <br>
            <h2>Update District</h2>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        {!! Form::open(['id'=>'form','url'=> 'district/' . $districtById->id . '/update']) !!}
                        <div class="col-md-6 col-md-offset-3">

                            <div class="form-group {{$errors->has('division_id')?'has-error':''}}">
                                <label>Division Name</label>
                                <select name="division_id" class="form-control selectpicker"
                                        data-live-search="true"
                                        data-size="6"
                                        title="Select Division">
                                    @foreach($divisions as $division)
                                        <option value="{!! $division->id !!}">{!! $division->division_name !!}</option>
                                    @endforeach
                                </select>
                                <p class="help-block">{{$errors->first('division_id')}}</p>
                            </div>
                            <div class="form-group {{$errors->has('district_name')?'has-error':''}}">
                                <label>District Name</label>
                                <input type="text" name="district_name" class="form-control" value="{{$districtById->district_name}}">
                                <p class="help-block">{{$errors->first('district_name')}}</p>
                            </div>

                        </div>
                        <div class="box-footer">
                            <div class="col-md-12">
                                <button type="reset" value="Reset" class="btn btn-warning pull-left"><i
                                            class="fa fa-eraser"></i> Clear
                                </button>
                                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>Update District
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
    $('select[name=division_id]').selectpicker('val', '{{old('division_id')?old('division_id'):$districtById->division_id}}');
@endsection