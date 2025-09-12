<?php
// app/Http/Controllers/AlergiasPersonaController.php
namespace App\Http\Controllers;

use App\Models\Alergia;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlergiasPersonaController extends Controller
{
    private function personaActual(): Persona
    {
        // a) Si tu guard ya es personas:
        return Auth::user();

        // b) Si tu guard es users, remapea por correo:
        // $email = Auth::user()->email;
        // return Persona::where('correo', $email)->firstOrFail();
    }

    public function index()
    {
        $persona       = $this->personaActual();
        $todas         = Alergia::orderBy('descripcion')->get();
        $seleccionadas = $persona->alergias()->pluck('alergias.id')->toArray();
        return view('pages/alergias', compact('todas','seleccionadas','persona'));
    }

    public function store(Request $request)
    {
        $persona = $this->personaActual();
        $ids = $request->input('alergias', []);
        $persona->alergias()->sync($ids);
        return back()->with('ok', 'Alergias actualizadas');
    }
}
