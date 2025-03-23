<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BroadcastMessage;
use Illuminate\Http\Request;

class BroadcastMessageController extends Controller
{
    public function index()
    {
        $messages = BroadcastMessage::all();
        return view('admin.broadcast.index', compact('messages'));
    }

    public function create()
    {
        return view('admin.broadcast.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        BroadcastMessage::create($request->only('title', 'content', 'is_active'));

        return redirect()->route('admin.broadcast.index')->with('success', 'Message created successfully!');
    }

    public function edit($id)
    {
        $message = BroadcastMessage::findOrFail($id);
        return view('admin.broadcast.edit', compact('message'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $message = BroadcastMessage::findOrFail($id);
        $message->update($request->only('title', 'content', 'is_active'));

        return redirect()->route('admin.broadcast.index')->with('success', 'Message updated successfully!');
    }

    public function destroy($id)
    {
        $message = BroadcastMessage::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.broadcast.index')->with('success', 'Message deleted successfully!');
    }
}
