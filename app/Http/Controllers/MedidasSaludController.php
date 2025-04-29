<?php

namespace App\Http\Controllers;

use App\Models\MedidasSalud;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MedidasSaludRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class MedidasSaludController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $medidasSaluds = MedidasSalud::paginate();

        return view('medidas-salud.index', compact('medidasSaluds'))
            ->with('i', ($request->input('page', 1) - 1) * $medidasSaluds->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $medidasSalud = new MedidasSalud();

        return view('medidas-salud.create', compact('medidasSalud'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MedidasSaludRequest $request): RedirectResponse
    {
        MedidasSalud::create($request->validated());

        return Redirect::route('medidas-saluds.index')
            ->with('success', 'MedidasSalud created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $medidasSalud = MedidasSalud::find($id);

        return view('medidas-salud.show', compact('medidasSalud'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $medidasSalud = MedidasSalud::find($id);

        return view('medidas-salud.edit', compact('medidasSalud'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MedidasSaludRequest $request, MedidasSalud $medidasSalud): RedirectResponse
    {
        $medidasSalud->update($request->validated());

        return Redirect::route('medidas-saluds.index')
            ->with('success', 'MedidasSalud updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        MedidasSalud::find($id)->delete();

        return Redirect::route('medidas-saluds.index')
            ->with('success', 'MedidasSalud deleted successfully');
    }
}
