<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Admin sign in · Tarteel Academy</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="admin-body login-page">
    <main class="login-card">
        <header>
            <img src="{{ asset('images/tarteel-academy-logo-160.png') }}" width="160" height="160" alt="Tarteel Academy">
            <h1>Admin sign in</h1>
            <p>Enrollment requests for Tarteel Academy.</p>
        </header>

        @if ($errors->any())
            <p class="admin-alert admin-error" role="alert">{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="{{ route('admin.login.store') }}" style="display:grid;gap:1rem">
            @csrf

            <div class="admin-field">
                <label for="email">Email address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="username" autofocus
                       @error('email') aria-invalid="true" @enderror>
            </div>

            <div class="admin-field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required autocomplete="current-password">
            </div>

            <label class="login-remember" for="remember">
                <input type="checkbox" name="remember" id="remember" value="1" @checked(old('remember'))>
                Keep me signed in
            </label>

            <button type="submit" class="admin-button">Sign in</button>
        </form>

        <p class="login-footer"><a href="{{ route('home') }}">← Back to the website</a></p>
    </main>
</body>
</html>
