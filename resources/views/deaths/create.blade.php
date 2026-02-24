@extends('layouts.app')
@section('title', 'Add Death Record')
@section('page-title', 'Death Records')

@section('content')
<div class="page-header">
    <div>
        <h1><span class="title-icon"><i class="fa-solid fa-cross"></i></span> Add Death Record</h1>
        <div class="breadcrumb">
            <i class="fa-solid fa-house-chimney"></i> Dashboard &rsaquo;
            <a href="{{ route('deaths.index') }}">Deaths</a> &rsaquo; Add
        </div>
    </div>
    <a href="{{ route('deaths.index') }}" class="btn btn-outline"><i class="fa-solid fa-arrow-left"></i> Back</a>
</div>

<div class="card">
    <div class="card-header">
        <h3><span class="card-icon"><i class="fa-solid fa-cross"></i></span> Death Record Details</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('deaths.store') }}">
            @csrf
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label" for="member_id">Deceased Person *</label>
                    <select id="member_id" name="member_id" class="form-control" required>
                        <option value="">— Select member —</option>
                        @foreach($members as $member)
                            <option value="{{ $member->id }}" {{ old('member_id') == $member->id ? 'selected' : '' }}>
                                {{ $member->last_name }}, {{ $member->first_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('member_id') <span class="form-error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="death_date">Date of Death *</label>
                    <input type="date" id="death_date" name="death_date" class="form-control"
                           value="{{ old('death_date') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="cause_of_death">Cause of Death</label>
                <input type="text" id="cause_of_death" name="cause_of_death" class="form-control"
                       value="{{ old('cause_of_death') }}" placeholder="e.g. Cardiac arrest">
            </div>

            <div class="form-grid-3">
                <div class="form-group">
                    <label class="form-label" for="burial_date">Burial Date</label>
                    <input type="date" id="burial_date" name="burial_date" class="form-control"
                           value="{{ old('burial_date') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="burial_place">Burial Place</label>
                    <input type="text" id="burial_place" name="burial_place" class="form-control"
                           value="{{ old('burial_place') }}" placeholder="Parish Cemetery">
                </div>
                <div class="form-group">
                    <label class="form-label" for="church_book_no">Church Book No.</label>
                    <input type="text" id="church_book_no" name="church_book_no" class="form-control"
                           value="{{ old('church_book_no') }}" placeholder="DB-2024-001">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="notes">Notes / Remarks</label>
                <textarea id="notes" name="notes" class="form-control"
                          placeholder="Additional remarks...">{{ old('notes') }}</textarea>
            </div>

            <div style="display:flex; gap:10px; justify-content:flex-end; padding-top:8px;">
                <a href="{{ route('deaths.index') }}" class="btn btn-outline">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Save Death Record
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
