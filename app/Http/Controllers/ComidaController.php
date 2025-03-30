<?php

namespace App\Http\Controllers;

use App\Models\Comida;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ComidaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ComidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $comidas = Comida::paginate();

        return view('comida.index', compact('comidas'))
            ->with('i', ($request->input('page', 1) - 1) * $comidas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $comida = new Comida();

        return view('comida.create', compact('comida'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComidaRequest $request): RedirectResponse
    {
        Comida::create($request->validated());

        return Redirect::route('comidas.index')
            ->with('success', 'Comida created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $comida = Comida::find($id);

        return view('comida.show', compact('comida'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $comida = Comida::find($id);

        return view('comida.edit', compact('comida'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ComidaRequest $request, Comida $comida): RedirectResponse
    {
        $comida->update($request->validated());

        return Redirect::route('comidas.index')
            ->with('success', 'Comida updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Comida::find($id)->delete();

        return Redirect::route('comidas.index')
            ->with('success', 'Comida deleted successfully');
    }
}
