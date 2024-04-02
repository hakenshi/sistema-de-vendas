<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $primaryKey = "id_produto";

    protected $table = 'estoque';

    public $timestamps = false;
    
    protected $fillable = [
        'id_produto',
        'quantidade_produto'
    ];

    public function produto(){
        return $this->hasMany(Produto::class, 'id', 'id_produto');
    }

}
