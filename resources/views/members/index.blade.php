@extends('layouts.app')
@section('title', 'Parishioners')
@section('page-title', 'Parishioners')

@section('content')
<div class="page-header">
    <div>
        <h1><span class="title-icon"><i class="fa-solid fa-users"></i></span> Parishioners</h1>
        <div class="breadcrumb">
            <i class="fa-solid fa-house-chimney"></i> Dashboard &rsaquo; Parishioners
        </div>
    </div>
    <a href="{{ route('members.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-user-plus"></i> Add Parishioner
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h3><span class="card-icon"><i class="fa-solid fa-users"></i></span> All Parishioners</h3>
        <span class="badge badge-navy">{{ $members->total() }} records</span>
    </div>

    <div style="padding:16px 24px 0; border-bottom:1px solid var(--ivory-dark);">
        <div class="search-bar">
            <div class="search-input-wrap">
                <span class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" class="form-control" placeholder="Search parishioners..." id="searchInput">
            </div>
        </div>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Civil Status</th>
                    <th>Birth Date</th>
                    <th>Family</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $member)
                <tr>
                    <td style="color:var(--slate-light); font-size:.78rem;">{{ $member->id }}</td>
                    <td>
                        <strong>{{ $member->last_name }}, {{ $member->first_name }}</strong>
                        @if($member->middle_name)
                            <span style="font-size:.8rem; color:var(--slate-light);"> {{ $member->middle_name }}</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $member->gender === 'Male' ? 'badge-blue' : 'badge-gold' }}">
                            {{ $member->gender }}
                        </span>
                    </td>
                    <td>{{ $member->civil_status }}</td>
                    <td>{{ $member->birth_date?->format('M d, Y') ?? '—' }}</td>
                    <td>{{ $member->family?->family_name ?? '—' }}</td>
                    <td style="font-size:.82rem;">{{ $member->contact_number ?? '—' }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('members.show', $member) }}" class="btn btn-sm btn-outline" title="View">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('members.edit', $member) }}" class="btn btn-sm btn-secondary" title="Edit">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form method="POST" action="{{ route('members.destroy', $member) }}"
                                  onsubmit="return confirm('Delete this parishioner?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
                        <div class="empty-state">
                            <div class="empty-icon"><i class="fa-solid fa-users"></i></div>
                            <h3>No parishioners found</h3>
                            <p>Start by adding a parishioner to the system.</p>
                            <a href="{{ route('members.create') }}" class="btn btn-primary">
                                <i class="fa-solid fa-user-plus"></i> Add Parishioner
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrap">
        <span>Showing {{ $members->firstItem() }}–{{ $members->lastItem() }} of {{ $members->total() }}</span>
        {{ $members->links() }}
    </div>
</div>
@endsection
