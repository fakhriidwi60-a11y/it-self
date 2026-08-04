@php $pageTitle = 'Management Problem'; @endphp
<x-layout :page-title="$pageTitle">
    <div class="card">
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Cari problem atau solusi..." value="{{ $search }}" onkeyup="liveSearch()">
            <select id="categoryFilter" onchange="liveSearch()">
                <option value="0">Semua Kategori</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $categoryFilter == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Problem</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="problemTableBody">
                    @include('problems.partials.table-rows')
                </tbody>
            </table>
        </div>
    </div>

    @push('scripts')
    <script>
        let searchTimeout;

        function liveSearch() {
            clearTimeout(searchTimeout);

            const search = document.getElementById('searchInput').value;
            const category = document.getElementById('categoryFilter').value;

            const newUrl = '{{ route('problems.index') }}?search=' + encodeURIComponent(search) + '&category=' + category;
            history.pushState({ path: newUrl }, '', newUrl);

            searchTimeout = setTimeout(function () {
                fetch('{{ route('problems.search') }}?search=' + encodeURIComponent(search) + '&category=' + category)
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('problemTableBody').innerHTML = data;
                    });
            }, 300);
        }
    </script>
    @endpush
</x-layout>
