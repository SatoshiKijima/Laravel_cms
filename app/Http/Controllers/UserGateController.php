<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserGateController extends Controller
{
    public function index()
    {
        return view('usergate');
    }
}
