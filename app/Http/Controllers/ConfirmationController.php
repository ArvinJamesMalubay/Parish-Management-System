<?php

namespace App\Http\Controllers;

use App\Models\ConfirmationRecord;
use App\Models\Member;
use Illuminate\Http\Request;

class ConfirmationController extends Controller
{
    public function index()
    {
        $confirmations = ConfirmationRecord::with('member')->latest()->paginate(20);
        return view('confirmations.index', compact('confirmations'));
    }

    public function create()
    {
        $members = Member::orderBy('last_name')->get();
        return view('confirmations.create', compact('members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id'         => 'required|exists:members,id',
            'confirmation_date' => 'required|date',
            'officiant'         => 'nullable|string|max:255',
            'sponsor'           => 'nullable|string|max:255',
            'church_book_no'    => 'nullable|string|max:50',
            'page_no'           => 'nullable|string|max:20',
            'notes'             => 'nullable|string',
        ]);

        ConfirmationRecord::create($validated);
        return redirect()->route('confirmations.index')->with('success', 'Confirmation record added successfully.');
    }

    public function show(ConfirmationRecord $confirmation)
    {
        $confirmation->load('member');
        return view('confirmations.show', compact('confirmation'));
    }

    public function edit(ConfirmationRecord $confirmation)
    {
        $members = Member::orderBy('last_name')->get();
        return view('confirmations.edit', compact('confirmation', 'members'));
    }

    public function update(Request $request, ConfirmationRecord $confirmation)
    {
        $validated = $request->validate([
            'member_id'         => 'required|exists:members,id',
            'confirmation_date' => 'required|date',
            'officiant'         => 'nullable|string|max:255',
            'sponsor'           => 'nullable|string|max:255',
            'church_book_no'    => 'nullable|string|max:50',
            'page_no'           => 'nullable|string|max:20',
            'notes'             => 'nullable|string',
        ]);

        $confirmation->update($validated);
        return redirect()->route('confirmations.index')->with('success', 'Confirmation record updated.');
    }

    public function destroy(ConfirmationRecord $confirmation)
    {
        $confirmation->delete();
        return redirect()->route('confirmations.index')->with('success', 'Confirmation record deleted.');
    }
}
