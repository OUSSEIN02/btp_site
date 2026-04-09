<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Message;
use App\Models\Collection;
use Carbon\Carbon;
use App\Models\Glass;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        return view('layouts.admin');
    }

    public function dashboard()
    {
        // Statistiques des rendez-vous
        $totalAppointments = Appointment::count();
        $pendingAppointments = Appointment::where('status', 'pending')->count();
        $confirmedAppointments = Appointment::where('status', 'confirme')->count();
        
        // Messages non lus
        $unreadMessages = ContactMessage::where('is_read', false)->count();
        
        // Collections actives
        $collections = Glass::all();
        
        // Derniers rendez-vous (5 derniers)
        $recentAppointments = Appointment::orderBy('created_at', 'desc')
                            ->limit(5)
                            ->get();
        
        $appointmentsCount = Appointment::count();
       
       
        return view('admin.dashboard', compact(
            'totalAppointments', 
            'pendingAppointments', 
            'confirmedAppointments', 
            'unreadMessages', 
            'collections', 
            'recentAppointments',
            'appointmentsCount'
        ));
    }

    public function rendezvous()
    {
        $appointments = Appointment::orderBy('created_at', 'desc')->paginate(10);
        
        $totalAppointments = Appointment::count();
      

        return view('admin.rendez-vous', compact('appointments'));
    }

    public function messages()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(10);
        
        $totalMessages = ContactMessage::count();
        $unreadMessages = ContactMessage::where('is_read', false)->count();
        $readMessages = ContactMessage::where('is_read', true)->count();
        
        return view('admin.messages.index', compact('messages', 'totalMessages', 'unreadMessages', 'readMessages'));
    }


    public function lunettes()
    {
        return view('admin.collections.index');
    }
}
