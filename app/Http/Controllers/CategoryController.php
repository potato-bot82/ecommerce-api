<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // GET ALL
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Category::all()
        ]);
    }

    // CREATE
    public function store(Request $request)
    {
        $category = Category::create($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $category
        ]);
    }

}
