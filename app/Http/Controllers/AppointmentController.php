<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'service' => 'required|string',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|string',
            'patient_type' => 'required|string',
            'message' => 'nullable|string'
        ]);

        $appointment = Appointment::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'service' => $validated['service'],
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $validated['appointment_time'],
            'patient_type' => $validated['patient_type'],
            'message' => $validated['message'],
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Rendez-vous enregistré avec succès',
            'appointment' => $appointment
        ]);
    }


    public function index()
    {
        $appointments = Appointment::orderBy('created_at', 'desc')->paginate(10);
        
        $totalAppointments = Appointment::count();
        $pendingAppointments = Appointment::where('statut', 'en_attente')->count();
        $confirmedAppointments = Appointment::where('statut', 'confirme')->count();
        $cancelledAppointments = Appointment::where('statut', 'annule')->count();
        
        return view('admin.appointments', compact(
            'appointments',
            'totalAppointments',
            'pendingAppointments',
            'confirmedAppointments',
            'cancelledAppointments'
        ));
    }
    
    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        return response()->json(['success' => true, 'appointment' => $appointment]);
    }
    
    public function updateStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = $request->status;
        $appointment->save();
        
        return response()->json(['success' => true]);
    }
    
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        
        return response()->json(['success' => true]);
    }
}