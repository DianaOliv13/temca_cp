<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';

    protected $primaryKey = 'id_proveedor';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'telefono',
        'correo',
        'rfc'
    ];

    public function materiales()
    {
        return $this->hasMany(Material::class, 'id_proveedor', 'id_proveedor');
    }
}