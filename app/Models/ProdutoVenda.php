<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoVenda extends Model
{
    use HasFactory;

    protected $table = 'produto_venda';

    public $timestamps = false;

    protected $fillable = [
        'id_venda',
        'id_produto',
        'valor_venda',
        'quantidade',
        'desconto_venda'
    ];
}
