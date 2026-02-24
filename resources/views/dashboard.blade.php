@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="page-header">
    <div>
        <h1><span class="title-icon">✛</span> Parish Overview</h1>
        <div class="breadcrumb">
            <i class="fa-solid fa-house-chimney"></i> Home &rsaquo; Dashboard
        </div>
    </div>
    <div style="display:flex; gap:10px;">
        <a href="{{ route('members.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-user-plus"></i> Add Parishioner
        </a>
    </div>
</div>

{{-- Stat Cards --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-users" style="color:var(--gold-light);"></i></div>
        <div class="stat-value">{{ $stats['members'] }}</div>
        <div class="stat-label">Parishioners</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-house-user" style="color:var(--gold-light);"></i></div>
        <div class="stat-value">{{ $stats['families'] }}</div>
        <div class="stat-label">Families</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-droplet" style="color:#7ec8e3;"></i></div>
        <div class="stat-value">{{ $stats['baptisms'] }}</div>
        <div class="stat-label">Baptisms</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-dove" style="color:#b2e0d4;"></i></div>
        <div class="stat-value">{{ $stats['confirmations'] }}</div>
        <div class="stat-label">Confirmations</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-rings-wedding" style="color:var(--gold-light);"></i></div>
        <div class="stat-value">{{ $stats['marriages'] }}</div>
        <div class="stat-label">Marriages</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-cross" style="color:#d4a0a0;"></i></div>
        <div class="stat-value">{{ $stats['deaths'] }}</div>
        <div class="stat-label">Death Records</div>
    </div>
</div>

{{-- Quick Links --}}
<div class="card" style="margin-bottom:24px;">
    <div class="card-header">
        <h3><span class="card-icon"><i class="fa-solid fa-bolt"></i></span> Quick Actions</h3>
    </div>
    <div class="card-body" style="display:flex; flex-wrap:wrap; gap:12px;">
        <a href="{{ route('baptisms.create') }}" class="btn btn-outline">
            <i class="fa-solid fa-droplet"></i> New Baptism
        </a>
        <a href="{{ route('confirmations.create') }}" class="btn btn-outline">
            <i class="fa-solid fa-dove"></i> New Confirmation
        </a>
        <a href="{{ route('marriages.create') }}" class="btn btn-outline">
            <i class="fa-solid fa-rings-wedding"></i> New Marriage
        </a>
        <a href="{{ route('deaths.create') }}" class="btn btn-outline">
            <i class="fa-solid fa-cross"></i> New Death Record
        </a>
        <a href="{{ route('families.create') }}" class="btn btn-outline">
            <i class="fa-solid fa-house-user"></i> New Family
        </a>
    </div>
</div>

{{-- Recent Activity Grid --}}
<div class="recent-grid">

    {{-- Recent Baptisms --}}
    <div class="card">
        <div class="card-header">
            <h3><span class="card-icon"><i class="fa-solid fa-droplet"></i></span> Recent Baptisms</h3>
            <a href="{{ route('baptisms.index') }}" class="btn btn-sm btn-outline">View All</a>
        </div>
        <div class="card-body" style="padding:0 24px;">
            @forelse($recentBaptisms as $baptism)
            <div class="recent-item">
                <div class="ri-icon"><i class="fa-solid fa-droplet" style="color:#7ec8e3;"></i></div>
                <div>
                    <div class="ri-name">{{ $baptism->member->full_name ?? '—' }}</div>
                    <div class="ri-sub">{{ $baptism->baptism_date?->format('M d, Y') }}</div>
                </div>
            </div>
            @empty
            <div class="empty-state" style="padding:30px 0;">
                <div class="empty-icon"><i class="fa-solid fa-droplet"></i></div>
                <p>No baptism records yet</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Recent Marriages --}}
    <div class="card">
        <div class="card-header">
            <h3><span class="card-icon"><i class="fa-solid fa-rings-wedding"></i></span> Recent Marriages</h3>
            <a href="{{ route('marriages.index') }}" class="btn btn-sm btn-outline">View All</a>
        </div>
        <div class="card-body" style="padding:0 24px;">
            @forelse($recentMarriages as $marriage)
            <div class="recent-item">
                <div class="ri-icon"><i class="fa-solid fa-rings-wedding" style="color:var(--gold-light);"></i></div>
                <div>
                    <div class="ri-name">{{ $marriage->groom->last_name ?? '?' }} & {{ $marriage->bride->last_name ?? '?' }}</div>
                    <div class="ri-sub">{{ $marriage->marriage_date?->format('M d, Y') }}</div>
                </div>
            </div>
            @empty
            <div class="empty-state" style="padding:30px 0;">
                <div class="empty-icon"><i class="fa-solid fa-rings-wedding"></i></div>
                <p>No marriage records yet</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Recent Confirmations --}}
    <div class="card">
        <div class="card-header">
            <h3><span class="card-icon"><i class="fa-solid fa-dove"></i></span> Recent Confirmations</h3>
            <a href="{{ route('confirmations.index') }}" class="btn btn-sm btn-outline">View All</a>
        </div>
        <div class="card-body" style="padding:0 24px;">
            @forelse($recentConfirmations as $conf)
            <div class="recent-item">
                <div class="ri-icon"><i class="fa-solid fa-dove" style="color:#b2e0d4;"></i></div>
                <div>
                    <div class="ri-name">{{ $conf->member->full_name ?? '—' }}</div>
                    <div class="ri-sub">{{ $conf->confirmation_date?->format('M d, Y') }}</div>
                </div>
            </div>
            @empty
            <div class="empty-state" style="padding:30px 0;">
                <div class="empty-icon"><i class="fa-solid fa-dove"></i></div>
                <p>No confirmation records yet</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- System Info --}}
    <div class="card">
        <div class="card-header">
            <h3><span class="card-icon"><i class="fa-solid fa-circle-info"></i></span> System Info</h3>
        </div>
        <div class="card-body">
            <table style="width:100%; font-size:.85rem; border-collapse:collapse;">
                <tr style="border-bottom:1px solid var(--ivory-dark);">
                    <td style="padding:9px 0; color:var(--slate-light); font-weight:700; font-size:.75rem; text-transform:uppercase; letter-spacing:.08em;">System</td>
                    <td style="padding:9px 0; color:var(--navy); font-weight:700;">Parish RMS v1.0</td>
                </tr>
                <tr style="border-bottom:1px solid var(--ivory-dark);">
                    <td style="padding:9px 0; color:var(--slate-light); font-weight:700; font-size:.75rem; text-transform:uppercase; letter-spacing:.08em;">Framework</td>
                    <td style="padding:9px 0; color:var(--navy);">Laravel 11</td>
                </tr>
                <tr style="border-bottom:1px solid var(--ivory-dark);">
                    <td style="padding:9px 0; color:var(--slate-light); font-weight:700; font-size:.75rem; text-transform:uppercase; letter-spacing:.08em;">Database</td>
                    <td style="padding:9px 0; color:var(--navy);">MySQL</td>
                </tr>
                <tr>
                    <td style="padding:9px 0; color:var(--slate-light); font-weight:700; font-size:.75rem; text-transform:uppercase; letter-spacing:.08em;">Date</td>
                    <td style="padding:9px 0; color:var(--navy);">{{ now()->format('M d, Y') }}</td>
                </tr>
            </table>
        </div>
    </div>

</div>
@endsection
