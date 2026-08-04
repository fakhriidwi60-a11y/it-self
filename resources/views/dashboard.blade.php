@php $pageTitle = 'Dashboard'; $headerTitle = 'Halo, ' . auth()->user()->name . ' 👋'; @endphp
<x-layout :page-title="$pageTitle" :header-title="$headerTitle">
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fas fa-folder"></i></div>
            <div class="stat-info"><h4>Kategori</h4><h2>{{ $categoryCount }}</h2></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon orange"><i class="fas fa-exclamation-circle"></i></div>
            <div class="stat-info"><h4>Problem</h4><h2>{{ $problemCount }}</h2></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green"><i class="fas fa-lightbulb"></i></div>
            <div class="stat-info"><h4>Solusi</h4><h2>{{ $solutionCount }}</h2></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon red"><i class="fas fa-info-circle"></i></div>
            <div class="stat-info"><h4>Informasi</h4><h2>3</h2></div>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><h3>Pengumuman Terbaru</h3></div>
        <div style="color: var(--gray); font-size: 14px;">
            <p style="margin-bottom: 15px;">
                <i class="fas fa-bell" style="color: var(--primary); margin-right: 10px;"></i>
                <strong>Maintenance Server</strong> - Scheduled maintenance akan dilakukan pada hari Sabtu, 25 Juli 2026 pukul 22:00 - 02:00 WIB.
            </p>
            <p style="margin-bottom: 15px;">
                <i class="fas fa-bell" style="color: var(--success); margin-right: 10px;"></i>
                <strong>Update Software</strong> - Aplikasi Microsoft Office telah diupdate ke versi terbaru di semua komputer.
            </p>
            <p>
                <i class="fas fa-bell" style="color: var(--warning); margin-right: 10px;"></i>
                <strong>Kebijakan Password</strong> - Password harus diubah setiap 90 hari untuk keamanan.
            </p>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><h3>Tips Pencarian</h3></div>
        <div style="color: var(--gray); font-size: 14px;">
            <ul style="padding-left: 20px; line-height: 2;">
                <li>Gunakan kata kunci yang spesifik untuk hasil yang lebih akurat</li>
                <li>Filter berdasarkan kategori untuk mempersempit pencarian</li>
                <li>Cek solusi yang tersedia sebelum membuat laporan baru</li>
                <li>Jika solusi tidak membantu, hubungi IT Support melalui email</li>
            </ul>
        </div>
    </div>
</x-layout>
