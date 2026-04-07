<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class BuildingControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buildings = Building::with('city')->get();
        
        return response()->json([
            'success' => true,
            'data' => $buildings
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'city_id' => 'required|exists:cities,id',
            'count_floor' => 'nullable|integer|min:1|max:1000',
            'open_at' => 'required|date_format:H:i',
            'close_at' => 'required|date_format:H:i',
            'address' => 'required|string',
            'timezone' => 'nullable|string|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $building = new Building($validator->validated());

        if (!Gate::allows('create-building', $building)) {
            return response()->json([
                'success' => false,
                'message' => 'У вас нет разрешения на добавление строений'
            ], 403);
        }

        $building->save();

        return response()->json([
            'success' => true,
            'message' => 'Строение успешно создано',
            'data' => $building->load('city')
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $building = Building::with('city')->find($id);

        if (!$building) {
            return response()->json([
                'success' => false,
                'message' => 'Строение не найдено'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $building
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $building = Building::find($id);

        if (!$building) {
            return response()->json([
                'success' => false,
                'message' => 'Строение не найдено'
            ], 404);
        }

        if (!Gate::allows('edit-building', $building)) {
            return response()->json([
                'success' => false,
                'message' => "У вас нет разрешения на изменение строения номер {$id}"
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|max:255',
            'city_id' => 'sometimes|required|exists:cities,id',
            'count_floor' => 'nullable|integer|min:1|max:1000',
            'open_at' => 'sometimes|required|date_format:H:i',
            'close_at' => 'sometimes|required|date_format:H:i',
            'address' => 'sometimes|required|string',
            'timezone' => 'nullable|string|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $building->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => "Строение №{$id} успешно обновлено",
            'data' => $building->load('city')
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $building = Building::find($id);

        if (!$building) {
            return response()->json([
                'success' => false,
                'message' => 'Строение не найдено'
            ], 404);
        }

        if (!Gate::allows('destroy-building', $building)) {
            return response()->json([
                'success' => false,
                'message' => "У вас нет разрешения на удаление строения номер {$id}"
            ], 403);
        }

        $building->delete();

        return response()->json([
            'success' => true,
            'message' => "Строение №{$id} успешно удалено"
        ], 200);
    }

    /**
     * Get buildings by city
     */
    public function getByCity($cityId)
    {
        $buildings = Building::with('city')
            ->where('city_id', $cityId)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $buildings
        ], 200);
    }

    /**
     * Get buildings with pagination
     */
    public function paginate(Request $request)
    {
        $perPage = $request->get('per_page', 15);
        $buildings = Building::with('city')
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $buildings
        ], 200);
    }

    /**
     * Search buildings by name or address
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');
        
        $buildings = Building::with('city')
            ->where('name', 'like', "%{$query}%")
            ->orWhere('address', 'like', "%{$query}%")
            ->get();

        return response()->json([
            'success' => true,
            'data' => $buildings
        ], 200);
    }
}