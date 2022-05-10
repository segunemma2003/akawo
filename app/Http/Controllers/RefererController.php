<?php

namespace App\Http\Controllers;

use App\Http\Requests\RefererRequest;
use App\Models\Referer;

class RefererController extends Controller
{
    public function index()
    {
        $referers = Referer::where('referer_id', auth()->user()->id)->latest()->get();

        return response(['data' => $referers ], 200);
    }

    public function store(RefererRequest $request)
    {
        $referer = Referer::create($request->all());

        return response(['data' => $referer ], 201);

    }

    public function show($id)
    {
        $referer = Referer::findOrFail($id);

        return response(['data', $referer ], 200);
    }

    public function update(RefererRequest $request, $id)
    {
        $referer = Referer::findOrFail($id);
        $referer->update($request->all());

        return response(['data' => $referer ], 200);
    }

    public function destroy($id)
    {
        Referer::destroy($id);

        return response(['data' => null ], 204);
    }
}
