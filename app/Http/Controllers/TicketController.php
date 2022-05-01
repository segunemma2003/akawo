<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::latest()->get();

        return response(['data' => $tickets ], 200);
    }

    public function store(TicketRequest $request)
    {
        $ticket = Ticket::create($request->all());

        return response(['data' => $ticket ], 201);

    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);

        return response(['data', $ticket ], 200);
    }

    public function update(TicketRequest $request, $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->update($request->all());

        return response(['data' => $ticket ], 200);
    }

    public function destroy($id)
    {
        Ticket::destroy($id);

        return response(['data' => null ], 204);
    }
}
