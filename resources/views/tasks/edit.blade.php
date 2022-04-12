
@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <form action="{{ route('tasks.update' , $task->id) }}" method="POST">
                @csrf
                <table>
                    <tr>
                        <td>
                            <label for="name">
                                Name
                            </label>
                        </td>
                        <td>
                            @error('name')
                            <p class="error text-danger">{{ $message }}</p>
                            @enderror
                            <input type="text" class="form-control" name="name" value="{{ $task->name }}">
                        </td>
                    </tr>
                    <tr>
                        <td>

                            <label for="content">
                                Content
                            </label>
                        </td>
                        <td>
                            @error('content')
                            <p class="error text-danger">{{ $message }}</p>
                            @enderror
                            <input type="text" class="form-control" name="content" value="{{ $task->content }}">
                        </td>
                    </tr>
                </table>
                <button class="btn btn-primary"> Submit</button>
            </form>
        </div>
    </div>
@endsection
