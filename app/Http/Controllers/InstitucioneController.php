<?php

namespace App\Http\Controllers;

use App\Models\Institucione;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\InstitucioneRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class InstitucioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $instituciones = Institucione::paginate();

        return view('institucione.index', compact('instituciones'))
            ->with('i', ($request->input('page', 1) - 1) * $instituciones->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $institucione = new Institucione();

        return view('institucione.create', compact('institucione'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InstitucioneRequest $request): RedirectResponse
    {
        Institucione::create($request->validated());

        return Redirect::route('instituciones.index')
            ->with('success', 'Institucione created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $institucione = Institucione::find($id);

        return view('institucione.show', compact('institucione'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $institucione = Institucione::find($id);

        return view('institucione.edit', compact('institucione'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InstitucioneRequest $request, Institucione $institucione): RedirectResponse
    {
        $institucione->update($request->validated());

        return Redirect::route('instituciones.index')
            ->with('success', 'Institucione updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Institucione::find($id)->delete();

        return Redirect::route('instituciones.index')
            ->with('success', 'Institucione deleted successfully');
    }
}
