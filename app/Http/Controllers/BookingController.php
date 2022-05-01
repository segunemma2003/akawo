<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::latest()->get();

        return response(['data' => $bookings ], 200);
    }

    public function store(BookingRequest $request)
    {
        $booking = Booking::create($request->all());

        return response(['data' => $booking ], 201);

    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);

        return response(['data', $booking ], 200);
    }

    public function update(BookingRequest $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update($request->all());

        return response(['data' => $booking ], 200);
    }

    public function destroy($id)
    {
        Booking::destroy($id);

        return response(['data' => null ], 204);
    }
}
