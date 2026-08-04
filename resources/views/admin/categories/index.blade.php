@php $pageTitle = 'Manajemen Kategori'; @endphp
<x-layout :page-title="$pageTitle">
    <div class="card">
        <div class="card-header">
            <h3>Daftar Kategori</h3>
            <button class="btn btn-primary" onclick="showAddModal()"><i class="fas fa-plus"></i> Tambah Kategori</button>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr><th>No</th><th>Nama Kategori</th><th>Deskripsi</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse ($categories as $cat)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $cat->name }}</strong></td>
                            <td>{{ Str::limit($cat->description, 100) }}</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-warning btn-sm" onclick='showEditModal(@json($cat))'>
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteItem({{ $cat->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" style="text-align: center; padding: 30px;"><p style="color: var(--gray);">Tidak ada kategori</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="addModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h5 style="margin:0;">Tambah Kategori</h5>
                <button type="button" class="modal-close" onclick="closeAddModal()"><i class="fas fa-times"></i></button>
            </div>
            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text" name="name" required>
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
                <h5 style="margin:0;">Edit Kategori</h5>
                <button type="button" class="modal-close" onclick="closeEditModal()"><i class="fas fa-times"></i></button>
            </div>
            <form method="POST" id="editForm" action="">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text" name="name" id="editName" required>
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

    <!-- Delete confirm form (hidden, submitted by JS) -->
    <form method="POST" id="deleteForm" action="">
        @csrf
        @method('DELETE')
    </form>

    @push('scripts')
    <script>
        function showAddModal() { document.getElementById('addModal').classList.add('active'); }
        function closeAddModal() { document.getElementById('addModal').classList.remove('active'); }

        function showEditModal(category) {
            document.getElementById('editForm').action = `{{ url('admin/categories') }}/${category.id}`;
            document.getElementById('editName').value = category.name;
            document.getElementById('editDescription').value = category.description;
            document.getElementById('editModal').classList.add('active');
        }
        function closeEditModal() { document.getElementById('editModal').classList.remove('active'); }

        function deleteItem(id) {
            if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
                document.getElementById('deleteForm').action = `{{ url('admin/categories') }}/${id}`;
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
    @endpush
</x-layout>
