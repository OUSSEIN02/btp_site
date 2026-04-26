<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Realisation;
use App\Models\CompanySetting as Setting;
use App\Models\Service;
use App\Models\CompanySetting;

class HomeController extends Controller


{
   

    

    public function index()
    {
        $realisations = Realisation::latest()
            ->take(4)
            ->get();
            
    
        $company = CompanySetting::first(); 
    
        return view('welcome', compact('realisations', 'company'));
    }

    public function realisations(Request $request)
    {
        $realisations = Realisation::latest()->paginate(18); 

        $company = CompanySetting::first();

        return view('realisation', compact('realisations', 'company'));
    }

    public function presentations(Request $request){

        $setting = Setting::first();
        $services = Service::all();
        $company = CompanySetting::first(); 
        $realisations = Realisation::latest()
        ->take(8)
        ->get();
        return view('presentation', compact('realisations','setting','services','company'));
    }

    public function services(Request $request){

        $services = Service::all();
        $company = CompanySetting::first(); 
        $realisations = Realisation::latest()
        ->take(4)
        ->get();
        return view('service', compact('realisations', 'services', 'company'));
    }

    public function contact(request $request){
        $company = CompanySetting::first(); 
        return view('contact', compact('company'));
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
        
        $company = CompanySetting::first(); 

        return view('realisationShow', compact(
            'selectedRealisation', 
            'previousRealisation', 
            'nextRealisation',
            'company'
        ));
    }
}
