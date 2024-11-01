<?php
namespace App\Http\Controllers;

use App\Models\Grupa;
use App\Http\Resources\GrupaResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GrupaController extends Controller
{
    public function index()
    {
        $grupe = Grupa::all();
        return GrupaResource::collection($grupe);
    }

    public function show($id)
    {
        $grupa = Grupa::findOrFail($id);
        return new GrupaResource($grupa);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'naziv' => 'required|string|max:255',
            'opis' => 'nullable|string',
            'ikonica' => 'nullable|string', // URL slike ili putanja
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $grupa = Grupa::create($request->all());

        return new GrupaResource($grupa);
    }

    public function update(Request $request, $id)
    {
        $grupa = Grupa::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'naziv' => 'nullable|string|max:255',
            'opis' => 'nullable|string',
            'ikonica' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $grupa->update($request->all());

        return new GrupaResource($grupa);
    }

    public function destroy($id)
    {
        $grupa = Grupa::findOrFail($id);
        $grupa->delete();
        
        return response()->json(['message' => 'Grupa obrisana.'], 204);
    }
}


