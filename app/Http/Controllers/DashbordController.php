<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membre;
use App\Models\Actualite;
use App\Models\Message;

class DashbordController extends Controller
{
    public function index()
    {
        return view('admin.dashbord.index', [
            'totalMembres'  => Membre::count(),
            'totalActus'    => Actualite::count(),
            'totalMessages' => Message::count(),

            'lastActus' => Actualite::latest()->take(5)->get(),
        ]);
    }
}
