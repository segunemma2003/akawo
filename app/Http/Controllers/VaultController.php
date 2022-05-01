<?php

namespace App\Http\Controllers;

use App\Http\Requests\VaultRequest;
use App\Models\Vault;

class VaultController extends Controller
{
    public function index()
    {
        $vaults = Vault::latest()->get();

        return response(['data' => $vaults ], 200);
    }

    public function store(VaultRequest $request)
    {
        $vault = Vault::create($request->all());

        return response(['data' => $vault ], 201);

    }

    public function show($id)
    {
        $vault = Vault::findOrFail($id);

        return response(['data', $vault ], 200);
    }

    public function update(VaultRequest $request, $id)
    {
        $vault = Vault::findOrFail($id);
        $vault->update($request->all());

        return response(['data' => $vault ], 200);
    }

    public function destroy($id)
    {
        Vault::destroy($id);

        return response(['data' => null ], 204);
    }
}
