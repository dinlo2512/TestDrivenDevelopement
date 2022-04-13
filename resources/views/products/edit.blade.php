@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>PRODUCT UPDATE</h1>
        <form action="" method="POST">
            @csrf
            <table>
                <tr>
                    <td><label for="">Name</label></td>
                    <td>
                        @error('name')
                        <p class="text-danger"> {{ $message }}</p>
                        @enderror
                        <input type="text" class="form-control" name="name" value="{{ $product->name }}"></td>
                </tr>
                <tr>
                    <td><label for="">Title</label></td>

                    <td>
                        @error('title')
                        <p class="text-danger"> {{ $message }}</p>
                        @enderror
                        <input type="text" class="form-control" name="title" value="{{ $product->title }}"></td>
                </tr>
            </table>
            <button class="btn btn-primary" name="submit"> Save </button>
        </form>
    </div>
@endsection
