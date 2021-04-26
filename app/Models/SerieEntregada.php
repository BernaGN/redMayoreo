<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SerieEntregada extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'series_entregadas';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'num_pedido',
        'cliente_id',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function detalleSerieEntregadas()
    {
        return $this->hasMany(DetalleSerieEntregada::class);
    }
}
