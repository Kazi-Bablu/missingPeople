<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>View Missing List</title>

    {{--@include('asset.css')--}}
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
{{--<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">--}}

<!-- Styles -->

</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('/')}}">FMP</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <ul class="nav navbar-nav navbar-right">
                    @if (Route::has('login'))
                        @if (Auth::check())
                            <li><a href="{{url('/home')}}">Dashboard</a></li>
                        @else
                            <li><a href="{{url('/register')}}">Register</a></li>
                            <li><a href="{{url('/login')}}">Login</a></li>
                        @endif
                        <li><a href="{{url('/missing/list')}}">Missing List</a></li>
                    @endif
                </ul>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<br>
<br>
{!! Form::open(['id'=>'form','url'=> '/missing/list/search','method'=>'GET']) !!}
<div class="col-md-3 col-md-offset-1">
    <select name="division_id" class="form-control selectpicker"
            data-live-search="true"
            data-size="6"
            onchange="divisionSelectedForDistrictName(this.value)"
            title="Select Division">
        @foreach($divisions as $division)
            <option value="{!! $division->id !!}">{!! $division->division_name !!}</option>
        @endforeach
    </select>
</div>
<div class="col-md-3">
    <select name="district_id" class="form-control selectpicker"
            data-live-search="true"
            data-size="6"
            onchange="districtSelectedForUpazilaName(this.value)"
            title="Select District">

    </select>
</div>
<div class="col-md-3">
    <select name="upazila_id" class="form-control selectpicker"
            data-live-search="true"
            data-size="6"
            title="Select upazila">


    </select>
</div>
<div class="col-md-1">
    <button type="submit" class="btn btn-primary pull-right"><i class="fas fa-search"></i> Search
    </button>
</div>
{!! Form::close() !!}
<br>
<br>
<br>
<div class="col-md-11 col-md-offset-0">
    <div class="row">
        <div class="container">
            @if(count($missingPeoples)>0)
                @foreach($missingPeoples as $missingPeople)
                    <div class="col-md-11 col-md-offset-1">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr style="text-align: center; font-weight: bolder; font-family: 'Comic Sans MS'; font-size: 20px;">
                                    <th>Missing Person Details</th>
                                    <th>Picture</th>
                                </tr>
                                <tr>
                                    <td style="tab-size: 20px;font-family:'Comic Sans MS';font-weight: bolder">
                                        <ul class="list-group">
                                            <li class="list-group-item"><b>Name:</b>{{ $missingPeople->missing_person_name}}</li>
                                            <li class="list-group-item"><b>Age:</b>{{ $missingPeople->missing_person_age}}</li>
                                            <li class="list-group-item"><b>Contact Number:</b>{{ $missingPeople->contact_number}}</li>
                                            <li class="list-group-item"><b>Division Name:</b>{{ $missingPeople->division_name}}</li>
                                            <li class="list-group-item"><b>District Name:</b>{{ $missingPeople->district_name}}</li>
                                            <li class="list-group-item"><b>Upazila Name:</b>{{ $missingPeople->upazila_name}}</li>
                                            <li class="list-group-item"><b>Description:</b>{{ $missingPeople->missing_person_description}}</li>
                                            <li class="list-group-item"><b>Publish By:</b>{{ $missingPeople->name}}</li>
                                        </ul>
                                    </td>
                                    <td>
                                        {{--<img src=""/>--}}
                                        <br>
                                        <br>
                                        <img class="img-responsive"
                                             src="{{ asset('storage/images/'.$missingPeople->missing_image) }}"/>
                                    </td>
                                </tr>
                                <tr style="text-align: center; font-size: 20px;">
                                    <td colspan="2">
                                        <span class="label label-danger">
                                            Missing From:{{ date('d-m-Y H:m:s', strtotime($missingPeople->missing_date))}}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                            {{$missingPeoples->links()}}
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-md-12">
                    <h1>
                        <div class="alert alert-danger" role="alert">
                            <h1 style="font-weight: bolder; font-family: 'Comic Sans MS';font-size: 20px;color: black">No Missing Person Found! Please Search With Another One</h1>
                        </div>
                    </h1>
                </div>
            @endif
        </div>
    </div>
</div>


{{--javascript--}}
@include('asset.js')
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>--}}
{{--<script src="{{ asset('js/app.js') }}"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>--}}
<script type="text/javascript">
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
            },
            error: function (err) {
                $('select[name=district_id]').html('<option value="">Failed to retrieve data.</option>');
                $('select[name=district_id]').selectpicker('refresh');
            }
        });
    }

    function districtSelectedForUpazilaName(district_id)
    {
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
</script>
</body>
</html>
