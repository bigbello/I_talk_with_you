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
        <div class="col-md-60 col-lg-50">
            <div class="card">
                <div class="card-header">Current position</div>
                <div class="container">
                  <h3 class="col-md-8 col-lg-8 offset-md-3" style="margin-bottom: 15px">Choose your preferencies</h2>
                  {!! Form::open(['url' => 'search']) !!}
                  <div class="col-md-8 col-lg-8 offset-md-2" style="margin-bottom: 15px">
                    {{form::label('condition', 'Condition')}}
                    {{form::select('condition', array('Caregiver', 'Patient', 'Both'), 0, ['class' => 'form-control'])}}
                  </div>
                  <div class="col-md-8 col-lg-8 offset-md-2" style="margin-bottom: 15px">
                    {{form::label('quantity', 'Km distance')}}
                    {{form::selectRange('quantity', 1, 50, 1, ['class' => 'form-control'])}}
                  </div>
                  <div class="form-group row mb-0 col-md-6 offset-md-5" style="margin-top: 20px">
                    {{form::submit('Submit', ['class' => 'btn btn-primary'])}}
                  </div>
                </div>
                 {!! Form::close() !!}
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div style="width: 460px; height: 460px;">
	                      {!! Mapper::render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
