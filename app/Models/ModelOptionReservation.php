<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelOptionReservation extends Model
{
    // Define the table associated with this model
    protected $table = 'optionReservation';

    // Define the primary key
    protected $primaryKey = 'idOptionReservation';

    // Disable the timestamps (created_at, updated_at) if they are not present in your table
    public $timestamps = false;

    /**
     * Function to select records from the optionReservation table
     *
     * @param string $refReservation
     * @return mixed
     */
    public static function selectByRefReservation($refReservation)
    {
        $sql = "SELECT * FROM optionReservation WHERE refReservation = ?";
        return DB::select($sql, [$refReservation]);
    }

    /**
     * Function to insert a new record into the optionReservation table
     *
     * @param string $refReservation
     * @param int $idlesOptions
     * @return bool
     */
    public static function insertOptionReservation($refReservation, $idlesOptions)
    {
        // Insert the record into the optionReservation table with both refReservation and idlesOptions
        $sql = "INSERT INTO optionReservation (refReservation, idlesOptions) VALUES (?, ?)";
        return DB::insert($sql, [$refReservation, $idlesOptions]);
    }


        public static function insertAllTempOptions($tempOptionReservation)
    {
        // Loop through the tempOptionReservation table and insert each record
        foreach ($tempOptionReservation as $tempReservation) {
            // Call the insertOptionReservation function for each entry in the temporary table
            self::insertOptionReservation($tempReservation['refReservation'], $tempReservation['idOption']);
        }
    }
}
?>
