@extends('layouts.app')
@section('title', 'Family Records')
@section('page-title', 'Family Records')

@section('content')
<div class="page-header">
    <div>
        <h1><span class="title-icon"><i class="fa-solid fa-house-user"></i></span> Family Records</h1>
        <div class="breadcrumb">
            <i class="fa-solid fa-house-chimney"></i> Dashboard &rsaquo; Families
        </div>
    </div>
    <a href="{{ route('families.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Add Family
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h3><span class="card-icon"><i class="fa-solid fa-house-user"></i></span> All Families</h3>
        <span class="badge badge-navy">{{ $families->total() }} records</span>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Family Name</th>
                    <th>Head of Family</th>
                    <th>Address</th>
                    <th>Members</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($families as $family)
                <tr>
                    <td style="color:var(--slate-light); font-size:.78rem;">{{ $family->id }}</td>
                    <td><strong>{{ $family->family_name }}</strong></td>
                    <td>{{ $family->head?->full_name ?? '—' }}</td>
                    <td style="max-width:200px; font-size:.82rem; color:var(--slate);">{{ Str::limit($family->address, 50) ?? '—' }}</td>
                    <td>
                        <span class="badge badge-navy">{{ $family->members_count }} member(s)</span>
                    </td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('families.show', $family) }}" class="btn btn-sm btn-outline"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('families.edit', $family) }}" class="btn btn-sm btn-secondary"><i class="fa-solid fa-pen"></i></a>
                            <form method="POST" action="{{ route('families.destroy', $family) }}"
                                  onsubmit="return confirm('Delete this family record?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <div class="empty-icon"><i class="fa-solid fa-house-user"></i></div>
                            <h3>No family records found</h3>
                            <p>Add the first family record.</p>
                            <a href="{{ route('families.create') }}" class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i> Add Family
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrap">
        <span>Showing {{ $families->firstItem() }}–{{ $families->lastItem() }} of {{ $families->total() }}</span>
        {{ $families->links() }}
    </div>
</div>
@endsection
