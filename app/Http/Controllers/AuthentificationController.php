<?php

namespace App\Http\Controllers;

use App\Models\ModelClient;
use App\Models\ModelAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthentificationController extends Controller
{
    public function loginClient(Request $request)
    {
        $numTelephoneClient = $request->input('numeroTel');
        Session::put('numeroTel', $numTelephoneClient);
        $getNumClient = ModelClient::getNumeroClient($numTelephoneClient);
        if ($getNumClient)
        {
            return view('frontOffice.client.voirTout',[
                'clientcoworker' =>$getNumClient,

            ]);
        }
        else
        {
            return view('frontoffice.client.loginClient');

        }

    }

    public function loginAdmin(Request $request)
    {
        $nomAdmin = $request->input('nomAdmin');
        $motdepasse = $request->input('motdepasse');
        $loginAdmin = ModelAdmin::getAdminLogin($nomAdmin,$motdepasse);
        if($loginAdmin)
        {

            return view('backOffice.admin.voirtoutAdmin');
        }else{
            return view('backOffice.admin.index');
        }

    }
}
