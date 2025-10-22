<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building; 
use App\Models\City; 
use App\Models\User; 

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

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
            'name' => 'required|max:255',
            'city_id' => 'required|exists:cities,id',
            'count_floor' => 'nullable|integer|min:1|max:1000',
            'open_at' => 'required',
            'close_at' => 'required',
            'address' => 'required',
        ]);
        
        $building = new Building($validated);
        if (! Gate::allows('create-building', $building)){
            return redirect('/buildings')->with('message',
                "У вас не разрешения на добавление строений в городе Москва " );
        }
        $building->save();
        
        return redirect('/buildings'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('building', ['building' =>$building->where('id', $id)->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $building = Building::find($id);
        
        if (!$building) {
            return redirect('/buildings');
        }
        if (! Gate::allows('edit-building', $building->where('id', $id)->first())){
            return redirect('/buildings')->with('message',
                "У вас не разрешения на изменения строения номер ". $id);
        }
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
            return redirect('/buildings');
        }

        if (! Gate::allows('edit-building', Building::all()->where('id', $id)->first())){
            return redirect('/buildings')->with('error',
                "У вас не разрешения на изменения строения номер ". $id);
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

        return redirect('/buildings');

    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $building = Building::find($id);
        
        if (!$building) {
            return redirect('/buildings');
        }
        if (! Gate::allows('destroy-building', Building::all()->where('id', $id)->first())){
            return redirect('/buildings')->with('error',
                "У вас не разрешения на удаление строения номер ". $id);
        }
        $building->delete();

        return redirect('/buildings')->with('success', "Успешно удалён объект №". $id);

        
    }
}
