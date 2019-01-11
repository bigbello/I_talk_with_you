<?php
use App\Http\Controllers\MapController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
?>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-50">
            <div class="card">
                <div class="card-header">Search' s result</div>
                <div class="container">
                <div class="card-body" style="text-align:center;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
	                   <p style="text-align:center; margin-bottom:30px">{{ $title }}</p>
                     @if ($title != 'No users found')

                                      {!! Form::open(['url' => 'chat']) !!}
                                      {{Form::submit('Start chat', ['class' => 'btn btn-primary text-center'])}}
                                       {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
