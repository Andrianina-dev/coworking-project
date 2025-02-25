<?php

namespace App\Http\Controllers;

use App\Models\ModelEspaceTravail;
use Illuminate\Http\Request;

class ImportEspaceCsv extends Controller
{
    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048'
        ]);

        $file = $request->file('csv_file');

        if (($handle = fopen($file, 'r')) !== false) {
            fgetcsv($handle); // Ignore la première ligne (headers)

            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                ModelEspaceTravail::create([
                    'nomEspaceTravail' => $data[0],
                    'prixEspaceTravail' => $data[1]
                ]);
            }

            fclose($handle);
        }

        return view('frontOffice.sucess.importOk');
    }
}
?>
