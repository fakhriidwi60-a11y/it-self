<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($pageTitle) ? $pageTitle . ' - ' : '' }}IT Self Service Portal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    <button class="menu-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>
    <div class="overlay" onclick="toggleSidebar()"></div>

    @includeWhen(auth()->user()?->isAdmin(), 'layouts.partials.sidebar-admin')
    @includeWhen(auth()->check() && ! auth()->user()->isAdmin(), 'layouts.partials.sidebar-user')

    <div class="main-content">
        <div class="header">
            <h2>{{ $headerTitle ?? ($pageTitle ?? 'Dashboard') }}</h2>
            <div class="header-user">
                <div class="header-user-info">
                    <h4>{{ auth()->user()->name ?? 'User' }}</h4>
                    <p>{{ auth()->user()->isAdmin() ? 'Administrator' : (auth()->user()->email ?? 'user@example.com') }}</p>
                </div>
                <div class="header-user-avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-error">
                <ul style="margin:0; padding-left:20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{ $slot }}
    </div>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
            document.querySelector('.overlay').classList.toggle('active');
        }
    </script>

    @stack('scripts')
</body>
</html>
