<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class DetallePresupuesto extends Model
{
    protected $table = 'detalle_presupuestos';
    protected $primaryKey = 'id_detalle';
    public $timestamps = false;
    protected $fillable = [
        'id_presupuesto',
        'id_material',
        'cantidad',
        'precio_unitario',
        'importe',
        'area_o_volumen',
        'rendimiento',
        'modo_calculo'
    ];

    public function material()
    {
        return $this->belongsTo(Material::class, 'id_material');
    }
}