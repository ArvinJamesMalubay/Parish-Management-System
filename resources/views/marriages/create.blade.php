@extends('layouts.app')
@section('title', 'Add Marriage Record')
@section('page-title', 'Marriage Records')

@section('content')
<div class="page-header">
    <div>
        <h1><span class="title-icon"><i class="fa-solid fa-rings-wedding"></i></span> Add Marriage Record</h1>
        <div class="breadcrumb">
            <i class="fa-solid fa-house-chimney"></i> Dashboard &rsaquo;
            <a href="{{ route('marriages.index') }}">Marriages</a> &rsaquo; Add
        </div>
    </div>
    <a href="{{ route('marriages.index') }}" class="btn btn-outline"><i class="fa-solid fa-arrow-left"></i> Back</a>
</div>

<div class="card">
    <div class="card-header">
        <h3><span class="card-icon"><i class="fa-solid fa-rings-wedding"></i></span> Marriage Details</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('marriages.store') }}">
            @csrf
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label" for="groom_member_id">Groom *</label>
                    <select id="groom_member_id" name="groom_member_id" class="form-control" required>
                        <option value="">— Select groom —</option>
                        @foreach($members as $member)
                            <option value="{{ $member->id }}" {{ old('groom_member_id') == $member->id ? 'selected' : '' }}>
                                {{ $member->last_name }}, {{ $member->first_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('groom_member_id') <span class="form-error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="bride_member_id">Bride *</label>
                    <select id="bride_member_id" name="bride_member_id" class="form-control" required>
                        <option value="">— Select bride —</option>
                        @foreach($members as $member)
                            <option value="{{ $member->id }}" {{ old('bride_member_id') == $member->id ? 'selected' : '' }}>
                                {{ $member->last_name }}, {{ $member->first_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('bride_member_id') <span class="form-error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-grid-3">
                <div class="form-group">
                    <label class="form-label" for="marriage_date">Date of Marriage *</label>
                    <input type="date" id="marriage_date" name="marriage_date" class="form-control"
                           value="{{ old('marriage_date') }}" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="officiant">Officiant</label>
                    <input type="text" id="officiant" name="officiant" class="form-control"
                           value="{{ old('officiant') }}" placeholder="Fr. Juan dela Cruz">
                </div>
                <div class="form-group">
                    <label class="form-label" for="church_book_no">Church Book No.</label>
                    <input type="text" id="church_book_no" name="church_book_no" class="form-control"
                           value="{{ old('church_book_no') }}" placeholder="MR-2024-001">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Witnesses</label>
                <div class="form-grid-2">
                    <input type="text" name="witnesses[]" class="form-control" placeholder="Witness 1 name">
                    <input type="text" name="witnesses[]" class="form-control" placeholder="Witness 2 name">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="notes">Notes / Remarks</label>
                <textarea id="notes" name="notes" class="form-control"
                          placeholder="Additional remarks...">{{ old('notes') }}</textarea>
            </div>

            <div style="display:flex; gap:10px; justify-content:flex-end; padding-top:8px;">
                <a href="{{ route('marriages.index') }}" class="btn btn-outline">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Save Marriage Record
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
