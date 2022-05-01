<?php

namespace App\Http\Controllers;

use App\Http\Requests\MRequestRequest;
use App\Models\MRequest;

class MRequestController extends Controller
{
    public function index()
    {
        $mrequests = MRequest::latest()->get();

        return response(['data' => $mrequests ], 200);
    }

    public function store(MRequestRequest $request)
    {
        $mrequest = MRequest::create($request->all());

        return response(['data' => $mrequest ], 201);

    }

    public function show($id)
    {
        $mrequest = MRequest::findOrFail($id);

        return response(['data', $mrequest ], 200);
    }

    public function update(MRequestRequest $request, $id)
    {
        $mrequest = MRequest::findOrFail($id);
        $mrequest->update($request->all());

        return response(['data' => $mrequest ], 200);
    }

    public function destroy($id)
    {
        MRequest::destroy($id);

        return response(['data' => null ], 204);
    }
}
