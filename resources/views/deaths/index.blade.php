@extends('layouts.app')
@section('title', 'Death Records')
@section('page-title', 'Death Records')

@section('content')
<div class="page-header">
    <div>
        <h1><span class="title-icon"><i class="fa-solid fa-cross"></i></span> Death Records</h1>
        <div class="breadcrumb">
            <i class="fa-solid fa-house-chimney"></i> Dashboard &rsaquo; Deaths
        </div>
    </div>
    <a href="{{ route('deaths.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Add Death Record
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h3><span class="card-icon"><i class="fa-solid fa-cross"></i></span> All Death Records</h3>
        <span class="badge badge-red">{{ $deaths->total() }} records</span>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Deceased</th>
                    <th>Date of Death</th>
                    <th>Cause</th>
                    <th>Burial Date</th>
                    <th>Burial Place</th>
                    <th>Book No.</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($deaths as $death)
                <tr>
                    <td style="color:var(--slate-light); font-size:.78rem;">{{ $death->id }}</td>
                    <td><strong>{{ $death->member?->full_name ?? '—' }}</strong></td>
                    <td>{{ $death->death_date?->format('M d, Y') ?? '—' }}</td>
                    <td>{{ $death->cause_of_death ?? '—' }}</td>
                    <td>{{ $death->burial_date?->format('M d, Y') ?? '—' }}</td>
                    <td>{{ $death->burial_place ?? '—' }}</td>
                    <td><span class="badge badge-navy">{{ $death->church_book_no ?? '—' }}</span></td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('deaths.show', $death) }}" class="btn btn-sm btn-outline"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('deaths.edit', $death) }}" class="btn btn-sm btn-secondary"><i class="fa-solid fa-pen"></i></a>
                            <form method="POST" action="{{ route('deaths.destroy', $death) }}"
                                  onsubmit="return confirm('Delete this death record?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
                        <div class="empty-state">
                            <div class="empty-icon"><i class="fa-solid fa-cross"></i></div>
                            <h3>No death records found</h3>
                            <p>Add the first death record to the system.</p>
                            <a href="{{ route('deaths.create') }}" class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i> Add Death Record
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrap">
        <span>Showing {{ $deaths->firstItem() }}–{{ $deaths->lastItem() }} of {{ $deaths->total() }}</span>
        {{ $deaths->links() }}
    </div>
</div>
@endsection
