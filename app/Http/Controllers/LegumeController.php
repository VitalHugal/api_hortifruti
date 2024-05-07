<?php

namespace App\Http\Controllers;

use App\Models\Legume;
use Illuminate\Http\Request;

class LegumeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $legume;

    public function __construct(Legume $legume)
    {
        $this->legume = $legume;
    }
    public function index()
    {
        //$legume = Legume::all();
        $legume = $this->legume->all();
        return $legume;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->legume->rules());

        //$fruta = Fruta::create($request->all());
        $legume = $this->legume->create($request->all());
        return $legume;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $legume = $this->legume->find($id);
        if ($legume === null) {
            return ['erro' => 'Recurso indisponivel - (Método show)', 404];
        }
        $legume = $this->legume->find($id);
        return $legume;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Legume $legume)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        // print_r($request->all());//os dados atualizados
        // echo '<hr>';
        // print_r($fruta->getAttributes());//os dados antigos
        $legume = $this->legume->find($id);
        if ($legume === null) {
            return ['erro' => 'Recurso indisponivel - (Método update)', 404];
        }
        $legume = $this->legume->find($id);
        $legume->update($request->all());
        return $legume;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $legume = $this->legume->find($id);
        if ($legume === null) {
            return ['erro' => 'Recurso indisponivel - (Método destroy)', 404];
        }
        $legume->delete();
        return ['msg' => 'O legume foi removido'];
    }
}
