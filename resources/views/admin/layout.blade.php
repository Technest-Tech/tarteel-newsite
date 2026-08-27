<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin') · Tarteel Academy</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="admin-body">
    <header class="admin-topbar">
        <div class="admin-topbar-inner">
            <a href="{{ route('admin.enrollments.index') }}" class="admin-brand">
                <img src="{{ asset('images/tarteel-academy-logo-160.png') }}" width="160" height="160" alt="">
                <span>
                    <strong>Tarteel Academy</strong>
                    <small>Enrollment control panel</small>
                </span>
            </a>

            <div class="admin-topbar-actions">
                <span class="admin-user">{{ auth()->user()->name }}</span>
                <a href="{{ route('home') }}" target="_blank" rel="noopener">View site ↗</a>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit">Log out</button>
                </form>
            </div>
        </div>
    </header>

    <main class="admin-shell">
        @yield('content')
    </main>
</body>
</html>
