@php $pageTitle = 'Manajemen Solusi'; @endphp
<x-layout :page-title="$pageTitle">
    <div class="card">
        <div class="card-header">
            <h3>Daftar Solusi</h3>
            <button class="btn btn-primary" onclick="showAddModal()"><i class="fas fa-plus"></i> Tambah Solusi</button>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr><th>No</th><th>Solusi</th><th>Problem</th><th>Langkah</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse ($solutions as $sol)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $sol->title }}</strong></td>
                            <td><span class="badge badge-success">{{ $sol->problem->title }}</span></td>
                            <td><small style="color: var(--gray);">{{ Str::limit($sol->steps, 60) }}</small></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-warning btn-sm" onclick='showEditModal(@json($sol))'>
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteItem({{ $sol->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" style="text-align: center; padding: 30px;"><p style="color: var(--gray);">Tidak ada solusi</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Modal -->
<div id="addModal" class="modal-overlay">
    <div class="modal-box">
        <form method="POST" action="{{ route('admin.solutions.store') }}" class="modal-form">
            @csrf

            <div class="modal-header">
                <h5 style="margin:0;">Tambah Solusi</h5>
                <button type="button" class="modal-close" onclick="closeAddModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Problem</label>
                    <select name="problem_id" required>
                        @foreach ($problems as $prob)
                            <option value="{{ $prob->id }}">
                                {{ $prob->title }} ({{ $prob->category->name }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Judul Solusi</label>
                    <input type="text" name="title" required>
                </div>

                <div class="form-group">
                    <label>Langkah Penyelesaian</label>
                    <textarea name="steps" required
                        placeholder="1. Langkah pertama&#10;2. Langkah kedua&#10;3. Langkah ketiga"></textarea>
                </div>

                <div class="form-group">
                    <label>Catatan Tambahan (Optional)</label>
                    <textarea name="notes"
                        placeholder="Catatan tambahan..."></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeAddModal()">
                    Batal
                </button>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>
        </div>
    </div>

    <div id="editModal" class="modal-overlay">
    <div class="modal-box">
        <form method="POST" id="editForm" class="modal-form">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5>Edit Solusi</h5>
                <button type="button" class="modal-close" onclick="closeEditModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">

                <!-- semua form edit -->

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeEditModal()">
                    Batal
                </button>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>

    <form method="POST" id="deleteForm" action="">
        @csrf
        @method('DELETE')
    </form>

    @push('scripts')
    <script>
        function showAddModal() { document.getElementById('addModal').classList.add('active'); }
        function closeAddModal() { document.getElementById('addModal').classList.remove('active'); }

        function showEditModal(solution) {
            document.getElementById('editForm').action = `{{ url('admin/solutions') }}/${solution.id}`;
            document.getElementById('editProblemId').value = solution.problem_id;
            document.getElementById('editTitle').value = solution.title;
            document.getElementById('editSteps').value = solution.steps;
            document.getElementById('editNotes').value = solution.notes || '';
            document.getElementById('editModal').classList.add('active');
        }
        function closeEditModal() { document.getElementById('editModal').classList.remove('active'); }

        function deleteItem(id) {
            if (confirm('Apakah Anda yakin ingin menghapus solusi ini?')) {
                document.getElementById('deleteForm').action = `{{ url('admin/solutions') }}/${id}`;
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
    @endpush
</x-layout>
