<?php
namespace App\Http\Controllers;

use App\Models\Poruka;
use App\Http\Resources\GrupnaPorukaResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GrupnePorukeController extends Controller
{
    public function index(Request $request, $grupaId)
    {
        $poruke = Poruka::where('grupa_id', $grupaId)
            ->orderBy('vreme_slanja', 'desc')
            ->paginate(10);

        return GrupnaPorukaResource::collection($poruke);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sadrzaj' => 'required|string',
            'posiljalac_id' => 'required|exists:korisnici,id',
            'grupa_id' => 'required|exists:grupe,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $poruka = Poruka::create([
            'sadrzaj' => $request->sadrzaj,
            'posiljalac_id' => $request->posiljalac_id,
            'grupa_id' => $request->grupa_id,
            'vreme_slanja' => now(),
        ]);

        return new GrupnaPorukaResource($poruka);
    }

    public function destroy($id)
    {
        $poruka = Poruka::findOrFail($id);
        $poruka->delete();
        
        return response()->json(['message' => 'Poruka obrisana.'], 204);
    }
}

