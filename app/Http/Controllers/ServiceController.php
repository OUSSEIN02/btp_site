<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('created_at', 'desc')->get();
        return view('admin.settings.index', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Service::create($request->only('title','description'));

        return back()->with('success', 'Service ajouté avec succès !');
    }

    public function destroy($id)
    {
        Service::findOrFail($id)->delete();
        return back()->with('success', 'Service supprimé !');
    }
}
