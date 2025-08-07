<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    use HasFactory;
    protected $table = 'pagos';
    protected $primaryKey = 'id';
    protected $fillable = ['paydate', 'nombre', 'category','plan','monto','paymethod'];
    protected $guarded = [];
    public $timestamps = false;

    protected $casts = [
        'paydate' => 'date',
    ];


}
