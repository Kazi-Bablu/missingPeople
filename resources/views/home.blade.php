@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        You are logged in!
                        <br>
                        <br>
                        @if(auth()->user()->verified==0)
                            <div class="alert alert-danger" role="alert">Please verify you account,Otherwise you can't submit post</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
