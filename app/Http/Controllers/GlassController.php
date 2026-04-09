<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Glass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GlassController extends Controller
{
    public function index()
    {
        $glasses = Glass::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.collections.index', compact('glasses'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'brand' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('glasses', 'public');
            $validated['image'] = $path;
        }
        
        $validated['is_active'] = $request->is_active ?? true;
        
        $glass = Glass::create($validated);
        
        return response()->json(['success' => true, 'glass' => $glass]);
    }
    
    public function edit($id)
    {
        $glass = Glass::findOrFail($id);
        return response()->json(['success' => true, 'glass' => $glass]);
    }
    
    public function update(Request $request, $id)
    {
        $glass = Glass::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'brand' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);
        
        if ($request->hasFile('image')) {
            if ($glass->image) {
                Storage::disk('public')->delete($glass->image);
            }
            $path = $request->file('image')->store('glasses', 'public');
            $validated['image'] = $path;
        }
        
        $validated['is_active'] = $request->is_active ?? false;
        
        $glass->update($validated);
        
        return response()->json(['success' => true, 'glass' => $glass]);
    }
    
    public function toggleStatus($id)
    {
        $glass = Glass::findOrFail($id);
        $glass->is_active = !$glass->is_active;
        $glass->save();
        
        return response()->json(['success' => true]);
    }
    
    public function destroy($id)
    {
        $glass = Glass::findOrFail($id);
        
        if ($glass->image) {
            Storage::disk('public')->delete($glass->image);
        }
        
        $glass->delete();
        
        return response()->json(['success' => true]);
    }
}