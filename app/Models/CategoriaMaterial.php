<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaMaterial extends Model
{
    protected $table = 'categorias_material';

    protected $primaryKey = 'id_categoria';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public function materiales()
    {
        return $this->hasMany(
            Material::class,
            'id_categoria',
            'id_categoria'
        );
    }
}