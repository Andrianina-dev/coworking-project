<?php

namespace App\Http\Controllers;

use App\Models\ModelOption;
use Illuminate\Http\Request;

class importOptionCsv extends Controller
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
                ModelOption::create([
                    'codes' => $data[0],
                    'nomOption' => $data[1],
                    'prixOption' =>$data[2],
                ]);
            }

            fclose($handle);
        }

        return view('frontOffice.sucess.importOk');
    }
}
?>
