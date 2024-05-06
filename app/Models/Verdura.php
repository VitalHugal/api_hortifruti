<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verdura extends Model
{
    protected $fillable = ['nome', 'descrição', 'imagem', 'preço', 'estoque'];

    public function rules()
    {
        return [
            'nome' => 'required',
            'descrição' => 'required',
            'imagem' => 'required',
            'preço' => 'required',
            'estoque' => 'required',
            
        ];
    }
}
