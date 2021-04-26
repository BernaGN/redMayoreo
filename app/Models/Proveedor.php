<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'proveedores';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nombre',
        'direccion',
        'email',
        'fijo',
        'celular',
        'representante',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function scopeSearchAndPaginate($query, $nombre = '', $pagination = 25) {
        return $query->where('nombre', 'LIKE', "%$nombre%")
                    ->orWhere('representante', 'LIKE', "%$nombre%")
                    ->paginate($pagination);
    }
}
