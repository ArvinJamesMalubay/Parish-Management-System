@extends('layouts.app')
@section('title', 'Confirmation Records')
@section('page-title', 'Confirmation Records')

@section('content')
<div class="page-header">
    <div>
        <h1><span class="title-icon"><i class="fa-solid fa-dove"></i></span> Confirmation Records</h1>
        <div class="breadcrumb">
            <i class="fa-solid fa-house-chimney"></i> Dashboard &rsaquo; Confirmations
        </div>
    </div>
    <a href="{{ route('confirmations.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Add Confirmation
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h3><span class="card-icon"><i class="fa-solid fa-dove"></i></span> All Confirmation Records</h3>
        <span class="badge badge-green">{{ $confirmations->total() }} records</span>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Confirmand</th>
                    <th>Confirmation Date</th>
                    <th>Officiant</th>
                    <th>Sponsor</th>
                    <th>Book No.</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($confirmations as $confirmation)
                <tr>
                    <td style="color:var(--slate-light); font-size:.78rem;">{{ $confirmation->id }}</td>
                    <td><strong>{{ $confirmation->member?->full_name ?? '—' }}</strong></td>
                    <td>{{ $confirmation->confirmation_date?->format('M d, Y') ?? '—' }}</td>
                    <td>{{ $confirmation->officiant ?? '—' }}</td>
                    <td>{{ $confirmation->sponsor ?? '—' }}</td>
                    <td><span class="badge badge-green">{{ $confirmation->church_book_no ?? '—' }}</span></td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('confirmations.show', $confirmation) }}" class="btn btn-sm btn-outline"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('confirmations.edit', $confirmation) }}" class="btn btn-sm btn-secondary"><i class="fa-solid fa-pen"></i></a>
                            <form method="POST" action="{{ route('confirmations.destroy', $confirmation) }}"
                                  onsubmit="return confirm('Delete this confirmation record?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <div class="empty-icon"><i class="fa-solid fa-dove"></i></div>
                            <h3>No confirmation records found</h3>
                            <p>Add the first confirmation record.</p>
                            <a href="{{ route('confirmations.create') }}" class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i> Add Confirmation
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrap">
        <span>Showing {{ $confirmations->firstItem() }}–{{ $confirmations->lastItem() }} of {{ $confirmations->total() }}</span>
        {{ $confirmations->links() }}
    </div>
</div>
@endsection
