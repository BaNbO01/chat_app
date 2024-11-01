<?php
namespace App\Http\Controllers;

use App\Models\Poruka;
use App\Http\Resources\PrivatnaPorukaResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PrivatnePorukeController extends Controller
{
    public function index(Request $request, $sagovornikId)
    {
        $user = Auth::user();
        $mojId = $user->id;

        
        $poruke = Poruka::where(function ($query) use ($mojId, $sagovornikId) {
            $query->where('posiljalac_id', $mojId)
                  ->where('primalac_id', $sagovornikId);
        })
        ->orWhere(function ($query) use ($mojId, $sagovornikId) {
            $query->where('posiljalac_id', $sagovornikId)
                  ->where('primalac_id', $mojId);
        })
        ->orderBy('vreme_slanja', 'desc')
        ->paginate(10);

        return PrivatnaPorukaResource::collection($poruke);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sadrzaj' => 'required|string',
            'posiljalac_id' => 'required|exists:korisnici,id',
            'primalac_id' => 'required|exists:korisnici,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $poruka = Poruka::create([
            'sadrzaj' => $request->sadrzaj,
            'posiljalac_id' => $request->posiljalac_id,
            'primalac_id' => $request->primalac_id,
            'vreme_slanja' => now(),
        ]);

        return new PrivatnaPorukaResource($poruka);
    }

    public function destroy($id)
    {
        $poruka = Poruka::findOrFail($id);
        $poruka->delete();
        
        return response()->json(['message' => 'Poruka obrisana.'], 204);
    }
}

