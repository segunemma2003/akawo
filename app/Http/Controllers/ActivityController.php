<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityRequest;
use App\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::with('user')->where('user_id', auth()->user()->id)->latest()->get();

        return response(['data' => $activities ], 200);
    }

    public function store(ActivityRequest $request)
    {
        $activity = Activity::create($request->all());

        return response(['data' => $activity ], 201);

    }

    public function show($id)
    {
        $activity = Activity::findOrFail($id);

        return response(['data', $activity ], 200);
    }

    public function update(ActivityRequest $request, $id)
    {
        $activity = Activity::findOrFail($id);
        $activity->update($request->all());

        return response(['data' => $activity ], 200);
    }

    public function destroy($id)
    {
        Activity::destroy($id);

        return response(['data' => null ], 204);
    }
}
