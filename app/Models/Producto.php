<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nombre',
        'clave',
        'proveedor_id',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function detalleSerieEntregada()
    {
        return $this->belongsTo(DetalleSerieEntregada::class);
    }

    public function scopeSearchAndPaginate($query, $nombre = '', $pagination = 25) {
        return $query->where('nombre', 'LIKE', "%$nombre%")
                    ->paginate($pagination);
    }
}
