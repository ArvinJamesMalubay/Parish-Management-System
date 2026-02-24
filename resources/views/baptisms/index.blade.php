@extends('layouts.app')
@section('title', 'Baptism Records')
@section('page-title', 'Baptism Records')

@section('content')
<div class="page-header">
    <div>
        <h1><span class="title-icon"><i class="fa-solid fa-droplet"></i></span> Baptism Records</h1>
        <div class="breadcrumb">
            <i class="fa-solid fa-house-chimney"></i> Dashboard &rsaquo; Baptisms
        </div>
    </div>
    <a href="{{ route('baptisms.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i> Add Baptism
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h3><span class="card-icon"><i class="fa-solid fa-droplet"></i></span> All Baptism Records</h3>
        <span class="badge badge-blue">{{ $baptisms->total() }} records</span>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Baptized Name</th>
                    <th>Date of Baptism</th>
                    <th>Officiant</th>
                    <th>Book No.</th>
                    <th>Page</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($baptisms as $baptism)
                <tr>
                    <td style="color:var(--slate-light); font-size:.78rem;">{{ $baptism->id }}</td>
                    <td><strong>{{ $baptism->member?->full_name ?? '—' }}</strong></td>
                    <td>{{ $baptism->baptism_date?->format('M d, Y') ?? '—' }}</td>
                    <td>{{ $baptism->officiant ?? '—' }}</td>
                    <td><span class="badge badge-navy">{{ $baptism->church_book_no ?? '—' }}</span></td>
                    <td>{{ $baptism->page_no ?? '—' }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('baptisms.show', $baptism) }}" class="btn btn-sm btn-outline"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('baptisms.edit', $baptism) }}" class="btn btn-sm btn-secondary"><i class="fa-solid fa-pen"></i></a>
                            <form method="POST" action="{{ route('baptisms.destroy', $baptism) }}"
                                  onsubmit="return confirm('Delete this baptism record?');">
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
                            <div class="empty-icon"><i class="fa-solid fa-droplet"></i></div>
                            <h3>No baptism records found</h3>
                            <p>Add the first baptism record to the system.</p>
                            <a href="{{ route('baptisms.create') }}" class="btn btn-primary">
                                <i class="fa-solid fa-plus"></i> Add Baptism
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrap">
        <span>Showing {{ $baptisms->firstItem() }}–{{ $baptisms->lastItem() }} of {{ $baptisms->total() }}</span>
        {{ $baptisms->links() }}
    </div>
</div>
@endsection
