@extends('layouts.app')
@section('content')
    <h1> index task </h1>
    @if($message = Session::get('success'))
        <div class="alert-success"> {{ $message }}</div>
    @endif
    <form action="{{ route('tasks.search') }}" method="get">
        @csrf
        <input type="text" class="form-control" name="search" placeholder="Search...">
        <button class="btn btn-danger" name="submit">Search</button>
    </form>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create Task</a>
    <table class="table table-bordered">
        <tr>
            <td>Name</td>
            <td>Content</td>
            <td>#</td>
            <td>#</td>
            <td>#</td>
        </tr>
        @if(isset($search))
            @foreach($search as $searc)
                <tr>
                    <td>{{ $searc->name }}</td>
                    <td>{{ $searc->content }}</td>
                    <td><a href="{{ route('tasks.show', $searc->id) }}" class="btn btn-info">View</a></td>
                    <td><a href="{{ route('tasks.edit', $searc->id) }}" class="btn btn-success">Update</a></td>
                    <td><a href="{{ route('tasks.delete', $searc->id) }}" class="btn btn-danger"
                           onclick="return confirm('Realy want to Delete this?')">Delete</a></td>
                </tr>
            @endforeach
        @else
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->content }}</td>
                    <td><a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info">View</a></td>
                    <td><a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-success">Update</a></td>
                    <td><a href="{{ route('tasks.delete', $task->id) }}" class="btn btn-danger"
                           onclick="return confirm('Realy want to Delete this?')">Delete</a></td>
                </tr>
            @endforeach
        @endif
    </table>

@endsection
