<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register — Parish RMS</title>
    <link rel="stylesheet" href="{{ asset('css/parish.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<div class="auth-page">
    <div class="auth-card">

        <div class="auth-logo">
            <span class="cross-symbol">✛</span>
            <h1>Parish Record<br>Management System</h1>
            <span class="parish-sub">Create an administrator account</span>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="fa-solid fa-circle-exclamation"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <div class="auth-form">
            <h2>Create Account</h2>
            <p class="auth-sub">Register to manage parish records</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="name">Full Name</label>
                    <input type="text" id="name" name="name" class="form-control"
                           value="{{ old('name') }}" placeholder="Fr. Juan dela Cruz" required autofocus>
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control"
                           value="{{ old('email') }}" placeholder="admin@parish.org" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control"
                           placeholder="Min. 8 characters" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="form-control" placeholder="Repeat password" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; margin-top:8px;">
                    <i class="fa-solid fa-user-plus"></i>
                    Create Account
                </button>
            </form>
        </div>

        <div class="auth-footer-link">
            Already have an account?
            <a href="{{ route('login') }}">Sign in here</a>
        </div>

    </div>
</div>

</body>
</html>
