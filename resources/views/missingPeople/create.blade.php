@extends('layouts.app')

@section('title')
    Add Missing
@endsection

@section('message')

    @if(Session::has('message'))
        <div class="col-m-10">
            <div class="alert alert-success" role="alert">
                {{session::get('message')}}
            </div>
        </div>
    @endif

@endsection

@section('content')
    <section class="content">
        <div class="container">
            <div class="btn-group pull-right">
                <a href="{{url('missing/people/view')}}" class="btn btn-primary btn-flat"><i class="fa fa-list"></i>
                    View Missing</a>
            </div>
            <br>
            <br>
            <h2>Add Missing</h2>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        {!! Form::open(['id'=>'form','url'=> '/missing/people/create']) !!}
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-group {{$errors->has('missing_person_name')?'has-error':''}}">
                                <label>Missing Person Name</label>
                                <input type="text" name="missing_person_name" class="form-control"
                                       value="{{old('missing_person_name')}}">
                                <p class="help-block">{{$errors->first('missing_person_name')}}</p>
                            </div>

                            <div class="form-group {{$errors->has('missing_date')?'has-error':''}}">
                                <label>Missing Date</label>
                                <input type="datetime-local" name="missing_date" class="form-control"
                                       value="{{old('missing_date')}}">
                                <p class="help-block">{{$errors->first('missing_date')}}</p>
                            </div>

                            <div class="form-group {{$errors->has('division_id')?'has-error':''}}">
                                <label>Division Name</label>
                                <select name="division_id" class="form-control selectpicker"
                                        data-live-search="true"
                                        data-size="6"
                                        onchange="divisionSelectedForDistrictName(this.value)"
                                        title="Select Division">
                                    @foreach($divisions as $division)
                                        <option value="{!! $division->id !!}">{!! $division->division_name !!}</option>
                                    @endforeach
                                </select>
                                <p class="help-block">{{$errors->first('division_id')}}</p>
                            </div>

                            <div class="form-group {{$errors->has('district_id')?'has-error':''}}">
                                <label>District Name</label>
                                <select name="district_id" class="form-control selectpicker"
                                        data-live-search="true"
                                        data-size="6"
                                        title="Select District">

                                </select>
                                <p class="help-block">{{$errors->first('district_id')}}</p>
                            </div>

                            <div class="form-group {{$errors->has('upazila_id')?'has-error':''}}">
                                <label>Upazila Name</label>
                                <select name="upazila_id" class="form-control selectpicker"
                                        data-live-search="true"
                                        data-size="6"
                                        title="Select upazila">

                                </select>
                                <p class="help-block">{{$errors->first('upazila_id')}}</p>
                            </div>


                        </div>
                        <div class="box-footer">
                            <div class="col-md-12">
                                <button type="reset" value="Reset" class="btn btn-warning pull-left"><i
                                            class="fa fa-eraser"></i> Clear
                                </button>
                                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>Add
                                    Missing
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
    <script type="text/javascript">
        $(document).ready(function () {


        });

        function divisionSelectedForDistrictName(division_id) {
            $.ajax({
                accept: 'application/json',
                url: '{{url('/divisionSelectedForDistrictName')}}',
                type: 'get',
                data: {
                    'division_id': division_id,
                },
                success: function (data) {
                    $('select[name=district_id]').html(data);
                    $('select[name=district_id]').selectpicker('refresh');
                },
                error: function (err) {
                    $('select[name=district_id]').html('<option value="">Failed to retrieve data.</option>');
                    $('select[name=district_id]').selectpicker('refresh');
                }
            });
        }

    </script>
@endsection