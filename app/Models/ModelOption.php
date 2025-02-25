<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelOption extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'lesOptions';

    // Specify the primary key (optional if it's `id`)
    protected $primaryKey = 'idlesOptions';

    // Define fillable fields for mass assignment
    protected $fillable = [
        'codes',
        'nomOption',
        'prixOption'

    ];

    // Disable timestamps if the table does not have `created_at` and `updated_at` columns
    public $timestamps = false;

    public static function getAllOption()
    {
        $requete =DB::select('select * from lesOptions');
        return $requete;
    }

}
