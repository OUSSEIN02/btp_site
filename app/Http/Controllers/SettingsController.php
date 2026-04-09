<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\CompanySetting;
use App\Models\Service;

class SettingsController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('admin.settings.index', compact('services'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'about'    => 'nullable|string',
            'services' => 'nullable|string',
            'phone'    => 'nullable|string|max:20',
            'email'    => 'nullable|email|max:255',
            'address'  => 'nullable|string|max:255',
        ]);

        // Toujours une seule ligne (mini CMS)
        $setting = CompanySetting::first();

        if (!$setting) {
            $setting = CompanySetting::create($validated);
        } else {
            $setting->update($validated);
        }

        return back()->with('success', 'Informations mises à jour avec succès ✅');
    }
}
