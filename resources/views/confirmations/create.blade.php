@extends('layouts.app')
@section('title', 'Add Confirmation Record')
@section('page-title', 'Confirmation Records')

@section('content')
<div class="page-header">
    <div>
        <h1><span class="title-icon"><i class="fa-solid fa-dove"></i></span> Add Confirmation Record</h1>
        <div class="breadcrumb">
            <i class="fa-solid fa-house-chimney"></i> Dashboard &rsaquo;
            <a href="{{ route('confirmations.index') }}">Confirmations</a> &rsaquo; Add
        </div>
    </div>
    <a href="{{ route('confirmations.index') }}" class="btn btn-outline"><i class="fa-solid fa-arrow-left"></i> Back</a>
</div>

<div class="card">
    <div class="card-header">
        <h3><span class="card-icon"><i class="fa-solid fa-dove"></i></span> Confirmation Details</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('confirmations.store') }}">
            @csrf
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label" for="member_id">Confirmand *</label>
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
                    <label class="form-label" for="confirmation_date">Date of Confirmation *</label>
                    <input type="date" id="confirmation_date" name="confirmation_date" class="form-control"
                           value="{{ old('confirmation_date') }}" required>
                </div>
            </div>

            <div class="form-grid-3">
                <div class="form-group">
                    <label class="form-label" for="officiant">Officiant (Bishop)</label>
                    <input type="text" id="officiant" name="officiant" class="form-control"
                           value="{{ old('officiant') }}" placeholder="Bishop Juan dela Cruz">
                </div>
                <div class="form-group">
                    <label class="form-label" for="sponsor">Sponsor (Ninong/Ninang)</label>
                    <input type="text" id="sponsor" name="sponsor" class="form-control"
                           value="{{ old('sponsor') }}" placeholder="Sponsor name">
                </div>
                <div class="form-group">
                    <label class="form-label" for="church_book_no">Church Book No.</label>
                    <input type="text" id="church_book_no" name="church_book_no" class="form-control"
                           value="{{ old('church_book_no') }}" placeholder="CN-2024-001">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="notes">Notes / Remarks</label>
                <textarea id="notes" name="notes" class="form-control"
                          placeholder="Additional remarks...">{{ old('notes') }}</textarea>
            </div>

            <div style="display:flex; gap:10px; justify-content:flex-end; padding-top:8px;">
                <a href="{{ route('confirmations.index') }}" class="btn btn-outline">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Save Confirmation Record
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
