<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Alimento;
use Illuminate\Http\Request;

class AlimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $alimentos = \App\Models\Alimento::all(); // o paginate() si prefieres paginación
        return view('alimentos.alimento.index', compact('alimentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('alimentos.alimento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $requestData = $request->all();

        Alimento::create($requestData);

        return redirect('alimento')->with('flash_message', 'Alimento added!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $alimento = Alimento::findOrFail($id);
        return view('alimentos.alimento.show', compact('alimento'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $alimento = Alimento::findOrFail($id);
        return view('alimentos.alimento.edit', compact('alimento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $alimento = Alimento::findOrFail($id);
        $alimento->update($requestData);

        return redirect('alimento')->with('flash_message', 'Alimento updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Alimento::destroy($id);

        return redirect('alimento')->with('flash_message', 'Alimento deleted!');
    }
}
