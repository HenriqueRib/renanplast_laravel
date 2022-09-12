<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FotoProduto extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_produto',
        'imagem_produto',
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function produto()
    {
        return $this->hasOne(Produto::class, 'id', 'id_produto');
    }
}
