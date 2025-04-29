<?php

namespace App\Http\Controllers;

use App\Models\Alimento;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AlimentoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AlimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $alimentos = Alimento::paginate();

        return view('alimento.index', compact('alimentos'))
            ->with('i', ($request->input('page', 1) - 1) * $alimentos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $alimento = new Alimento();

        return view('alimento.create', compact('alimento'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlimentoRequest $request): RedirectResponse
    {
        Alimento::create($request->validated());

        return Redirect::route('alimentos.index')
            ->with('success', 'Alimento created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $alimento = Alimento::find($id);

        return view('alimento.show', compact('alimento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $alimento = Alimento::find($id);

        return view('alimento.edit', compact('alimento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlimentoRequest $request, Alimento $alimento): RedirectResponse
    {
        $alimento->update($request->validated());

        return Redirect::route('alimentos.index')
            ->with('success', 'Alimento updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Alimento::find($id)->delete();

        return Redirect::route('alimentos.index')
            ->with('success', 'Alimento deleted successfully');
    }
}
