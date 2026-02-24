@extends('layouts.app')
@section('title', 'Add Parishioner')
@section('page-title', 'Add Parishioner')

@section('content')
<div class="page-header">
    <div>
        <h1><span class="title-icon"><i class="fa-solid fa-user-plus"></i></span> Add Parishioner</h1>
        <div class="breadcrumb">
            <i class="fa-solid fa-house-chimney"></i> Dashboard &rsaquo;
            <a href="{{ route('members.index') }}">Parishioners</a> &rsaquo; Add
        </div>
    </div>
    <a href="{{ route('members.index') }}" class="btn btn-outline">
        <i class="fa-solid fa-arrow-left"></i> Back
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h3><span class="card-icon"><i class="fa-solid fa-user"></i></span> Personal Information</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('members.store') }}">
            @csrf

            <div class="form-grid-3">
                <div class="form-group">
                    <label class="form-label" for="last_name">Last Name *</label>
                    <input type="text" id="last_name" name="last_name" class="form-control"
                           value="{{ old('last_name') }}" placeholder="dela Cruz" required>
                    @error('last_name') <span class="form-error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="first_name">First Name *</label>
                    <input type="text" id="first_name" name="first_name" class="form-control"
                           value="{{ old('first_name') }}" placeholder="Juan" required>
                    @error('first_name') <span class="form-error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="middle_name">Middle Name</label>
                    <input type="text" id="middle_name" name="middle_name" class="form-control"
                           value="{{ old('middle_name') }}" placeholder="Santos">
                </div>
            </div>

            <div class="form-grid-3">
                <div class="form-group">
                    <label class="form-label" for="gender">Gender *</label>
                    <select id="gender" name="gender" class="form-control" required>
                        <option value="">Select gender</option>
                        <option value="Male"   {{ old('gender') === 'Male'   ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender') <span class="form-error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="civil_status">Civil Status *</label>
                    <select id="civil_status" name="civil_status" class="form-control" required>
                        <option value="Single"    {{ old('civil_status', 'Single') === 'Single'    ? 'selected' : '' }}>Single</option>
                        <option value="Married"   {{ old('civil_status') === 'Married'   ? 'selected' : '' }}>Married</option>
                        <option value="Widowed"   {{ old('civil_status') === 'Widowed'   ? 'selected' : '' }}>Widowed</option>
                        <option value="Separated" {{ old('civil_status') === 'Separated' ? 'selected' : '' }}>Separated</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="family_id">Family</label>
                    <select id="family_id" name="family_id" class="form-control">
                        <option value="">— None —</option>
                        @foreach($families as $family)
                            <option value="{{ $family->id }}" {{ old('family_id') == $family->id ? 'selected' : '' }}>
                                {{ $family->family_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label" for="birth_date">Date of Birth</label>
                    <input type="date" id="birth_date" name="birth_date" class="form-control"
                           value="{{ old('birth_date') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="birth_place">Place of Birth</label>
                    <input type="text" id="birth_place" name="birth_place" class="form-control"
                           value="{{ old('birth_place') }}" placeholder="Quezon City">
                </div>
            </div>

            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label" for="contact_number">Contact Number</label>
                    <input type="text" id="contact_number" name="contact_number" class="form-control"
                           value="{{ old('contact_number') }}" placeholder="09XX-XXX-XXXX">
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control"
                           value="{{ old('email') }}" placeholder="juan@email.com">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="address">Home Address</label>
                <textarea id="address" name="address" class="form-control"
                          placeholder="Street, Barangay, City, Province">{{ old('address') }}</textarea>
            </div>

            <div style="display:flex; gap:10px; justify-content:flex-end; padding-top:8px;">
                <a href="{{ route('members.index') }}" class="btn btn-outline">Cancel</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Save Parishioner
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
