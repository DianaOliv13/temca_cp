<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'materiales';

    protected $primaryKey = 'id_material';

    public $timestamps = false;

    protected $fillable = [
        'id_proveedor',
        'id_categoria',
        'nombre',
        'descripcion',
        'unidad',
        'precio_unitario',
        'fecha_actualizacion',
        'unidad_rendimiento'
    ];

    public function proveedor()
    {
        return $this->belongsTo(
            Proveedor::class,
            'id_proveedor',
            'id_proveedor'
        );
    }

    public function categoria()
    {
        return $this->belongsTo(
            CategoriaMaterial::class,
            'id_categoria',
            'id_categoria'
        );
    }
}