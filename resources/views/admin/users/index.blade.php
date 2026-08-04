@php $pageTitle = 'Manajemen Pengguna'; @endphp
<x-layout :page-title="$pageTitle">
    <div class="card">
        <div class="card-header"><h3>Daftar Pengguna</h3></div>

        <div class="table-container">
            <table>
                <thead>
                    <tr><th>No</th><th>Nama</th><th>Email</th><th>Role</th><th>Status</th><th>Tgl Registrasi</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $user->name }}</strong></td>
                            <td>{{ $user->email }}</td>
                            <td><span class="badge {{ $user->role === 'admin' ? 'badge-success' : 'badge-danger' }}">{{ ucfirst($user->role) }}</span></td>
                            <td><span class="badge {{ $user->status === 'active' ? 'badge-success' : 'badge-danger' }}">{{ ucfirst($user->status) }}</span></td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="action-buttons">
                                    @if ($user->role !== 'admin' || $user->id !== auth()->id())
                                        <button class="btn btn-warning btn-sm" onclick='showEditModal(@json($user))'>
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    @endif
                                    @if ($user->role !== 'admin')
                                        <button class="btn btn-danger btn-sm" onclick="deleteItem({{ $user->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" style="text-align: center; padding: 30px;"><p style="color: var(--gray);">Tidak ada pengguna</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal-overlay">
        <div class="modal-box">
            <div class="modal-header">
                <h5 style="margin:0;">Edit Pengguna</h5>
                <button type="button" class="modal-close" onclick="closeEditModal()"><i class="fas fa-times"></i></button>
            </div>
            <form method="POST" id="editForm" action="">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" id="editName" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="editEmail" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="editStatus">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
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
        function showEditModal(user) {
            document.getElementById('editForm').action = `{{ url('admin/users') }}/${user.id}`;
            document.getElementById('editName').value = user.name;
            document.getElementById('editEmail').value = user.email;
            document.getElementById('editStatus').value = user.status;
            document.getElementById('editModal').classList.add('active');
        }
        function closeEditModal() { document.getElementById('editModal').classList.remove('active'); }

        function deleteItem(id) {
            if (confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) {
                document.getElementById('deleteForm').action = `{{ url('admin/users') }}/${id}`;
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
    @endpush
</x-layout>
