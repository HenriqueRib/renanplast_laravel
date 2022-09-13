<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nome',
        'descricao',
        'modo',
        'medidas',
        'lote',
        'serie',
        'preco',
        'estoque',
        'ativo',
        'cores',
        'observacao',
        'image',
        'view',
        'principal',
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function foto_produto()
    {
        return $this->hasMany(FotoProduto::class, 'id_produto', 'id');
    }
}
