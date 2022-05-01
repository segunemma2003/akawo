<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImagesRequest;
use App\Models\Images;

class ImagesController extends Controller
{
    public function index()
    {
        $images = Images::latest()->get();

        return response(['data' => $images ], 200);
    }

    public function store(ImagesRequest $request)
    {
        $images = Images::create($request->all());

        return response(['data' => $images ], 201);

    }

    public function show($id)
    {
        $images = Images::findOrFail($id);

        return response(['data', $images ], 200);
    }

    public function update(ImagesRequest $request, $id)
    {
        $images = Images::findOrFail($id);
        $images->update($request->all());

        return response(['data' => $images ], 200);
    }

    public function destroy($id)
    {
        Images::destroy($id);

        return response(['data' => null ], 204);
    }
}
