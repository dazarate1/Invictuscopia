<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'clientes';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'telefono', 'correo','cedula','clases'];
    protected $guarded = [];
    public $timestamps = false;

    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];

   public function metrics()
    {
        return $this->hasMany(Metrics::class, 'client_id');
    }
}
