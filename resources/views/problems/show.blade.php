@php $pageTitle = 'Detail Problem'; @endphp
<x-layout :page-title="$pageTitle" header-title="Detail Problem & Solusi">
    <div class="card">
        <div class="card-header">
            <h3>{{ $problem->title }}</h3>
            <a href="{{ route('problems.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div style="margin-bottom: 25px;">
            <p style="color: var(--gray); margin-bottom: 15px; line-height: 1.6;">
                {{ $problem->description }}
            </p>

            <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                <div>
                    <strong style="color: var(--dark); font-size: 13px;">Kategori:</strong>
                    <span class="badge badge-success">{{ $problem->category->name }}</span>
                </div>
                <div>
                    <strong style="color: var(--dark); font-size: 13px;">Tanggal Dibuat:</strong>
                    <span style="color: var(--gray); font-size: 13px;">{{ $problem->created_at->format('d M Y') }}</span>
                </div>
                <div>
                    <strong style="color: var(--dark); font-size: 13px;">Tanggal Diperbarui:</strong>
                    <span style="color: var(--gray); font-size: 13px;">{{ $problem->updated_at->format('d M Y') }}</span>
                </div>
            </div>
        </div>

        <hr style="border: none; border-top: 1px solid var(--border); margin: 20px 0;">

        <h4 style="color: var(--dark); margin-bottom: 20px;">Solusi Tersedia</h4>

        @forelse ($problem->solutions as $solution)
            <div style="background: var(--light); padding: 20px; border-radius: 12px; margin-bottom: 15px;">
                <div style="display: flex; justify-content: space-between; align-items: center; gap: 10px; flex-wrap: wrap;">
                    <h5 style="color: var(--dark); margin: 0;">
                        <i class="fas fa-lightbulb" style="color: var(--success); margin-right: 8px;"></i>
                        {{ $solution->title }}
                    </h5>
                    <button type="button" class="btn btn-secondary btn-sm btn-lihat-solusi" data-modal-target="#modal-solusi-{{ $solution->id }}">
                        <i class="fas fa-eye"></i> Lihat Solusi
                    </button>
                </div>

                @if ($solution->notes)
                    <div class="notes-box">
                        <i class="fas fa-info-circle" style="margin-right: 5px;"></i>
                        <strong>Catatan:</strong> {{ $solution->notes }}
                    </div>
                @endif
            </div>

            <div class="modal-overlay" id="modal-solusi-{{ $solution->id }}">
                <div class="modal-box">
                    <div class="modal-header">
                        <h5 style="margin: 0; color: var(--dark);">
                            <i class="fas fa-lightbulb" style="color: var(--success); margin-right: 8px;"></i>
                            {{ $solution->title }}
                        </h5>
                        <button type="button" class="modal-close" data-modal-close><i class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body">
                        @if (count($solution->steps_list) > 0)
                            <ol class="steps-list">
                                @foreach ($solution->steps_list as $step)
                                    <li>{{ $step }}</li>
                                @endforeach
                            </ol>
                        @else
                            <p style="color: var(--gray); font-size: 14px;">Belum ada langkah solusi.</p>
                        @endif

                        @if ($solution->notes)
                            <div class="notes-box">
                                <i class="fas fa-info-circle" style="margin-right: 5px;"></i>
                                <strong>Catatan:</strong> {{ $solution->notes }}
                            </div>
                        @endif

                        <div style="margin-top: 25px; padding-top: 20px; border-top: 1px solid var(--border);">
                            <p style="margin-bottom: 15px; font-weight: 600;">Apakah solusi ini membantu?</p>
                            <div style="display: flex; gap: 10px;">
                                <button type="button" class="btn btn-success" onclick="closeSolutionModal({{ $solution->id }})">
                                    <i class="fas fa-check"></i> Ya, membantu
                                </button>
                                <button type="button" class="btn btn-danger" onclick="showReportForm({{ $solution->id }})">
                                    <i class="fas fa-exclamation-triangle"></i> Tidak, buat laporan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-overlay" id="modal-laporan-{{ $solution->id }}">
                <div class="modal-box">
                    <div class="modal-header">
                        <h5 style="margin: 0; color: var(--dark);">
                            <i class="fas fa-exclamation-triangle" style="color: var(--danger); margin-right: 8px;"></i>
                            Buat Laporan ke IT
                        </h5>
                        <button type="button" class="modal-close" onclick="closeReportModal({{ $solution->id }})"><i class="fas fa-times"></i></button>
                    </div>
                    <form method="POST" action="{{ route('reports.store') }}" class="modal-form">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Solusi yang bermasalah</label>
                                <input type="text" value="{{ $solution->title }}" readonly style="background: var(--light);">
                                <input type="hidden" name="solution_id" value="{{ $solution->id }}">
                            </div>

                            <div class="form-group">
                                <label>Deskripsi Masalah</label>
                                <textarea name="description" required
                                    placeholder="Jelaskan mengapa solusi ini tidak membantu..."></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="closeReportModal({{ $solution->id }})">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Kirim Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @empty
            <div style="text-align: center; padding: 30px; color: var(--gray);">
                <i class="fas fa-lightbulb" style="font-size: 40px; margin-bottom: 10px;"></i>
                <p>Belum ada solusi untuk problem ini</p>
            </div>
        @endforelse
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.btn-lihat-solusi').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    document.querySelector(btn.getAttribute('data-modal-target'))?.classList.add('active');
                });
            });

            document.querySelectorAll('[data-modal-close]').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    btn.closest('.modal-overlay').classList.remove('active');
                });
            });

            document.querySelectorAll('.modal-overlay').forEach(function (overlay) {
                overlay.addEventListener('click', function (e) {
                    if (e.target === overlay) overlay.classList.remove('active');
                });
            });

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    document.querySelectorAll('.modal-overlay.active').forEach(o => o.classList.remove('active'));
                }
            });
        });

        function closeSolutionModal(solutionId) {
            document.getElementById('modal-solusi-' + solutionId).classList.remove('active');
        }

        function showReportForm(solutionId) {
            document.getElementById('modal-solusi-' + solutionId).classList.remove('active');
            document.getElementById('modal-laporan-' + solutionId).classList.add('active');
        }

        function closeReportModal(solutionId) {
            document.getElementById('modal-laporan-' + solutionId).classList.remove('active');
        }
    </script>
    @endpush
</x-layout>
