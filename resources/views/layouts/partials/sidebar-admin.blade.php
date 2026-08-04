<aside class="sidebar">
    <div class="sidebar-logo">
        <img src="{{ asset('assets/img/logo.webp') }}" alt="Lawson Logo" class="logo-img">
        <h1>マチのほっとステーション</h1>
        <p>LAWSON</p>
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="fas fa-folder"></i> Kategori
            </a>
        </li>
        <li>
            <a href="{{ route('admin.problems.index') }}" class="{{ request()->routeIs('admin.problems.*') ? 'active' : '' }}">
                <i class="fas fa-exclamation-circle"></i> Problem
            </a>
        </li>
        <li>
            <a href="{{ route('admin.solutions.index') }}" class="{{ request()->routeIs('admin.solutions.*') ? 'active' : '' }}">
                <i class="fas fa-lightbulb"></i> Solusi
            </a>
        </li>
        <li>
            <a href="{{ route('admin.reports.index') }}" class="{{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                <i class="fas fa-flag"></i> Laporan
            </a>
        </li>
        <li>
            <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Pengguna
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
