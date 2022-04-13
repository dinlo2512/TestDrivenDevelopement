@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>PRODUCT INDEX</h1>
        <a href="{{ route('products.create') }}" class="btn btn-success">CREATE</a>
        <table class="table table-bordered table-info ">
            <tr>
                <th>STT</th>
                <th>Name</th>
                <th>Title</th>
                <th>#</th>
                <th>#</th>
            </tr>
            @foreach($products as $product)
            <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->title }}</td>
                <td><a href="{{ route('products.edit' ,$product->id) }}" class="btn btn-info">EDIT</a></td>
                <td><a href="" class="btn btn-danger">DELETE</a></td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection
