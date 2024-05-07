<?php

namespace App\Http\Controllers;

use App\Models\Legume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        //recuperando o arquivo de imagem da requisição
        $imagem = $request->file('imagem');
        //usando metodo store para guardar a imagem/modelos do diretorio publico 
        $imagem_urn = $imagem->store('imagens/legumes', 'public');
        //criando uma novo registro no banco de dados
        $legume = $this->legume->create([
            'nome' => $request->nome,
            'descrição' => $request->descrição,
            'imagem' => $imagem_urn,
            'preço' => $request->preço,
            'estoque' => $request->estoque,
        ]);

        return response()->json($legume, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //Se item não encontrado através do seu id - erro
        $legume = $this->legume->find($id);
        if ($legume === null) {
            return response()->json(['erro' => 'Recurso indisponivel - (Método show)'], 404);
        }
        //Encontrou item retorna 
        return response()->json($legume, 200);
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
    public function update(Request $request, $id)
    {
        // Verifica se o item existe através do ID
        $legume = $this->legume->find($id);
        // Se o método for PATCH
        if ($request->method() === 'PATCH') {
            // Armazena dinamicamente as regras de validação aplicáveis aos campos sendo atualizados
            $regrasDinamicas = [];
            foreach ($legume->rules() as $input => $regra) {
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            // Aplica as regras dinâmicas de validação
            $request->validate($regrasDinamicas);
        } else {
            $request->validate($legume->rules());
        }
        //Se for recuperado arquivo de imagem pela rquisição - excluir imagem existente para add nova 
        if ($request->file('imagem')) {
            Storage::disk('public/imagens/legumes')->delete($legume->imagem);
        }

        //
        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens/legumes', 'public');
        $legume->fill($request->all());
        $legume->imagem = $imagem_urn;
        // Atualiza os dados do legume - retorna
        $legume->update($request->all());
        return response()->json($legume, 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //Se item não encontrado através do seu id - erro
        $legume = $this->legume->find($id);
        if ($legume === null) {
            return response()->json(['erro' => 'Recurso indisponivel - (Método destroy)'], 404);
        }
        //exclusão da imagem dentro da pasta legumes 
        Storage::disk('public/imagens/legumes')->delete($legume->imagem);
        //econtrou o item - exclui - retorna sucesso
        $legume->delete();
        return response()->json(['msg' => 'O Legume foi removida com sucesso!'], 200);
    }
}
