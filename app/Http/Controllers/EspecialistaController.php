<?php

namespace App\Http\Controllers;

use App\Models\Especialista;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\EspecialistaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class EspecialistaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $especialistas = Especialista::paginate();

        return view('especialista.index', compact('especialistas'))
            ->with('i', ($request->input('page', 1) - 1) * $especialistas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $especialista = new Especialista();

        return view('especialista.create', compact('especialista'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EspecialistaRequest $request): RedirectResponse
    {
        Especialista::create($request->validated());

        return Redirect::route('especialistas.index')
            ->with('success', 'Especialista created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $especialista = Especialista::find($id);

        return view('especialista.show', compact('especialista'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $especialista = Especialista::find($id);

        return view('especialista.edit', compact('especialista'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EspecialistaRequest $request, Especialista $especialista): RedirectResponse
    {
        $especialista->update($request->validated());

        return Redirect::route('especialistas.index')
            ->with('success', 'Especialista updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Especialista::find($id)->delete();

        return Redirect::route('especialistas.index')
            ->with('success', 'Especialista deleted successfully');
    }
}
