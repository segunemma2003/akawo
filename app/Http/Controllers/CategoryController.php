<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();

        return response(['data' => $categories ], 200);
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all());

        return response(['data' => $category ], 201);

    }

    public function show($id)
    {
        $category = Category::with('items')->findOrFail($id);

        return response(['data', $category ], 200);
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return response(['data' => $category ], 200);
    }

    public function destroy($id)
    {
        Category::destroy($id);

        return response(['data' => null ], 204);
    }
}
