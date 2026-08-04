<aside class="sidebar">
    <div class="sidebar-logo">
        <img src="{{ asset('assets/img/logo.webp') }}" alt="Lawson Logo" class="logo-img">
        <h1>マチのほっとステーション</h1>
        <p>LAWSON</p>
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('problems.index') }}" class="{{ request()->routeIs('problems.*') ? 'active' : '' }}">
                <i class="fas fa-exclamation-circle"></i> Management Problem
            </a>
        </li>
        <li>
            <a href="{{ route('reports.index') }}" class="{{ request()->routeIs('reports.index') ? 'active' : '' }}">
                <i class="fas fa-flag"></i> Riwayat Laporan
            </a>
        </li>
        <li>
            <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}">
                <i class="fas fa-user"></i> Profile
            </a>
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </form>
        </li>
    </ul>
</aside>
