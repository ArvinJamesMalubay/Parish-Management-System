<?php

namespace App\Http\Controllers;

use App\Models\BaptismRecord;
use App\Models\Member;
use Illuminate\Http\Request;

class BaptismController extends Controller
{
    public function index()
    {
        $baptisms = BaptismRecord::with('member')->latest()->paginate(20);
        return view('baptisms.index', compact('baptisms'));
    }

    public function create()
    {
        $members = Member::orderBy('last_name')->get();
        return view('baptisms.create', compact('members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id'     => 'required|exists:members,id',
            'baptism_date'  => 'required|date',
            'officiant'     => 'nullable|string|max:255',
            'godparents'    => 'nullable|array',
            'church_book_no'=> 'nullable|string|max:50',
            'page_no'       => 'nullable|string|max:20',
            'notes'         => 'nullable|string',
        ]);

        BaptismRecord::create($validated);
        return redirect()->route('baptisms.index')->with('success', 'Baptism record added successfully.');
    }

    public function show(BaptismRecord $baptism)
    {
        $baptism->load('member');
        return view('baptisms.show', compact('baptism'));
    }

    public function edit(BaptismRecord $baptism)
    {
        $members = Member::orderBy('last_name')->get();
        return view('baptisms.edit', compact('baptism', 'members'));
    }

    public function update(Request $request, BaptismRecord $baptism)
    {
        $validated = $request->validate([
            'member_id'     => 'required|exists:members,id',
            'baptism_date'  => 'required|date',
            'officiant'     => 'nullable|string|max:255',
            'godparents'    => 'nullable|array',
            'church_book_no'=> 'nullable|string|max:50',
            'page_no'       => 'nullable|string|max:20',
            'notes'         => 'nullable|string',
        ]);

        $baptism->update($validated);
        return redirect()->route('baptisms.index')->with('success', 'Baptism record updated.');
    }

    public function destroy(BaptismRecord $baptism)
    {
        $baptism->delete();
        return redirect()->route('baptisms.index')->with('success', 'Baptism record deleted.');
    }
}
