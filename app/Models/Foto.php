<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Foto extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'url',
    ];

    protected $dates = [
        'deleted_at'
    ];
}
