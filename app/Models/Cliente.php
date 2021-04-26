<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nombre',
        'direccion',
        'email',
        'fijo',
        'celular',
    ];

    public function scopeSearchAndPaginate($query, $nombre = '', $pagination = 25) {
        return $query->where('nombre', 'LIKE', "%$nombre%")
                    ->paginate($pagination);
    }
}
