<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMon extends Model
{
    use HasFactory;
    protected $fillable = ['Nombre','Simbolo'];
}
