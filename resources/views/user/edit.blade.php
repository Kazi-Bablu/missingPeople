@extends('layouts.app')

@section('title')
    Update Missing
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
                <a href="{{url('/user/view')}}" class="btn btn-primary btn-flat"><i class="fa fa-list"></i>
                    View Missing</a>
            </div>
            <br>
            <br>
            <h2>Update User</h2>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        {{--<img src="{{ asset('storage/images/'.$query->missing_image) }}"--}}
                        {{--{!! Form::open(['id'=>'form','url'=> 'division/' . $divisionById->id . '/update']) !!}--}}
                        {!! Form::open(['id'=>'form','url'=> '/user/' . $userById->id .'/update','files'=>'true']) !!}
                        <div class="col-md-6">
                            <div class="form-group {{$errors->has('name')?'has-error':''}}">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control"
                                       value="{{$userById->name}}">
                                <p class="help-block">{{$errors->first('name')}}</p>
                            </div>

                            <div class="form-group {{$errors->has('email')?'has-error':''}}">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control"
                                       value="{{$userById->email}}">
                                <p class="help-block">{{$errors->first('email')}}</p>
                            </div>
                            <div class="form-group {{$errors->has('occupation')?'has-error':''}}">
                                <label>Occupation</label>
                                <select name="occupation" class="form-control selectpicker"
                                        data-live-search="true"
                                        data-size="6"
                                        title="Select occupation">
                                    <option value="Police">Police</option>
                                    <option value="Other">Other</option>
                                </select>
                                <p class="help-block">{{$errors->first('occupation')}}</p>
                            </div>

                        </div>
                        <div class="col-md-6">
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
                                        onchange="districtSelectedForUpazilaName(this.value)"
                                        title="Select District">

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


                                </select>
                                <p class="help-block">{{$errors->first('upazila_id')}}</p>
                            </div>

                        </div>
                        <div class="box-footer">
                            <div class="col-md-12">
                                <button type="reset" value="Reset" class="btn btn-warning pull-left"><i
                                            class="fa fa-eraser"></i> Clear
                                </button>
                                <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>Update User
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
            //console.log(division_id);
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
                    $('select[name=district_id]').selectpicker('val', '{{old('division_id') ? old('division_id'):$userById->division_id}}');
                },
                error: function (err) {
                    $('select[name=district_id]').html('<option value="">Failed to retrieve data.</option>');
                    $('select[name=district_id]').selectpicker('refresh');
                }
            });
        }

        function districtSelectedForUpazilaName(district_id) {
            $.ajax({
                accept: 'application/json',
                url: '{{url('/districtSelectedForUpazilaName')}}',
                type: 'get',
                data: {
                    'district_id': district_id,
                },
                success: function (data) {
                    $('select[name=upazila_id]').html(data);
                    $('select[name=upazila_id]').selectpicker('refresh');
                },
                error: function (err) {
                    $('select[name=upazila_id]').html('<option value="">Failed to retrieve data.</option>');
                    $('select[name=upazila_id]').selectpicker('refresh');
                }
            });
        }

        $('select[name=division_id]').selectpicker('val', '{{old('division_id') ? old('division_id'):$userById->division_id}}');
        //divisionSelectedForDistrictName('{{old('division_id') ? old('division_id'):$userById->division_id}}');
        $('select[name=district_id]').selectpicker('val', '{{old('district_id') ? old('district_id'):$userById->district_id}}');
        $('select[name=upazila_id]').selectpicker('val', '{{old('upazila_id') ? old('upazila_id'):$userById->upazila_id}}');
    </script>
    @if(count($errors) > 0)
        <script type="text/javascript">


        </script>
    @endif
@endsection