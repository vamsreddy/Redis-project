@extends('layout')

@section('content')

    <section class="jumbotron text-center">
        <div class="container">
       <h1 class="jumbotron-heading">Employee Details</h1>
        </div>
        <div class="pull-right">
        <a class="btn btn-success" href="{{ url('create') }}"> Add New Employee</a>
        </div>
    </section>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
     
    <table class="table table-bordered">
        <tr>
            <th>S.no</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Place</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($records as $record)
        <tr>
            <td>{{ $record->id }}</td>
            <td>{{ $record->name }}</td>
            <td>{{ $record->email }}</td>
            <td>{{ $record->phone }}</td>
            <td>{{ $record->place }}</td>
            <td>
                <form action="{{ url('delete',$record->id) }}" method="POST">
     
                    <a class="btn btn-info" href="{{ url('show',$record->id) }}">Show</a>
      
                    <a class="btn btn-primary" href="{{ url('edit',$record->id) }}">Edit</a>
     
                    @csrf
                    @method('DELETE')
        
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
@endsection