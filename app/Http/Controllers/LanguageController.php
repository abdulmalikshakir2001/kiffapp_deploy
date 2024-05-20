<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    //
    public function switchLang(Request $request)
    {
        // print_r($request->lang);

        if (array_key_exists($request->lang, Config::get('languages'))) {
                $request->session()->put('applocale', $request->lang);
                // echo "key exist";
                // echo $request->session()->get('applocale');
        }
        return Redirect::back();
    }
}
