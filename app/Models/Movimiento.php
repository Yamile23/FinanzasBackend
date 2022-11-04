<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;
    protected $fillable = ['fecha','Monto','cuentaOrigen_id','cuentaDestino_id','categoria_id','tipo_id'];
}
