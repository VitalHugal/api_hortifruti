<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Legume extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descrição', 'imagem', 'preço', 'estoque'];

    public function rules()
    {
        return [
            'nome' => 'required|unique:legumes',
            'descrição' => 'required',
            'imagem' => 'required|file|mimes:png, jpg,jpeg',
            'preço' => 'required',
            'estoque' => 'required',
            
        ];
    }
    public function feedback(){
        return [
        'required'=> 'O campo :attribute é obrigatório.',
        'nome.unique' => 'O nome desse legume já existe.'
        ];
    }
}
