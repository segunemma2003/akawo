<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewsRequest;
use App\Models\Reviews;

class ReviewsController extends Controller
{
    public function index()
    {
        $reviews = Reviews::latest()->get();

        return response(['data' => $reviews ], 200);
    }

    public function store(ReviewsRequest $request)
    {
        $reviews = Reviews::create($request->all());

        return response(['data' => $reviews ], 201);

    }

    public function show($id)
    {
        $reviews = Reviews::findOrFail($id);

        return response(['data', $reviews ], 200);
    }

    public function update(ReviewsRequest $request, $id)
    {
        $reviews = Reviews::findOrFail($id);
        $reviews->update($request->all());

        return response(['data' => $reviews ], 200);
    }

    public function destroy($id)
    {
        Reviews::destroy($id);

        return response(['data' => null ], 204);
    }
}
