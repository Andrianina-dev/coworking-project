<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JourFerie extends Model
{
    use HasFactory;

    protected $table = 'jourFeries';

    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'mois',
        'jour',
    ];
}
