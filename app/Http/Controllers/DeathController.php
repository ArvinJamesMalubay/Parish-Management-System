<?php

namespace App\Http\Controllers;

use App\Models\DeathRecord;
use App\Models\Member;
use Illuminate\Http\Request;

class DeathController extends Controller
{
    public function index()
    {
        $deaths = DeathRecord::with('member')->latest()->paginate(20);
        return view('deaths.index', compact('deaths'));
    }

    public function create()
    {
        $members = Member::orderBy('last_name')->get();
        return view('deaths.create', compact('members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id'      => 'required|exists:members,id',
            'death_date'     => 'required|date',
            'cause_of_death' => 'nullable|string|max:255',
            'burial_date'    => 'nullable|date',
            'burial_place'   => 'nullable|string|max:255',
            'church_book_no' => 'nullable|string|max:50',
            'page_no'        => 'nullable|string|max:20',
            'notes'          => 'nullable|string',
        ]);

        DeathRecord::create($validated);
        return redirect()->route('deaths.index')->with('success', 'Death record added successfully.');
    }

    public function show(DeathRecord $death)
    {
        $death->load('member');
        return view('deaths.show', compact('death'));
    }

    public function edit(DeathRecord $death)
    {
        $members = Member::orderBy('last_name')->get();
        return view('deaths.edit', compact('death', 'members'));
    }

    public function update(Request $request, DeathRecord $death)
    {
        $validated = $request->validate([
            'member_id'      => 'required|exists:members,id',
            'death_date'     => 'required|date',
            'cause_of_death' => 'nullable|string|max:255',
            'burial_date'    => 'nullable|date',
            'burial_place'   => 'nullable|string|max:255',
            'church_book_no' => 'nullable|string|max:50',
            'page_no'        => 'nullable|string|max:20',
            'notes'          => 'nullable|string',
        ]);

        $death->update($validated);
        return redirect()->route('deaths.index')->with('success', 'Death record updated.');
    }

    public function destroy(DeathRecord $death)
    {
        $death->delete();
        return redirect()->route('deaths.index')->with('success', 'Death record deleted.');
    }
}
