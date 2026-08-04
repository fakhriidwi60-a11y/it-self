@php $pageTitle = 'Manajemen Laporan'; @endphp
<x-layout :page-title="$pageTitle">
    <style>
        .report-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border: 1px solid var(--border);
            transition: all 0.3s ease;
        }
        .report-card:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.12);
            transform: translateY(-2px);
        }
        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
            flex-wrap: wrap;
            gap: 12px;
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .user-avatar {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
        }
        .report-content {
            background: #f8fafc;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 16px;
        }
        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .status-pending {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #dc2626;
            border: 1px solid #fca5a5;
        }
        .status-in-progress {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #d97706;
            border: 1px solid #fcd34d;
        }
        .status-complete {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            color: #16a34a;
            border: 1px solid #86efac;
        }
        .info-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            margin-right: 8px;
            margin-bottom: 8px;
        }
        .badge-solution {
            background: #e0f2fe;
            color: #0284c7;
            border: 1px solid #bae6fd;
        }
        .badge-problem {
            background: #dcfce7;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }
        .action-select {
            padding: 8px 16px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: white;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .action-select:hover {
            border-color: var(--primary);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .stats-row {
            display: flex;
            gap: 16px;
            margin-bottom: 24px;
            flex-wrap: wrap;
        }
        .stat-box {
            flex: 1;
            min-width: 150px;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            color: white;
            font-weight: 600;
        }
        .stat-pending {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }
        .stat-progress {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }
        .stat-complete {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
        }
        .stat-number {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 4px;
        }
        .stat-label {
            font-size: 14px;
            opacity: 0.9;
        }
    </style>

    <div class="stats-row">
        <div class="stat-box stat-pending">
            <div class="stat-number">{{ $reports->where('status', 'pending')->count() }}</div>
            <div class="stat-label">⏳ Pending</div>
        </div>
        <div class="stat-box stat-progress">
            <div class="stat-number">{{ $reports->where('status', 'in_progress')->count() }}</div>
            <div class="stat-label">🔄 In Progress</div>
        </div>
        <div class="stat-box stat-complete">
            <div class="stat-number">{{ $reports->where('status', 'complete')->count() }}</div>
            <div class="stat-label">✅ Complete</div>
        </div>
    </div>

    @forelse ($reports as $report)
        <div class="report-card">
            <div class="report-header">
                <div class="user-info">
                    <div class="user-avatar">{{ substr($report->user->name, 0, 1) }}</div>
                    <div>
                        <div style="font-weight: 600; color: var(--dark); font-size: 16px;">{{ $report->user->name }}</div>
                        <div style="font-size: 12px; color: var(--gray);">{{ $report->created_at->format('d M Y H:i') }}</div>
                    </div>
                </div>
                <div>
                    @if ($report->status === 'pending')
                        <span class="status-badge status-pending">⏳ Pending</span>
                    @elseif ($report->status === 'in_progress')
                        <span class="status-badge status-in-progress">🔄 In Progress</span>
                    @elseif ($report->status === 'complete')
                        <span class="status-badge status-complete">✅ Complete</span>
                    @endif
                </div>
            </div>

            <div style="margin-bottom: 12px;">
                <span class="info-badge badge-solution">💡 {{ $report->solution->title }}</span>
                <span class="info-badge badge-problem">📋 {{ $report->solution->problem->title }}</span>
            </div>

            <div class="report-content">
                <p style="margin: 0; color: var(--gray); line-height: 1.6;">
                    <i class="fas fa-comment-alt" style="color: var(--primary); margin-right: 8px;"></i>
                    {{ $report->description }}
                </p>
            </div>

            <div style="display: flex; justify-content: flex-end; align-items: center; gap: 12px; margin-top: 16px;">
                <span style="font-size: 13px; color: var(--gray); font-weight: 500;">Ubah Status:</span>
                <select onchange="updateStatus({{ $report->id }}, this.value)" class="action-select">
                    <option value="pending" {{ $report->status === 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                    <option value="in_progress" {{ $report->status === 'in_progress' ? 'selected' : '' }}>🔄 In Progress</option>
                    <option value="complete" {{ $report->status === 'complete' ? 'selected' : '' }}>✅ Complete</option>
                </select>
            </div>
        </div>
    @empty
        <div style="text-align: center; padding: 60px 20px; background: white; border-radius: 16px; border: 1px solid var(--border);">
            <div style="color: var(--gray);">
                <i class="fas fa-flag" style="font-size: 64px; margin-bottom: 20px; opacity: 0.3;"></i>
                <p style="font-size: 18px; font-weight: 500;">Tidak ada laporan</p>
                <p style="font-size: 14px; margin-top: 8px;">Belum ada laporan yang masuk dari user</p>
            </div>
        </div>
    @endforelse

    <form method="POST" id="updateStatusForm" action="">
        @csrf
        @method('PUT')
        <input type="hidden" name="status" id="statusInput">
    </form>

    @push('scripts')
    <script>
        function updateStatus(reportId, status) {
            const statusLabels = {
                'pending': 'Pending',
                'in_progress': 'In Progress',
                'complete': 'Complete'
            };
            if (confirm('Apakah Anda yakin ingin mengubah status laporan ini menjadi ' + statusLabels[status] + '?')) {
                document.getElementById('updateStatusForm').action = `{{ url('admin/reports') }}/${reportId}`;
                document.getElementById('statusInput').value = status;
                document.getElementById('updateStatusForm').submit();
            }
        }
    </script>
    @endpush
</x-layout>
