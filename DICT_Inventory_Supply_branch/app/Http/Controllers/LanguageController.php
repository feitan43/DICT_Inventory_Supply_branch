<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LanguageController extends Controller
{
    public function index(Request $request, $lang)
    {
        session(['APP_LOCATE' => $lang]);
        return redirect()->back();
    }

}
