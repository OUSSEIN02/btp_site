<?php

namespace App\Http\Controllers;

use App\Models\CompanySetting;
use Illuminate\Http\Request;
use App\Models\Service;
class CompanySettingController extends Controller
{

    
    public function index()

    {
        $services = Service::all();
        return view('admin.settings.index', compact('services'));
    }

    public function edit()
    {
        $setting = CompanySetting::first();
        return view('admin.settings.index', compact('setting'));
    }

    public function updateAbout(Request $request)
    {
        $request->validate([
            'about' => 'nullable|string',
        ]);
    
        $setting = CompanySetting::firstOrCreate([]);
    
        $setting->about = $request->about;
        $setting->save();
    
        return back()->with('success', 'Qui sommes-nous mis à jour ✅');
    }

    public function updateServices(Request $request)
    {
        $request->validate([
            'services' => 'nullable|string',
        ]);

        $setting = CompanySetting::firstOrCreate([]);

        $setting->services = $request->services;
        $setting->save();

        return back()->with('success', 'Prestations mises à jour ✅');
    }

    public function updateContact(Request $request)
    {
        $request->validate([
            'phone'   => 'nullable|string|max:20',
            'email'   => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        $setting = CompanySetting::firstOrCreate([]);

        $setting->phone   = $request->phone;
        $setting->email   = $request->email;
        $setting->address = $request->address;

        $setting->save();

        return back()->with('success', 'Contact mis à jour ✅');
    }
}