<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailAttachment;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmailAttachmentController extends Controller
{
    public function index()
    {
        $attachments = EmailAttachment::with('template')->latest()->get();
        return view('email-attachments.index', compact('attachments'));
    }

    public function create()
    {
        $templates = EmailTemplate::all();
        return view('email-attachments.create', compact('templates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'template_id' => 'required|exists:email_templates,id',
            'file' => 'required|file|max:2048',
        ]);

        $file = $request->file('file');
        $path = $file->store('attachments', 'public');

        EmailAttachment::create([
            'template_id' => $request->template_id,
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
            'file_type' => $file->getMimeType(),
        ]);

        return redirect()->route('email-attachments.index')->with('success', 'Attachment uploaded successfully!');
    }

    public function edit(EmailAttachment $emailAttachment)
    {
        $templates = EmailTemplate::all();
        return view('email-attachments.edit', compact('emailAttachment', 'templates'));
    }

    public function update(Request $request, EmailAttachment $emailAttachment)
    {
        $request->validate([
            'template_id' => 'required|exists:email_templates,id',
            'file' => 'nullable|file|max:2048',
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($emailAttachment->file_path);

            $file = $request->file('file');
            $path = $file->store('attachments', 'public');

            $emailAttachment->update([
                'template_id' => $request->template_id,
                'file_path' => $path,
                'file_name' => $file->getClientOriginalName(),
                'file_type' => $file->getMimeType(),
            ]);
        } else {
            $emailAttachment->update([
                'template_id' => $request->template_id,
            ]);
        }

        return redirect()->route('email-attachments.index')->with('success', 'Attachment updated successfully!');
    }
}
