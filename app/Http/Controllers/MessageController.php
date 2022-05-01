<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->get();

        return response(['data' => $messages ], 200);
    }

    public function store(MessageRequest $request)
    {
        $message = Message::create($request->all());

        return response(['data' => $message ], 201);

    }

    public function show($id)
    {
        $message = Message::findOrFail($id);

        return response(['data', $message ], 200);
    }

    public function update(MessageRequest $request, $id)
    {
        $message = Message::findOrFail($id);
        $message->update($request->all());

        return response(['data' => $message ], 200);
    }

    public function destroy($id)
    {
        Message::destroy($id);

        return response(['data' => null ], 204);
    }
}
