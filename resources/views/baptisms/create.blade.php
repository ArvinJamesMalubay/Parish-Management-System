@extends('layouts.app')
@section('title', 'Add Baptism Record')
@section('page-title', 'Baptism Records')

@section('content')
<div class="page-header">
    <div>
        <h1><span class="title-icon"><i class="fa-solid fa-droplet"></i></span> Add Baptism Record</h1>
        <div class="breadcrumb">
            <i class="fa-solid fa-house-chimney"></i> Dashboard &rsaquo;
            <a href="{{ route('baptisms.index') }}">Baptisms</a> &rsaquo; Add
        </div>
    </div>
    <a href="{{ route('baptisms.index') }}" class="btn btn-outline"><i class="fa-solid fa-arrow-left"></i> Back</a>
</div>

<div class="card">
    <div class="card-header">
        <h3><span class="card-icon"><i class="fa-solid fa-droplet"></i></span> Baptism Details</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('baptisms.store') }}">
            @csrf
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label" for="member_id">Baptized Person *</label>
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
                    <label class="form-label" for="baptism_date">Date of Baptism *</label>
                    <input type="date" id="baptism_date" name="baptism_date" class="form-control"
                           value="{{ old('baptism_date') }}" required>
                    @error('baptism_date') <span class="form-error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-grid-3">
                <div class="form-group">
                    <label class="form-label" for="officiant">Officiant (Priest)</label>
                    <input type="text" id="officiant" name="officiant" class="form-control"
                           value="{{ old('officiant') }}" placeholder="Fr. Juan dela Cruz">
                </div>
                <div class="form-group">
                    <label class="form-label" for="church_book_no">Church Book No.</label>
                    <input type="text" id="church_book_no" name="church_book_no" class="form-control"
                           value="{{ old('church_book_no') }}" placeholder="BK-2024-001">
                </div>
                <div class="form-group">
                    <label class="form-label" for="page_no">Page No.</label>
                    <input type="text" id="page_no" name="page_no" class="form-control"
                           value="{{ old('page_no') }}" placeholder="42">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Godparents</label>
                <div id="godparents-container">
                    <div class="form-grid-2" style="margin-bottom:8px;">
                        <input type="text" name="godparents[]" class="form-control" placeholder="Godparent name">
                        <input type="text" name="godparents[]" class="form-control" placeholder="Godparent name">
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-outline" onclick="addGodparent()">
                    <i class="fa-solid fa-plus"></i> Add Godparent
                </button>
            </div>

            <div class="form-group">
                <label class="form-label" for="notes">Notes / Remarks</label>
                <textarea id="notes" name="notes" class="form-control"
                          placeholder="Additional remarks...">{{ old('notes') }}</textarea>
            </div>

            <div style="display:flex; gap:10px; justify-content:flex-end; padding-top:8px;">
                <a href="{{ route('baptisms.index') }}" class="btn btn-outline">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Save Baptism Record
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function addGodparent() {
    const container = document.getElementById('godparents-container');
    const div = document.createElement('div');
    div.className = 'form-grid-2';
    div.style.marginBottom = '8px';
    div.innerHTML = `
        <input type="text" name="godparents[]" class="form-control" placeholder="Godparent name">
        <input type="text" name="godparents[]" class="form-control" placeholder="Godparent name">`;
    container.appendChild(div);
}
</script>
@endpush
@endsection
