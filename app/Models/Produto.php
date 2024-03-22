<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $casts = [
        'items' => 'array'
    ];

    protected $fillable = [
        'nome_produto',
        'descricao_produto',
        'valor_produto',
        'imagem_produto',
    ];

    public function produto(){
        return $this->belongsToMany(Venda::class);
    }

    public function estoque(){
        return $this->belongsTo(Estoque::class);
    }

}
