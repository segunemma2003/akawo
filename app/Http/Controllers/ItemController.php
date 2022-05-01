<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::latest()->get();

        return response(['data' => $items ], 200);
    }

    public function store(ItemRequest $request)
    {
        $item = Item::create($request->all());

        return response(['data' => $item ], 201);

    }

    public function show($id)
    {
        $item = Item::findOrFail($id);

        return response(['data', $item ], 200);
    }

    public function update(ItemRequest $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->update($request->all());

        return response(['data' => $item ], 200);
    }

    public function destroy($id)
    {
        Item::destroy($id);

        return response(['data' => null ], 204);
    }
}
