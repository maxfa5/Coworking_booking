<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking; 
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->perpage ?? 2;
            $bookings = Booking::with(['kovorking', 'user'])
                ->paginate($perPage)
                ->withQueryString();
        
            return view('bookings', compact('bookings'));
        } catch (\Exception $e) {
            // Log the error and return a safe response
            \Log::error('Booking index error: ' . $e->getMessage());
            return back()->with('error', 'Произошла ошибка при загрузке данных');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        return view('booking', ['booking' =>Booking::all()->where('id', $id)->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
