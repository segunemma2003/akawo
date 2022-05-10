<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsRequest;
use App\Models\Settings;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Settings::where('user_id', auth()->user()->id)->latest()->get();

        return response(['data' => $settings ], 200);
    }

    public function store(SettingsRequest $request)
    {
        $settings = Settings::create($request->all());

        return response(['data' => $settings ], 201);

    }

    public function show($id)
    {
        $settings = Settings::findOrFail($id);

        return response(['data', $settings ], 200);
    }

    public function update(SettingsRequest $request, $id)
    {
        $settings = Settings::findOrFail($id);
        $settings->update($request->all());

        return response(['data' => $settings ], 200);
    }

    public function destroy($id)
    {
        Settings::destroy($id);

        return response(['data' => null ], 204);
    }
}
