<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class Subcategoria extends Model
{
    use HasFactory;

            /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'categoria_id'
    ];
    
    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }
}
