<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetalleSerieEntregada extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'detalle_series_entregadas';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'serie_entregada_id',
        'producto_id',
        'serie_id',
    ];

    public function serieEntregadas()
    {
        return $this->hasMany(DetalleSerieEntregada::class);
    }

    public function numSeries()
    {
        return $this->belongsTo(NumSerie::class, 'serie_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
