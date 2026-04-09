<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InitiativesController extends Controller
{
    public function index()
    {
        // $initiatives = [
        //     ['id' => 1, 'name' => 'Initiative 1', 'description' => 'Description de l\'initiative 1'],
        //     ['id' => 2, 'name' => 'Initiative 2', 'description' => 'Description de l\'initiative 2'],
        //     ['id' => 3, 'name' => 'Initiative 3', 'description' => 'Description de l\'initiative 3'],
        // ];

        return view('initiatives.index');
    }
}
