<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    protected $table = 'presupuestos';
    protected $primaryKey = 'id_presupuesto';
    public $timestamps = false;
    protected $fillable = [
        'nombre_cliente', 'empresa_cliente', 'ubicacion', 'nombre_proyecto',
        'fecha', 'subtotal', 'iva', 'total', 'vigencia_dias',
        'anticipo_porcentaje', 'observaciones'
    ];

    public function detalles()
    {
        return $this->hasMany(DetallePresupuesto::class, 'id_presupuesto');
    }
}