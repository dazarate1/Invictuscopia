<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metrics extends Model
{
    use HasFactory;

    protected $table = 'metricsclients';
    public $timestamps = false; // 👈 Desactiva created_at y updated_at

    protected $fillable = [
        'client_id',
        'score_corporal',
        'peso',
        'imc',
        'grasa_corporal',
        'lvl_agua',
        'grasa_visc',
        'musculo',
        'proteina',
        'metabolismo',
        'masa_osea'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
