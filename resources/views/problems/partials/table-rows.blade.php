@forelse ($problems as $problem)
    <tr>
        <td>{{ $loop->iteration + ($problems->currentPage() - 1) * $problems->perPage() }}</td>
        <td>
            <strong>{{ $problem->title }}</strong><br>
            <small style="color: var(--gray);">{{ Str::limit($problem->description, 100) }}</small>
        </td>
        <td><span class="badge badge-success">{{ $problem->category->name }}</span></td>
        <td>{{ $problem->created_at->format('d M Y') }}</td>
        <td>
            <a href="{{ route('problems.show', $problem) }}" class="btn btn-primary btn-sm">
                <i class="fas fa-lightbulb"></i> Solusi
            </a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" style="text-align: center; padding: 30px;">
            <i class="fas fa-search" style="font-size: 40px; color: var(--gray); margin-bottom: 10px;"></i>
            <p style="color: var(--gray);">Tidak ada problem ditemukan</p>
        </td>
    </tr>
@endforelse
