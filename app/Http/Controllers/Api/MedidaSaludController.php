<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MedidaSalud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedidaSaludController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $medidas = MedidaSalud::where('id_persona', $userId)->get();
        return response()->json($medidas);
    }
}
