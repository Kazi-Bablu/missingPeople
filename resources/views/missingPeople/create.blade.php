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
                            <div class="form-group {{$errors->has('missing_person_age')?'has-error':''}}">
                                <label>Missing Person Age</label>
                                <input type="number" name="missing_person_age" class="form-control"
                                       value="{{old('missing_person_age')}}">
                                <p class="help-block">{{$errors->first('missing_person_age')}}</p>
                            </div>

                            <div class="form-group {{$errors->has('contact_number')?'has-error':''}}">
                                <label>Contact Number</label>
                                <input type="text" name="contact_number" class="form-control"
                                       value="{{old('contact_number')}}">
                                <p class="help-block">{{$errors->first('contact_number')}}</p>
                            </div>

                            <div class="form-group {{$errors->has('missing_date')?'has-error':''}}">
                                <label>Missing Date</label>
                                <input type="datetime-local" name="missing_date" class="form-control"
                                       value="{{old('missing_date')}}">
                                <p class="help-block">{{$errors->first('missing_date')}}</p>
                            </div>

                            <div class="form-group {{$errors->has('division_id')?'has-error':''}}">
                                <label>Division Name</label>
                                <a href="{{url('division/create')}}" class="pull-right">+ Add New</a>
                                <select name="division_id" class="form-control selectpicker"
                                        data-live-search="true"
                                        data-size="6"
                                        onchange="divisionSelectedForDistrictName(this.value)"
                                        title="Select Division">
                                    @if(count($divisions)>0)
                                        @foreach($divisions as $division)
                                            <option value="{!! $division->id !!}">{!! $division->division_name !!}</option>
                                        @endforeach
                                    @else
                                        <option value="">No Division found.</option>
                                    @endif
                                </select>
                                <p class="help-block">{{$errors->first('division_id')}}</p>
                            </div>

                            <div class="form-group {{$errors->has('district_id')?'has-error':''}}">
                                <label>District Name</label>
                                <a href="{{url('district/create')}}" class="pull-right">+ Add New</a>
                                <select name="district_id" class="form-control selectpicker"
                                        data-live-search="true"
                                        data-size="6"
                                        title="Select District">
                                    @if(count($districts)>0)
                                        @foreach($districts as $district)
                                            <option value="{!! $district->id !!}">{!! $district->district_name !!}</option>
                                        @endforeach
                                    @else
                                        <option value="">No district found.</option>
                                    @endif

                                </select>
                                <p class="help-block">{{$errors->first('district_id')}}</p>
                            </div>

                            <div class="form-group {{$errors->has('upazila_id')?'has-error':''}}">
                                <label>Upazila Name</label>
                                <a href="{{url('upazila/create')}}" class="pull-right">+ Add New</a>
                                <select name="upazila_id" class="form-control selectpicker"
                                        data-live-search="true"
                                        data-size="6"
                                        title="Select upazila">

                                    @if(count($upazilas)>0)
                                        @foreach($upazilas as $upazila)
                                            <option value="{!! $upazila->id !!}">{!! $upazila->upazila_name !!}</option>
                                        @endforeach
                                    @else
                                        <option value="">No upazila found.</option>
                                    @endif

                                </select>
                                <p class="help-block">{{$errors->first('upazila_id')}}</p>
                            </div>

                            <div class="form-group {{$errors->has('missing_person_description')?'has-error':''}}">
                                <label>Description</label>
                                <textarea name="missing_person_description" class="form-control"
                                          rows="5">{{old('missing_person_description')}}</textarea>
                                <p class="help-block">{{$errors->first('missing_person_description')}}</p>
                            </div>

                            {{--<div class="form-group {{$errors->has('missing_image')?'has-error':''}}">--}}
                                {{--<label for="file">Image</label>--}}
                                {{--<input type="file" data-show-preview="false" data-show-upload="false" name="missing_image"--}}
                                       {{--class="file" id="file"/>--}}
                                {{--<p class="help-block">{{$errors->first('missing_image')}}</p>--}}
                            {{--</div>--}}

                            <div class="form-group {{$errors->has('missing_image')?'has-error':''}}">
                                <label for="file">Image</label>
                                <input type="file" data-show-upload="false" name="missing_image" class="file" id="file"/>
                                <p class="help-block">{{$errors->first('missing_image')}}</p>
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

        {{--function divisionSelectedForDistrictName(division_id) {--}}
            {{--//console.log(division_id);--}}
            {{--$.ajax({--}}
                {{--accept: 'application/json',--}}
                {{--url: '{{url('/divisionSelectedForDistrictName')}}',--}}
                {{--type: 'get',--}}
                {{--data: {--}}
                    {{--'division_id': division_id,--}}
                {{--},--}}
                {{--success: function (data) {--}}
                    {{--$('select[name=district_id]').html(data);--}}
                    {{--$('select[name=district_id]').selectpicker('refresh');--}}
                {{--},--}}
                {{--error: function (err) {--}}
                    {{--$('select[name=district_id]').html('<option value="">Failed to retrieve data.</option>');--}}
                    {{--$('select[name=district_id]').selectpicker('refresh');--}}
                {{--}--}}
            {{--});--}}
        {{--}--}}

        // function divisionSelectedForDistrictName(division_id){
        //     console.log(division_id);
        // }
    </script>
@endsection