<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $table = 'vendas';

    protected $fillable = [
        'id_produto',
        'id_usuario',
        'valor_venda',
        'quantidade_venda'
    ];


    public function user(){
        return $this->belongsTo(User::class, 'id');
    }

    public function venda(){
        return $this->belongsToMany(Produto::class);
    }

}
