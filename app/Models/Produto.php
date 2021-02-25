<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subcategoria;

class Produto extends Model
{
    use HasFactory;

            /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'descricao',
        'subcategoria_id',
        'imagem',
        'valor',
        'is_active',
    ];

    public function subcategoria() {
        return $this->belongsTo(Subcategoria::class);
    }

    public function categoria() {
        return $this->hasOneThrough(Categoria::class, Subcategoria::class, 'id', 'id', 'subcategoria_id', 'categoria_id');
    }

    protected $casts = [
        'tags' => 'array'
    ];
}
