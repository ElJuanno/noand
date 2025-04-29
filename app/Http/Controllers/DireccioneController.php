<?php

namespace App\Http\Controllers;

use App\Models\Direccione;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\DireccioneRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DireccioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $direcciones = Direccione::paginate();

        return view('direccione.index', compact('direcciones'))
            ->with('i', ($request->input('page', 1) - 1) * $direcciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $direccione = new Direccione();

        return view('direccione.create', compact('direccione'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DireccioneRequest $request): RedirectResponse
    {
        Direccione::create($request->validated());

        return Redirect::route('direcciones.index')
            ->with('success', 'Direccione created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $direccione = Direccione::find($id);

        return view('direccione.show', compact('direccione'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $direccione = Direccione::find($id);

        return view('direccione.edit', compact('direccione'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DireccioneRequest $request, Direccione $direccione): RedirectResponse
    {
        $direccione->update($request->validated());

        return Redirect::route('direcciones.index')
            ->with('success', 'Direccione updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Direccione::find($id)->delete();

        return Redirect::route('direcciones.index')
            ->with('success', 'Direccione deleted successfully');
    }
}
