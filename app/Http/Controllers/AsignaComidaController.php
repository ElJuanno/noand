<?php

namespace App\Http\Controllers;

use App\Models\AsignaComida;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AsignaComidaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AsignaComidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $asignaComidas = AsignaComida::paginate();

        return view('asigna-comida.index', compact('asignaComidas'))
            ->with('i', ($request->input('page', 1) - 1) * $asignaComidas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $asignaComida = new AsignaComida();

        return view('asigna-comida.create', compact('asignaComida'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AsignaComidaRequest $request): RedirectResponse
    {
        AsignaComida::create($request->validated());

        return Redirect::route('asigna-comidas.index')
            ->with('success', 'AsignaComida created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $asignaComida = AsignaComida::find($id);

        return view('asigna-comida.show', compact('asignaComida'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $asignaComida = AsignaComida::find($id);

        return view('asigna-comida.edit', compact('asignaComida'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AsignaComidaRequest $request, AsignaComida $asignaComida): RedirectResponse
    {
        $asignaComida->update($request->validated());

        return Redirect::route('asigna-comidas.index')
            ->with('success', 'AsignaComida updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        AsignaComida::find($id)->delete();

        return Redirect::route('asigna-comidas.index')
            ->with('success', 'AsignaComida deleted successfully');
    }
}
