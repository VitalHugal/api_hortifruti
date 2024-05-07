<?php

namespace App\Http\Controllers;

use App\Models\Fruta;
use Illuminate\Http\Request;

class FrutaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $fruta;

    public function __construct(Fruta $fruta)
    {
        $this->fruta = $fruta;
    }

    public function index()
    {
        //$fruta = Fruta::all();
        $fruta = $this->fruta->all();
        return $fruta;
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
        //$fruta = Fruta::create($request->all());
        $fruta = $this->fruta->create($request->all());
        return $fruta;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $fruta = $this->fruta->find($id);
        return $fruta;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fruta $fruta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // print_r($request->all());//os dados atualizados
        // echo '<hr>';
        // print_r($fruta->getAttributes());//os dados antigos

        $fruta = $this->fruta->find($id);
        $fruta->update($request->all());
        return $fruta;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $fruta = $this->fruta->find($id);
       if ($fruta === null) {
        return ['erro'=>'Recurso indisponivel - (destroy)'];
    }
       $fruta->delete();
       return ['msg'=>'A fruta foi removida'];
    }
}
