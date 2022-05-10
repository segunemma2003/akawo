<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', auth()->user()->id)->latest()->get();

        return response(['data' => $transactions ], 200);
    }

    public function store(TransactionRequest $request)
    {
        $transaction = Transaction::create($request->all());

        return response(['data' => $transaction ], 201);

    }

    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);

        return response(['data', $transaction ], 200);
    }

    public function update(TransactionRequest $request, $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update($request->all());

        return response(['data' => $transaction ], 200);
    }

    public function destroy($id)
    {
        Transaction::destroy($id);

        return response(['data' => null ], 204);
    }
}
