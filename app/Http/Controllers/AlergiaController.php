<?php

namespace App\Http\Controllers;

use App\Models\Alergia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlergiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $alergia = Alergia::where('descripcion', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $alergia = Alergia::latest()->paginate($perPage);
        }

        return view('alergias.alergia.index', compact('alergia'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('alergias.alergia.create');
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

        Alergia::create($requestData);

        return redirect('alergia')->with('flash_message', 'Alergia added!');
    }

    public function show($id)
    {
        $alergia = \App\Models\Alergia::findOrFail($id);
        return view('alergias.alergia.show', compact('alergia'));
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
        $alergia = \App\Models\Alergia::findOrFail($id);
        return view('alergias.alergia.edit', compact('alergia'));
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

        $Alergia = Alergia::findOrFail($id);
        $Alergia->update($requestData);

        return redirect('alergia')->with('flash_message', 'Alergia updated!');
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
        Alergia::destroy($id);

        return redirect('alergia')->with('flash_message', 'Alergia deleted!');
    }
}
