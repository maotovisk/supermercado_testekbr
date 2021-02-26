<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subcategoria;
use App\Models\Produto;

class Categoria extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
    ];

    public function produtos(){
        return $this->hasManyThrough(Produto::class, Subcategoria::class);
    }

    public function subcategorias() {
        return $this->hasMany(Subcategoria::class);
    }

}
