<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign In — Parish RMS</title>
    <link rel="stylesheet" href="{{ asset('css/parish.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<div class="auth-page">
    <div class="auth-card">

        <div class="auth-logo">
            <span class="cross-symbol">✛</span>
            <h1>Parish Record<br>Management System</h1>
            <span class="parish-sub">Archdiocese of Your Parish</span>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fa-solid fa-circle-exclamation"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <div class="auth-form">
            <h2>Welcome back</h2>
            <p class="auth-sub">Sign in to access the parish records</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control"
                           value="{{ old('email') }}" placeholder="admin@parish.org" required autofocus>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control"
                           placeholder="••••••••" required>
                </div>

                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; font-size:.82rem;">
                    <label style="display:flex; align-items:center; gap:7px; cursor:pointer; color:var(--slate);">
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Sign In to Parish RMS
                </button>
            </form>
        </div>

        <div class="auth-footer-link">
            Don't have an account?
            <a href="{{ route('register') }}">Register here</a>
        </div>

    </div>
</div>

</body>
</html>
