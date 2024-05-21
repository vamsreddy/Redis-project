@extends('layout')
   
@section('content')
    <section class="jumbotron text-pull-left">
        <div class="container">
            <h2 class="jumbotron-heading">Show Employee Details</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ url('/') }}"> Back</a>
        </div>
    </section>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $record->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {{ $record->email }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Phone:</strong>
                {{ $record->phone }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Place:</strong>
                {{ $record->place }}
            </div>
        </div>
    </div>
@endsection