@php
    $pageTitle = 'Dashboard Admin';
    $headerTitle = 'Dashboard Admin';
@endphp

<x-layout :page-title="$pageTitle" :header-title="$headerTitle">

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h4>User</h4>
                <h2>{{ $userCount }}</h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fas fa-folder"></i>
            </div>
            <div class="stat-info">
                <h4>Kategori</h4>
                <h2>{{ $categoryCount }}</h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div class="stat-info">
                <h4>Problem</h4>
                <h2>{{ $problemCount }}</h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon red">
                <i class="fas fa-lightbulb"></i>
            </div>
            <div class="stat-info">
                <h4>Solusi</h4>
                <h2>{{ $solutionCount }}</h2>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon purple">
                <i class="fas fa-flag"></i>
            </div>
            <div class="stat-info">
                <h4>Laporan</h4>
                <h2>{{ $reportCount }}</h2>
            </div>
        </div>

        @if ($pendingReportCount > 0)
            <div class="stat-card" style="border: 2px solid var(--danger);">
                <div class="stat-icon red" style="animation: pulse 2s infinite;">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="stat-info">
                    <h4>Laporan Pending</h4>
                    <h2>{{ $pendingReportCount }}</h2>
                </div>
            </div>
        @endif
    </div>

</x-layout>