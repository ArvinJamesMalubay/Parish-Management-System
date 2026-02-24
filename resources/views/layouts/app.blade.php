<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — Parish RMS</title>
    <link rel="stylesheet" href="{{ asset('css/parish.css') }}">
    {{-- Font Awesome Free for icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @stack('styles')
</head>
<body>

<div class="app-shell">

    {{-- ══ SIDEBAR ══════════════════════════════════════════ --}}
    <aside class="sidebar" id="sidebar">

        <div class="sidebar-brand">
            <span class="brand-cross">✛</span>
            <span class="brand-name">Parish Record<br>Management System</span>
            <span class="brand-parish">Diocese of {{ config('app.parish_name', 'Your Parish') }}</span>
        </div>

        <nav class="sidebar-nav">
            <span class="nav-section-label">Overview</span>
            <a href="{{ route('dashboard') }}"
               class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-house-chimney"></i></span>
                Dashboard
            </a>

            <span class="nav-section-label">Sacraments</span>
            <a href="{{ route('baptisms.index') }}"
               class="nav-item {{ request()->routeIs('baptisms.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-droplet"></i></span>
                Baptisms
            </a>
            <a href="{{ route('confirmations.index') }}"
               class="nav-item {{ request()->routeIs('confirmations.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-dove"></i></span>
                Confirmations
            </a>
            <a href="{{ route('marriages.index') }}"
               class="nav-item {{ request()->routeIs('marriages.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-rings-wedding"></i></span>
                Marriages
            </a>
            <a href="{{ route('deaths.index') }}"
               class="nav-item {{ request()->routeIs('deaths.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-cross"></i></span>
                Death Records
            </a>

            <span class="nav-section-label">People</span>
            <a href="{{ route('members.index') }}"
               class="nav-item {{ request()->routeIs('members.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-users"></i></span>
                Parishioners
            </a>
            <a href="{{ route('families.index') }}"
               class="nav-item {{ request()->routeIs('families.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-house-user"></i></span>
                Families
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>
                <div>
                    <div class="user-name">{{ Auth::user()->name ?? 'Admin' }}</div>
                    <div style="font-size:.7rem;">Administrator</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    {{-- ══ MAIN CONTENT ══════════════════════════════════════ --}}
    <div class="main-content">

        {{-- Top Header --}}
        <header class="top-header">
            <div style="display:flex; align-items:center; gap:14px;">
                <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle menu">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <span class="page-title">@yield('page-title', 'Dashboard')</span>
            </div>
            <div class="header-right">
                <span class="header-date">
                    <i class="fa-regular fa-calendar"></i>
                    {{ now()->format('F j, Y') }}
                </span>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="page-content">

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check"></i>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</div>

{{-- Sidebar overlay for mobile --}}
<div id="sidebarOverlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,.5); z-index:999;"
     onclick="closeSidebar()"></div>

<script>
const sidebar  = document.getElementById('sidebar');
const overlay  = document.getElementById('sidebarOverlay');
const toggle   = document.getElementById('sidebarToggle');

function openSidebar() {
    sidebar.classList.add('open');
    overlay.style.display = 'block';
}
function closeSidebar() {
    sidebar.classList.remove('open');
    overlay.style.display = 'none';
}

if (toggle) toggle.addEventListener('click', () => {
    sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
});

// Auto-dismiss flash messages
setTimeout(() => {
    document.querySelectorAll('.alert').forEach(el => {
        el.style.transition = 'opacity .5s ease';
        el.style.opacity = '0';
        setTimeout(() => el.remove(), 500);
    });
}, 5000);
</script>

@stack('scripts')
</body>
</html>
