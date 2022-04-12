@extends('layouts.app')
@section('content')
<h1> index task </h1>
    @if($message = Session::get('success'))
        <div class="alert-success"> {{ $message }}</div>
    @endif
    <table class="table table-bordered">
        <tr>
            <td>Name</td>
            <td>Content</td>
            <td>#</td>
            <td>#</td>
        </tr>
        @foreach($tasks as $task)
        <tr>
            <td>{{ $task->name }}</td>
            <td>{{ $task->content }}</td>
            <td><a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-info">Update</a></td>
            <td><a href="{{ route('tasks.delete', $task->id) }}" class="btn btn-danger" onclick="return confirm('Realy want to Delete this?')">Delete</a></td>
        </tr>
        @endforeach
    </table>

@endsection
