<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RdvController extends Controller
{
    public function index()
    {
        return view('RendezVous.index');
    }
}
