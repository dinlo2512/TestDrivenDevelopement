<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(CreateProductRequest $request)
    {
        Product::query()->create($request->all());

        return redirect(route('products.index'))->with('success', 'Create success');
    }

    public function edit($id)
    {
        $product = Product::findorFail($id);
        return view('products.edit',compact('product'));
    }

    public function update(CreateProductRequest $request,$id)
    {
        Product::query()->where('id', $id)->update($request->all());

        return redirect(route('products.index'))->with('success', 'Update success');
    }
}
