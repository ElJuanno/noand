<?php

namespace App\Http\Controllers;

use App\Models\Dieta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\DietaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DietaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $dietas = Dieta::paginate();

        return view('dieta.index', compact('dietas'))
            ->with('i', ($request->input('page', 1) - 1) * $dietas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $dieta = new Dieta();

        return view('dieta.create', compact('dieta'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DietaRequest $request): RedirectResponse
    {
        Dieta::create($request->validated());

        return Redirect::route('dietas.index')
            ->with('success', 'Dieta created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $dieta = Dieta::find($id);

        return view('dieta.show', compact('dieta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $dieta = Dieta::find($id);

        return view('dieta.edit', compact('dieta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DietaRequest $request, Dieta $dieta): RedirectResponse
    {
        $dieta->update($request->validated());

        return Redirect::route('dietas.index')
            ->with('success', 'Dieta updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Dieta::find($id)->delete();

        return Redirect::route('dietas.index')
            ->with('success', 'Dieta deleted successfully');
    }
}
