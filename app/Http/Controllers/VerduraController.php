<?php

namespace App\Http\Controllers;

use App\Models\Verdura;
use Illuminate\Http\Request;

class VerduraController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $verdura;

    public function __construct(Verdura $verdura)
    {
        $this->verdura = $verdura;
    }
    public function index()
    {
        //$verdura = Verdura::all();
        $verdura = $this->verdura->all();
        return $verdura;
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
        $verdura = $this->verdura->create($request->all());
        return $verdura;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $verdura = $this->verdura->find($id);
        return $verdura;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Verdura $verdura)
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

        $verdura = $this->verdura->find($id);
        $verdura->update($request->all());
        return $verdura;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $verdura = $this->verdura->find($id);
       if ($verdura === null) {
        return ['erro'=>'Recurso indisponivel - (destroy)'];
    }
       $verdura->delete();
       return ['msg'=>'A verdura foi removida'];
    }
}
