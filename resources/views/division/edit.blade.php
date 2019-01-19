@extends('layouts.app')

@section('title')
    Edit division
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
            <h2>Edit Division</h2>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        {!! Form::open(['id'=>'form','url'=> 'division/' . $divisionById->id . '/update']) !!}
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group {{$errors->has('division_name')?'has-error':''}}">
                                <label>Division Name</label>
                                <input type="text" name="division_name" class="form-control" value="{{$divisionById->division_name}}">
                                <p class="help-block">{{$errors->first('division_name')}}</p>
                            </div>

                        </div>
                        <div class="box-footer">
                            <div class="col-md-12">
                                <button type="reset" value="Reset" class="btn btn-warning pull-left"><i
                                            class="fa fa-eraser"></i> Clear
                                </button>
                                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>Add Update
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