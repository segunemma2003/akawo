<?php

namespace App\Http\Controllers;

use App\Http\Requests\BankRequest;
use App\Models\Bank;

class BankController extends Controller
{
    public function index()
    {
        $banks = Bank::where('user_id', auth()->user()->id)->latest()->get();

        return response(['data' => $banks ], 200);
    }

    public function store(BankRequest $request)
    {
        $bank = Bank::create($request->all());

        return response(['data' => $bank ], 201);

    }

    public function show($id)
    {
        $bank = Bank::findOrFail($id);

        return response(['data', $bank ], 200);
    }

    public function update(BankRequest $request, $id)
    {
        $bank = Bank::findOrFail($id);
        $bank->update($request->all());

        return response(['data' => $bank ], 200);
    }

    public function destroy($id)
    {
        Bank::destroy($id);

        return response(['data' => null ], 204);
    }
}
