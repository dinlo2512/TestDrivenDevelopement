@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <h1> Create Task</h1>
                <table>
                    <tr>
                        <td>
                            <label for="name">
                                Name
                            </label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="name" value="{{ $tasks->name }}">
                        </td>
                    </tr>
                    <tr>
                        <td>

                            <label for="content">
                                Content
                            </label>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="content" value="{{ $tasks->content }}">
                        </td>
                    </tr>
                </table>
        </div>
    </div>
@endsection
