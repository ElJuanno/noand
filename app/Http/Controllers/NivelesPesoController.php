<?php

namespace App\Http\Controllers;

use App\Models\NivelesPeso;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\NivelesPesoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class NivelesPesoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $nivelesPesos = NivelesPeso::paginate();

        return view('niveles-peso.index', compact('nivelesPesos'))
            ->with('i', ($request->input('page', 1) - 1) * $nivelesPesos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $nivelesPeso = new NivelesPeso();

        return view('niveles-peso.create', compact('nivelesPeso'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NivelesPesoRequest $request): RedirectResponse
    {
        NivelesPeso::create($request->validated());

        return Redirect::route('niveles-pesos.index')
            ->with('success', 'NivelesPeso created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $nivelesPeso = NivelesPeso::find($id);

        return view('niveles-peso.show', compact('nivelesPeso'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $nivelesPeso = NivelesPeso::find($id);

        return view('niveles-peso.edit', compact('nivelesPeso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NivelesPesoRequest $request, NivelesPeso $nivelesPeso): RedirectResponse
    {
        $nivelesPeso->update($request->validated());

        return Redirect::route('niveles-pesos.index')
            ->with('success', 'NivelesPeso updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        NivelesPeso::find($id)->delete();

        return Redirect::route('niveles-pesos.index')
            ->with('success', 'NivelesPeso deleted successfully');
    }
}
