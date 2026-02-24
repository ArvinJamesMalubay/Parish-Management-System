<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Family;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::with('family')->latest()->paginate(20);
        return view('members.index', compact('members'));
    }

    public function create()
    {
        $families = Family::orderBy('family_name')->get();
        return view('members.create', compact('families'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'    => 'required|string|max:100',
            'middle_name'   => 'nullable|string|max:100',
            'last_name'     => 'required|string|max:100',
            'gender'        => 'required|in:Male,Female',
            'birth_date'    => 'nullable|date',
            'birth_place'   => 'nullable|string|max:255',
            'address'       => 'nullable|string',
            'contact_number'=> 'nullable|string|max:20',
            'email'         => 'nullable|email|max:255',
            'civil_status'  => 'required|in:Single,Married,Widowed,Separated',
            'family_id'     => 'nullable|exists:families,id',
        ]);

        Member::create($validated);
        return redirect()->route('members.index')->with('success', 'Member added successfully.');
    }

    public function show(Member $member)
    {
        $member->load('family', 'baptismRecord', 'confirmationRecord', 'deathRecord');
        return view('members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        $families = Family::orderBy('family_name')->get();
        return view('members.edit', compact('member', 'families'));
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'first_name'    => 'required|string|max:100',
            'middle_name'   => 'nullable|string|max:100',
            'last_name'     => 'required|string|max:100',
            'gender'        => 'required|in:Male,Female',
            'birth_date'    => 'nullable|date',
            'birth_place'   => 'nullable|string|max:255',
            'address'       => 'nullable|string',
            'contact_number'=> 'nullable|string|max:20',
            'email'         => 'nullable|email|max:255',
            'civil_status'  => 'required|in:Single,Married,Widowed,Separated',
            'family_id'     => 'nullable|exists:families,id',
        ]);

        $member->update($validated);
        return redirect()->route('members.show', $member)->with('success', 'Member updated successfully.');
    }

    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted.');
    }
}
