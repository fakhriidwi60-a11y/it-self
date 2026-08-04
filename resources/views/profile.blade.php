@php $pageTitle = 'Profile'; @endphp
<x-layout :page-title="$pageTitle" header-title="Profile User">
    <div class="card">
        <div class="card-header">
            <h3>Informasi Profile</h3>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" style="max-width: 600px;">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <hr style="border: none; border-top: 1px solid var(--border); margin: 30px 0;">

            <h4 style="margin-bottom: 20px; color: var(--dark);">Ubah Password (Opsional)</h4>

            <div class="form-group">
                <label>Password Saat Ini</label>
                <input type="password" name="current_password" placeholder="Masukkan password saat ini">
            </div>
            <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="new_password" placeholder="Masukkan password baru (minimal 6 karakter)">
            </div>
            <div class="form-group">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="confirm_password" placeholder="Ulangi password baru">
            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            <h3>Informasi Akun</h3>
        </div>
        <div style="color: var(--gray); font-size: 14px;">
            <ul style="padding-left: 20px; line-height: 2;">
                <li><strong>Role:</strong> {{ ucfirst($user->role) }}</li>
                <li><strong>Status:</strong> {{ ucfirst($user->status) }}</li>
                <li><strong>Tanggal Registrasi:</strong> {{ $user->created_at->format('d M Y') }}</li>
                <li><strong>Terakhir Diperbarui:</strong> {{ $user->updated_at->format('d M Y') }}</li>
            </ul>
        </div>
    </div>
</x-layout>