<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Realisation;
use App\Models\CompanySetting as Setting;
use App\Models\Service;

class HomeController extends Controller


{
   

    

    public function index()
    {
        $realisations = Realisation::latest()
        ->take(4)
        ->get();

        return view('welcome', compact('realisations'));
    }

    public function realisations(Request $request){

        $realisations = Realisation::latest()->get();
        return view('realisation', compact('realisations'));
    }

    public function presentations(Request $request){

        $setting = Setting::first();
        $services = Service::all();
        $realisations = Realisation::latest()
        ->take(6)
        ->get();
        return view('presentation', compact('realisations','setting','services'));
    }

    public function services(Request $request){

        $services = Service::all();
        $realisations = Realisation::latest()
        ->take(4)
        ->get();
        return view('service', compact('realisations', 'services'));
    }

    public function contact(request $request){
        return view('contact');
    }

    public function show($id)
    {
        $selectedRealisation = Realisation::findOrFail($id);
        
        // Pour la navigation entre projets
        $previousRealisation = Realisation::where('id', '<', $selectedRealisation->id)
            ->orderBy('id', 'desc')
            ->first();
            
        $nextRealisation = Realisation::where('id', '>', $selectedRealisation->id)
            ->orderBy('id', 'asc')
            ->first();
        
        return view('realisationShow', compact(
            'selectedRealisation', 
            'previousRealisation', 
            'nextRealisation'
        ));
    }
}
