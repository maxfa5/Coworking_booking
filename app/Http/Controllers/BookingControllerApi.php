<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking; 

class BookingControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perpage = $request->perpage ?? 2;
        $bookings = Booking::with(['kovorking', 'user'])
        ->paginate($perpage)
        ->withQueryString()
        ->where('name', 'LIKE', '%' .$request->search . "%");
    
        return response($bookings);
    }


    public function total()
    {
        return response(Booking::all()->count());
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response(Booking::all()->where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
