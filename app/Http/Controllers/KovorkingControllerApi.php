<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
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
        $kovorkings = Kovorking::with('building')
            ->paginate($perpage)
            ->withQueryString();
    
        return response($kovorkings);
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
                'image' => 'required|file|mimes:jpg,jpeg,png|max:2048'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
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
                    'message' => 'Не удалось загрузить файл в S3'
                ], 500);
            }
            
            $fileUrl = Storage::disk('s3')->url($path);
        } catch (Exception $e) {
            return response()->json([
                'code' => 2,
                'message' => 'Ошибка загрузки файла в хранилище S3: ' . $e->getMessage()
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
