<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;


class ContactController extends Controller
{

    public function index()
    {
        return view('contact.index');
    }

    public function adminindex()
    {
       
        
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:100',
            'message' => 'required|string|min:10'
        ]);

        // Enregistrer en base de données
        $contact = ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'is_read' => false
        ]);


        return response()->json([
            'success' => true,
            'message' => 'Votre message a bien été envoyé. Nous vous répondrons dans les plus brefs délais.',
            'contact' => $contact
        ]);
    }


    public function markAsRead($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->is_read = true;
        $message->save();
        
        return response()->json(['success' => true]);
    }
    
    public function reply(Request $request, $id)
    {
        $message = ContactMessage::findOrFail($id);
        
        // Envoyer l'email de réponse
        Mail::send([], [], function ($mail) use ($request, $message) {
            $mail->to($request->email)
                 ->subject($request->subject)
                 ->html($request->message);
        });
        
        // Marquer comme lu
        $message->is_read = true;
        $message->save();
        
        return response()->json(['success' => true]);
    }
    
    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();
        
        return response()->json(['success' => true]);
    }
}