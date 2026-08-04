@php $pageTitle = 'Manajemen Problem'; @endphp
<x-layout :page-title="$pageTitle">
    <div class="card">
        <div class="card-header">
            <h3>Daftar Problem</h3>
            <button class="btn btn-primary" onclick="showAddModal()"><i class="fas fa-plus"></i> Tambah Problem</button>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr><th>No</th><th>Problem</th><th>Kategori</th><th>Solusi</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse ($problems as $prob)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $prob->title }}</strong><br>
                                <small style="color: var(--gray);">{{ Str::limit($prob->description, 80) }}</small>
                            </td>
                            <td><span class="badge badge-success">{{ $prob->category->name }}</span></td>
                            <td>{{ $prob->solutions_count }} solusi</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-warning btn-sm" onclick='showEditModal(@json($prob))'>
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteItem({{ $prob->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" style="text-align: center; padding: 30px;"><p style="color: var(--gray);">Tidak ada problem</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="addModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h5 style="margin:0;">Tambah Problem</h5>
                <button type="button" class="modal-close" onclick="closeAddModal()"><i class="fas fa-times"></i></button>
            </div>
            <form method="POST" action="{{ route('admin.problems.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih Kategori</label>
                        <select name="category_id" required>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Problem</label>
                        <input type="text" name="title" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="description" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeAddModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h5 style="margin:0;">Edit Problem</h5>
                <button type="button" class="modal-close" onclick="closeEditModal()"><i class="fas fa-times"></i></button>
            </div>
            <form method="POST" id="editForm" action="">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pilih Kategori</label>
                        <select name="category_id" id="editCategoryId" required>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Problem</label>
                        <input type="text" name="title" id="editTitle" required>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea name="description" id="editDescription" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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

        function showEditModal(problem) {
            document.getElementById('editForm').action = `{{ url('admin/problems') }}/${problem.id}`;
            document.getElementById('editCategoryId').value = problem.category_id;
            document.getElementById('editTitle').value = problem.title;
            document.getElementById('editDescription').value = problem.description;
            document.getElementById('editModal').classList.add('active');
        }
        function closeEditModal() { document.getElementById('editModal').classList.remove('active'); }

        function deleteItem(id) {
            if (confirm('Apakah Anda yakin ingin menghapus problem ini?')) {
                document.getElementById('deleteForm').action = `{{ url('admin/problems') }}/${id}`;
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
    @endpush
</x-layout>
