<?php

namespace App\Http\Controllers;

use App\Models\MarriageRecord;
use App\Models\Member;
use Illuminate\Http\Request;

class MarriageController extends Controller
{
    public function index()
    {
        $marriages = MarriageRecord::with('groom', 'bride')->latest()->paginate(20);
        return view('marriages.index', compact('marriages'));
    }

    public function create()
    {
        $members = Member::orderBy('last_name')->get();
        return view('marriages.create', compact('members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'groom_member_id' => 'required|exists:members,id',
            'bride_member_id' => 'required|exists:members,id|different:groom_member_id',
            'marriage_date'   => 'required|date',
            'officiant'       => 'nullable|string|max:255',
            'witnesses'       => 'nullable|array',
            'church_book_no'  => 'nullable|string|max:50',
            'page_no'         => 'nullable|string|max:20',
            'notes'           => 'nullable|string',
        ]);

        MarriageRecord::create($validated);
        return redirect()->route('marriages.index')->with('success', 'Marriage record added successfully.');
    }

    public function show(MarriageRecord $marriage)
    {
        $marriage->load('groom', 'bride');
        return view('marriages.show', compact('marriage'));
    }

    public function edit(MarriageRecord $marriage)
    {
        $members = Member::orderBy('last_name')->get();
        return view('marriages.edit', compact('marriage', 'members'));
    }

    public function update(Request $request, MarriageRecord $marriage)
    {
        $validated = $request->validate([
            'groom_member_id' => 'required|exists:members,id',
            'bride_member_id' => 'required|exists:members,id|different:groom_member_id',
            'marriage_date'   => 'required|date',
            'officiant'       => 'nullable|string|max:255',
            'witnesses'       => 'nullable|array',
            'church_book_no'  => 'nullable|string|max:50',
            'page_no'         => 'nullable|string|max:20',
            'notes'           => 'nullable|string',
        ]);

        $marriage->update($validated);
        return redirect()->route('marriages.index')->with('success', 'Marriage record updated.');
    }

    public function destroy(MarriageRecord $marriage)
    {
        $marriage->delete();
        return redirect()->route('marriages.index')->with('success', 'Marriage record deleted.');
    }
}
