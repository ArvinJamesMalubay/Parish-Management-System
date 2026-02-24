@extends('layouts.app')
@section('title', 'Add Family')
@section('page-title', 'Family Records')

@section('content')
<div class="page-header">
    <div>
        <h1><span class="title-icon"><i class="fa-solid fa-house-user"></i></span> Add Family</h1>
        <div class="breadcrumb">
            <i class="fa-solid fa-house-chimney"></i> Dashboard &rsaquo;
            <a href="{{ route('families.index') }}">Families</a> &rsaquo; Add
        </div>
    </div>
    <a href="{{ route('families.index') }}" class="btn btn-outline"><i class="fa-solid fa-arrow-left"></i> Back</a>
</div>

<div class="card">
    <div class="card-header">
        <h3><span class="card-icon"><i class="fa-solid fa-house-user"></i></span> Family Details</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('families.store') }}">
            @csrf
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label" for="family_name">Family Name *</label>
                    <input type="text" id="family_name" name="family_name" class="form-control"
                           value="{{ old('family_name') }}" placeholder="dela Cruz Family" required>
                    @error('family_name') <span class="form-error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="head_member_id">Head of Family</label>
                    <select id="head_member_id" name="head_member_id" class="form-control">
                        <option value="">— None —</option>
                        @foreach($members as $member)
                            <option value="{{ $member->id }}" {{ old('head_member_id') == $member->id ? 'selected' : '' }}>
                                {{ $member->last_name }}, {{ $member->first_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="address">Family Address</label>
                <textarea id="address" name="address" class="form-control"
                          placeholder="Street, Barangay, City, Province">{{ old('address') }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="notes">Notes</label>
                <textarea id="notes" name="notes" class="form-control"
                          placeholder="Additional notes...">{{ old('notes') }}</textarea>
            </div>

            <div style="display:flex; gap:10px; justify-content:flex-end; padding-top:8px;">
                <a href="{{ route('families.index') }}" class="btn btn-outline">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Save Family
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
