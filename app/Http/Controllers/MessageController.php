<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->get();
        return view('admin.messages.index', compact('messages'));
    }

    public function show(Message $message)
    {
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.messages.show', compact('message'));
    }

    public function markAsRead(Message $message)
    {
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return response()->json([
            'success' => true
        ]);
    }

    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()
            ->route('messages.index')
            ->with('success', 'Message supprimé avec succès.');
    }
}
