<?php

namespace App\Http\Controllers;

use App\Models\MedidasAntropometrica;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MedidasAntropometricaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MedidasAntropometricaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $medidasAntropometricas = MedidasAntropometrica::paginate();

        return view('medidas-antropometrica.index', compact('medidasAntropometricas'))
            ->with('i', ($request->input('page', 1) - 1) * $medidasAntropometricas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $medidasAntropometrica = new MedidasAntropometrica();

        return view('medidas-antropometrica.create', compact('medidasAntropometrica'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MedidasAntropometricaRequest $request): RedirectResponse
    {
        MedidasAntropometrica::create($request->validated());

        return Redirect::route('medidas-antropometricas.index')
            ->with('success', 'MedidasAntropometrica created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $medidasAntropometrica = MedidasAntropometrica::find($id);

        return view('medidas-antropometrica.show', compact('medidasAntropometrica'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $medidasAntropometrica = MedidasAntropometrica::find($id);

        return view('medidas-antropometrica.edit', compact('medidasAntropometrica'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MedidasAntropometricaRequest $request, MedidasAntropometrica $medidasAntropometrica): RedirectResponse
    {
        $medidasAntropometrica->update($request->validated());

        return Redirect::route('medidas-antropometricas.index')
            ->with('success', 'MedidasAntropometrica updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        MedidasAntropometrica::find($id)->delete();

        return Redirect::route('medidas-antropometricas.index')
            ->with('success', 'MedidasAntropometrica deleted successfully');
    }
}
