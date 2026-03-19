<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // GET ALL
    public function index()
    {
        $products = Product::all();

        return response()->json([
            'status' => 'success',
            'data' => $products
        ]);
    }

    // CREATE
    public function store(Request $request)
    {
        $product = Product::create($request->all());
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Product berhasil ditambahkan',
            'data' => $product
        ]);
    }

    // SHOW
    public function show($id)
    {
        $product = Product::find($id);

        return response()->json([
            'status' => 'success',
            'data' => $product
        ]);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Product berhasil diupdate',
            'data' => $product
        ]);
    }

    // DELETE
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Product berhasil dihapus'
        ]);
    }
}