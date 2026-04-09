<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LunettesController extends Controller
{
    public function index()
    {
        // $lunettes = [
        //     ['id' => 1, 'name' => 'Lunette de soleil', 'price' => 50],
        //     ['id' => 2, 'name' => 'Lunette de vue', 'price' => 100],
        //     ['id' => 3, 'name' => 'Lunette de sport', 'price' => 75],
        // ];

        return view('lunettes.index');
    }
}
