<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Member;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    public function index()
    {
        $families = Family::withCount('members')->latest()->paginate(20);
        return view('families.index', compact('families'));
    }

    public function create()
    {
        $members = Member::orderBy('last_name')->get();
        return view('families.create', compact('members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'family_name'    => 'required|string|max:255',
            'head_member_id' => 'nullable|exists:members,id',
            'address'        => 'nullable|string',
            'notes'          => 'nullable|string',
        ]);

        Family::create($validated);
        return redirect()->route('families.index')->with('success', 'Family record added successfully.');
    }

    public function show(Family $family)
    {
        $family->load('members', 'head');
        return view('families.show', compact('family'));
    }

    public function edit(Family $family)
    {
        $members = Member::orderBy('last_name')->get();
        return view('families.edit', compact('family', 'members'));
    }

    public function update(Request $request, Family $family)
    {
        $validated = $request->validate([
            'family_name'    => 'required|string|max:255',
            'head_member_id' => 'nullable|exists:members,id',
            'address'        => 'nullable|string',
            'notes'          => 'nullable|string',
        ]);

        $family->update($validated);
        return redirect()->route('families.show', $family)->with('success', 'Family record updated.');
    }

    public function destroy(Family $family)
    {
        $family->delete();
        return redirect()->route('families.index')->with('success', 'Family record deleted.');
    }
}
