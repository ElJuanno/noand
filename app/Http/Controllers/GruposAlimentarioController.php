<?php

namespace App\Http\Controllers;

use App\Models\GruposAlimentario;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\GruposAlimentarioRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class GruposAlimentarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $gruposAlimentarios = GruposAlimentario::paginate();

        return view('grupos-alimentario.index', compact('gruposAlimentarios'))
            ->with('i', ($request->input('page', 1) - 1) * $gruposAlimentarios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $gruposAlimentario = new GruposAlimentario();

        return view('grupos-alimentario.create', compact('gruposAlimentario'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GruposAlimentarioRequest $request): RedirectResponse
    {
        GruposAlimentario::create($request->validated());

        return Redirect::route('grupos-alimentarios.index')
            ->with('success', 'GruposAlimentario created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $gruposAlimentario = GruposAlimentario::find($id);

        return view('grupos-alimentario.show', compact('gruposAlimentario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $gruposAlimentario = GruposAlimentario::find($id);

        return view('grupos-alimentario.edit', compact('gruposAlimentario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GruposAlimentarioRequest $request, GruposAlimentario $gruposAlimentario): RedirectResponse
    {
        $gruposAlimentario->update($request->validated());

        return Redirect::route('grupos-alimentarios.index')
            ->with('success', 'GruposAlimentario updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        GruposAlimentario::find($id)->delete();

        return Redirect::route('grupos-alimentarios.index')
            ->with('success', 'GruposAlimentario deleted successfully');
    }
}
