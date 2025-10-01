<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building; 
use App\Models\City; 
use Illuminate\Support\Facades\Validator;
class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buildings = Building::with('city')->get();
        return view('buildings', ['buildings' =>$buildings]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('building_create', ['cities' => City::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'=> 'required|unique:buildings|max:255',
            'city_id'=> 'integer'
        ]);
        $building = new Building($validated);
        $building->save();
        return redirect('/building');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('building', ['building' =>Building::all()->where('id', $id)->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('building_edit', [
            'building'=>Building::all()->where('id', $id)->first(),
            'cities'=>City::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $building = Building::find($id);
        
        if (!$building) {
            return redirect('/building')->with('error', 'Здание не найдено');
        }
        $request->validate([
            'name' => 'required|max:255',
            'city_id' => 'required|exists:cities,id',
            'count_floor' => 'nullable|integer|min:1|max:1000',
            'open_at' => 'required',
            'close_at' => 'required',
            'address' => 'required',
        ]);

        $building->update([
            'name' => $request->name,
            'city_id' => $request->city_id,
            'count_floor' => $request->count_floor,
            'open_at' => $request->open_at,
            'close_at' => $request->close_at,
            'address' => $request->address,
        ]);

        return redirect('/buildings')->with('success', 'Здание успешно обновлено!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $building = Building::find($id);
        
        Building::destroy($id);
        return redirect('/buildings');
        
    }
}
