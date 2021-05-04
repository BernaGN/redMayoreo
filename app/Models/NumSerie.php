<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NumSerie extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'num_series';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'nombre',
    ];

    public function detalleSerieEntregada()
    {
        return $this->hasMany(DetalleSerieEntregada::class, 'serie_id');
    }
}
