<?php

use App\Http\Controllers\AuthentificationController;
use App\Http\Controllers\ChiffreAffaireController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\EspaceTravailController;
use App\Http\Controllers\espacetravailJFetWE;
use App\Http\Controllers\ImportEspaceCsv;
use App\Http\Controllers\importOptionCsv;
use App\Http\Controllers\importPaiement;
use App\Http\Controllers\importReservationCsv;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StatutController;
use Illuminate\Support\Facades\Route;

Route::get('/ ', function () {
    return view('frontOffice.client.loginClient');
});

Route::get('/loginAdmin ', function () {
    return view('backOffice.admin.index');
});

Route::post('/loginClient', [AuthentificationController::class, 'loginClient'])->name('loginClient');
Route::get('/afficheEspaceTravail', [EspaceTravailController::class, 'afficheEspaceTravail'])->name('afficheEspaceTravail');
Route::post('/listEspaceTravail', [EspaceTravailController::class, 'afficheEspaceTravail'])->name('listEspaceTravail');
Route::get('/makeReservation', [ReservationController::class, 'faireUneReservation'])->name('m1akeReservation');
Route::post('/insertReservation', [ReservationController::class, 'insertReservation'])->name('insertReservation');
Route::get('/myreservation', [ReservationController::class, 'myReservation'])->name('myreservation');
Route::get('/lePaiement', [PaiementController::class, 'voirPaiement'])->name('lePaiement');

Route::get('/insertionReservation ', function ()
{
    return view('frontOffice.reservation.reservation');
})->name('insertionReservation');


// backOffice administrteur

Route::post('/loginAdmin', [AuthentificationController::class, 'loginAdmin'])->name('loginAdmin');



Route::post('/getReferencePaiement', [PaiementController::class, 'getRefPaiement'])->name('getReferencePaiement');
Route::get('/afficheAttentePaiement', [PaiementController::class, 'getPaiementRefAttente'])->name('afficheAttentePaiement');
Route::get('/validationPaiement', [PaiementController::class, 'validationPaiement'])->name('validationPaiement');

// input fichier a inserer........
Route::get('/lesImportations ', function () {
    return view('backOffice.import.importEspaceTravail');
})->name('lesImportations');

Route::get('/optionaImporter ', function () {
    return view('backOffice.import.importOption');
})->name('optionaImporter');

Route::get('/paiementaImporter ', function () {
    return view('backOffice.import.importPaiement');
})->name('paiementaImporter');

Route::get('/reservationCsvImporter ', function () {
    return view('backOffice.import.importReservationCsv');
})->name('reservationCsvImporter');

// LES IMPORTS CSV A FAIRE ...................
Route::post('/optionImportCsv', [importOptionCsv::class, 'importCsv'])->name('optionImportCsv');
Route::post('/espaceImport', [ImportEspaceCsv::class, 'importCsv'])->name('espaceImport');
Route::post('/paiementImport', [importPaiement::class, 'importCsv'])->name('paiementImport');
Route::post('/reservationCsvImport', [importReservationCsv::class, 'importCsv'])->name('reservationCsvImport');

// EFFACEZ LA BASE DE DONNEE.......
Route::get('/deletedBase', [DatabaseController::class, 'deletedBaseExceptAdmin'])->name('deletedBase');

//
Route::get('/getAllOptions', [OptionController::class, 'getOptionPayante'])->name('getAllOptions');

//

Route::get('/rechercheChiffreAffaire ', function () {
    return view('backOffice.admin.chiffreAffaire');
})->name('rechercheChiffreAffaire');

Route::post('/afficheChiffreAffaire', [ChiffreAffaireController::class, 'voirChiffreAffaire'])->name('afficheChiffreAffaire');
Route::get('/inputPayeeNonPayee', function () {
    return view('backOffice.admin.filtre    ');
})->name('inputPayeeNonPayee');
Route::post('/filtrePayeeNonPayee', [PaiementController::class, 'showPayeeNonPayee'])->name('filtrePayeeNonPayee');


Route::get('/getTopCreneaux', [ReservationController::class, 'getTopCreneaux'])->name('getTopCreneaux');
Route::get('/annulezResa', [ReservationController::class, 'annulationResa'])->name('annulezResa');

Route::get('/getstatuts', [StatutController::class, 'getStatusAndActions'])->name('getStatus');
Route::post('/formJFetWE', [espacetravailJFetWE::class, 'afficheEspaceTravailFerieWE'])->name('formJFetWE');

// Route::get('/espacebyJFetWE ', function () {
//     return view('frontOffice.client.espaceTravailJFetWE');
// })->name('espacebyJFetWE');

Route::get('/espacebyJFetWE', [espacetravailJFetWE::class, 'afficheEspaceTravailFerieWE'])->name('espacebyJFetWE');
