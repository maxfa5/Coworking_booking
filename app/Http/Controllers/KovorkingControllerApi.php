<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Exception; 
use Illuminate\Http\Request;
use App\Models\Kovorking; 
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Gate; 

class KovorkingControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perpage = $request->perpage ?? 10;
        $query = Kovorking::with('building');
        
        if ($request->search) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }
        
        $kovorkings = $query->paginate($perpage)->withQueryString();

        return response($kovorkings);
    }

    /**
     * Get total count of kovorkings.
     */
    public function total(Request $request)
    {
        $query = Kovorking::query();
        
        if ($request->search) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }
        
        return response($query->count());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kovorking = Kovorking::with('building')->find($id);
        
        if (!$kovorking) {
            return response()->json([
                'code' => 1,
                'message' => 'Коворкинг не найден'
            ], 404);
        }
        
        return response()->json([
            'code' => 0,
            'data' => $kovorking
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('create-kovorking')) {
            return response()->json([
                'code' => 1,
                'message' => 'У вас нет прав на добавление коворкинга'
            ], 403);
        }
    
        try {
            $validated = $request->validate([
                'name' => 'required|unique:kovorkings|max:255',
                'building_id' => 'required|exists:buildings,id',
                'floor_number' => 'nullable|integer|min:0|max:100',
                'capacity' => 'nullable|integer|min:1|max:1000',
                'from_at' => 'nullable|string',
                'to_at' => 'nullable|string',
                'description' => 'nullable|string',
                'image' => 'required|file|mimes:jpg,jpeg,png|max:2048'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'code' => 3,
                'message' => 'Ошибка валидации',
                'errors' => $e->errors()
            ], 422);
        }
    
        $file = $request->file('image');
        if (!$file || !$file->isValid()) {
            return response()->json([
                'code' => 2,
                'message' => 'Файл не загружен или повреждён'
            ], 400);
        }
    
        $fileName = rand(1, 100000) . '_' . time() . '.' . $file->getClientOriginalExtension();
    
        try {
            $path = Storage::disk('s3')->putFileAs('kovorking_pictures', $file, $fileName);
            
            if (!$path) {
                return response()->json([
                    'code' => 2,
                    'message' => 'Не удалось загрузить файл в хранилище'
                ], 500);
            }
            
            $fileUrl = Storage::disk('s3')->url($path);
        } catch (Exception $e) {
            return response()->json([
                'code' => 2,
                'message' => 'Ошибка загрузки файла в хранилище: ' . $e->getMessage()
            ], 500);
        }
    
        $kovorking = new Kovorking($validated);
        $kovorking->picture_url = $fileUrl;
        $kovorking->save();
    
        return response()->json([
            'code' => 0,
            'message' => 'Коворкинг успешно добавлен'
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Gate::allows('update-kovorking')) {
            return response()->json([
                'code' => 1,
                'message' => 'У вас нет прав на редактирование коворкинга'
            ], 403);
        }

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:kovorkings,name,' . $id,
                'building_id' => 'required|exists:buildings,id',
                'floor_number' => 'nullable|integer|min:0|max:100',
                'capacity' => 'nullable|integer|min:1|max:1000',
                'from_at' => 'nullable|string',
                'to_at' => 'nullable|string',
                'description' => 'nullable|string',
                'image' => 'nullable|file|image|mimes:jpg,jpeg,png|max:2048'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'code' => 3,
                'message' => 'Ошибка валидации',
                'errors' => $e->errors()
            ], 422);
        }

        try {
            $kovorking = Kovorking::findOrFail($id);
            $kovorking->name = $validated['name'];
            $kovorking->building_id = $validated['building_id'];
            $kovorking->floor_number = $validated['floor_number'] ?? $kovorking->floor_number;
            $kovorking->capacity = $validated['capacity'] ?? $kovorking->capacity;
            $kovorking->from_at = $validated['from_at'] ?? $kovorking->from_at;
            $kovorking->to_at = $validated['to_at'] ?? $kovorking->to_at;
            $kovorking->description = $validated['description'] ?? $kovorking->description;
            
            if ($request->hasFile('image')) {
                if ($kovorking->picture_url) {
                    $this->deleteOldImage($kovorking->picture_url);
                }
                $file = $request->file('image');
                $fileName = time() . '_' . rand(1, 100000) . '.' . $file->getClientOriginalExtension();
                $path = Storage::disk('s3')->putFileAs('kovorking_pictures', $file, $fileName);
                $kovorking->picture_url = Storage::disk('s3')->url($path);
            }
            
            $kovorking->save();
            
            return response()->json([
                'code' => 0,
                'message' => 'Коворкинг успешно обновлён',
                'data' => $kovorking
            ]);

        } catch (Exception $e) {
            return response()->json([
                'code' => 1,
                'message' => 'Ошибка при обновлении коворкинга',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function deleteOldImage($pictureUrl)
    {
        if (!$pictureUrl) return;
        
        try {
            $parsedUrl = parse_url($pictureUrl);
            $path = ltrim($parsedUrl['path'], '/');
            $bucket = env('AWS_BUCKET');
            $path = str_replace($bucket . '/', '', $path);
            
            if (Storage::disk('s3')->exists($path)) {
                Storage::disk('s3')->delete($path);
            }
        } catch (Exception $e) {
            Log::warning('Failed to delete old image: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Gate::allows('delete-kovorking')) {
            return response()->json([
                'code' => 1,
                'message' => 'У вас нет прав на удаление коворкинга'
            ], 403);  
        }

        $kovorking = Kovorking::with('bookings')->find($id);

        if (!$kovorking) {
            return response()->json([
                'code' => 1,
                'message' => 'Коворкинг не найден'
            ], 404);
        }
    
        if ($kovorking->bookings()->count() > 0) {
            return response()->json([
                'code' => 1,
                'message' => 'Нельзя удалить коворкинг, к которому привязаны бронирования'
            ], 400);
        }
    
        if ($kovorking->picture_url) {
            $this->deleteOldImage($kovorking->picture_url);
        }
    
        $kovorking->delete();
    
        return response()->json([
            'code' => 0,
            'message' => 'Коворкинг успешно удалён'
        ]);
    }
}