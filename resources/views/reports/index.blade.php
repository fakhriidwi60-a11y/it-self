@php $pageTitle = 'Riwayat Laporan Saya'; @endphp
<x-layout :page-title="$pageTitle">
    <div class="card">
        <div class="card-header">
            <h3>Riwayat Laporan Saya</h3>
            <a href="{{ route('problems.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        @forelse ($reports as $report)
            <div style="background: var(--light); padding: 20px; border-radius: 12px; margin-bottom: 15px; border-left: 4px solid var(--primary);">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 15px; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 250px;">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                            <h5 style="margin: 0; color: var(--dark);">
                                <i class="fas fa-lightbulb" style="color: var(--success); margin-right: 8px;"></i>
                                {{ $report->solution->title }}
                            </h5>
                            @if ($report->status === 'pending')
                                <span class="badge badge-danger" style="background: #fee2e2; color: #dc2626; border: 1px solid #fecaca;">⏳ Pending</span>
                            @elseif ($report->status === 'in_progress')
                                <span class="badge badge-warning" style="background: #fef3c7; color: #d97706; border: 1px solid #fde68a;">🔄 In Progress</span>
                            @elseif ($report->status === 'complete')
                                <span class="badge badge-success" style="background: #dcfce7; color: #16a34a; border: 1px solid #bbf7d0;">✅ Complete</span>
                            @endif
                        </div>

                        <div style="margin-bottom: 10px;">
                            <span class="badge badge-success">{{ $report->solution->problem->title }}</span>
                        </div>

                        <div style="background: white; padding: 12px; border-radius: 8px; margin-bottom: 10px;">
                            <p style="margin: 0; color: var(--gray); font-size: 14px;">
                                <i class="fas fa-comment-alt" style="margin-right: 5px;"></i>
                                <strong>Deskripsi:</strong> {{ $report->description }}
                            </p>
                        </div>

                        <small style="color: var(--gray); font-size: 12px;">
                            <i class="fas fa-clock"></i> {{ $report->created_at->format('d M Y H:i') }}
                            @if ($report->updated_at != $report->created_at)
                                <span style="margin-left: 10px;">
                                    <i class="fas fa-edit"></i> Diperbarui: {{ $report->updated_at->format('d M Y H:i') }}
                                </span>
                            @endif
                        </small>
                    </div>
                </div>
            </div>
        @empty
            <div style="text-align: center; padding: 40px; color: var(--gray);">
                <i class="fas fa-flag" style="font-size: 50px; margin-bottom: 15px; opacity: 0.5;"></i>
                <p style="font-size: 16px;">Belum ada laporan yang Anda buat</p>
                <a href="{{ route('problems.index') }}" class="btn btn-primary" style="margin-top: 10px;">
                    <i class="fas fa-search"></i> Cari Solusi
                </a>
            </div>
        @endforelse
    </div>
</x-layout>
