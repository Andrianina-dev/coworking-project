<?php

namespace App\Http\Controllers;

use App\Models\ModelOption;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function getOptionPayante()
    {
        $getOptions = ModelOption::getAllOption();
        return view('backOffice.option.option',[
            'listOptionPayante' =>$getOptions,
        ]);
    }
}
