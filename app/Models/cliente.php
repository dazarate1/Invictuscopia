<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    use HasFactory;
    protected $table = 'clientes';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'telefono', 'correo','cedula','clases'];
    protected $guarded = [];
    public $timestamps = false;
}
