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
        'user_id',
        'nome_produto',
        'descricao_produto',
        'valor_produto',
        'imagem_produto',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id');
    }


}
