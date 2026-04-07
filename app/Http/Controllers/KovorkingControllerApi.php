<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kovorking; 

class KovorkingControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perpage = $request->perpage ?? 10;
        $kovorkings = Kovorking::with('building')
            ->paginate($perpage)
            ->withQueryString();
    
        return response($kovorkings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    public function total()
    {
        return response()->json([
            'total' => Kovorking::count()
        ]);
    }
    public function show(string $id)
    {
        $kovorking = Kovorking::with('building')->find($id);
        
        if (!$kovorking) {
            return response()->json(['message' => 'Kovorking not found'], 404);
        }
        
        return response()->json($kovorking);
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
