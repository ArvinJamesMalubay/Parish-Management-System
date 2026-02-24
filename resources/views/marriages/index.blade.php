@extends('layouts.app')
@section('title', 'Marriage Records')
@section('page-title', 'Marriage Records')

@section('content')
<div class="page-header">
    <div>
        <h1><span class="title-icon"><i class="fa-solid fa-rings-wedding"></i></span> Marriage Records</h1>
        <div class="breadcrumb">
            <i class="fa-solid fa-house-chimney"></i> Dashboard &rsaquo; Marriages
        </div>
    </div>
    <a href="{{ route('marriages.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Add Marriage
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h3><span class="card-icon"><i class="fa-solid fa-rings-wedding"></i></span> All Marriage Records</h3>
        <span class="badge badge-gold">{{ $marriages->total() }} records</span>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Groom</th>
                    <th>Bride</th>
                    <th>Marriage Date</th>
                    <th>Officiant</th>
                    <th>Book No.</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($marriages as $marriage)
                <tr>
                    <td style="color:var(--slate-light); font-size:.78rem;">{{ $marriage->id }}</td>
                    <td><strong>{{ $marriage->groom?->full_name ?? '—' }}</strong></td>
                    <td><strong>{{ $marriage->bride?->full_name ?? '—' }}</strong></td>
                    <td>{{ $marriage->marriage_date?->format('M d, Y') ?? '—' }}</td>
                    <td>{{ $marriage->officiant ?? '—' }}</td>
                    <td><span class="badge badge-gold">{{ $marriage->church_book_no ?? '—' }}</span></td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('marriages.show', $marriage) }}" class="btn btn-sm btn-outline"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('marriages.edit', $marriage) }}" class="btn btn-sm btn-secondary"><i class="fa-solid fa-pen"></i></a>
                            <form method="POST" action="{{ route('marriages.destroy', $marriage) }}"
                                  onsubmit="return confirm('Delete this marriage record?');">
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
                            <div class="empty-icon"><i class="fa-solid fa-rings-wedding"></i></div>
                            <h3>No marriage records found</h3>
                            <p>Add the first marriage record to the system.</p>
                            <a href="{{ route('marriages.create') }}" class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i> Add Marriage
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrap">
        <span>Showing {{ $marriages->firstItem() }}–{{ $marriages->lastItem() }} of {{ $marriages->total() }}</span>
        {{ $marriages->links() }}
    </div>
</div>
@endsection
