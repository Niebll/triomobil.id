@extends('admin.layouts.admin')

@section('title', 'Manajemen Mobil')

@push('styles')
<style>
    .content-header h2 {
        font-weight: 600;
    }
    .table-container,
    .filter-bar {
        background-color: #fff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    .filter-bar {
        margin-bottom: 20px;
    }

    /* [PENYEMPURNAAN] Style baru untuk semua tombol (.btn, .btn-primary) */
    .btn {
        padding: 10px 22px;
        border-radius: 8px;
        border: none;
        color: #fff;
        font-size: 0.95rem;
        font-weight: 600; /* Dibuat lebih tebal */
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(14, 75, 241, 0.3); /* Efek glow biru */
    }
    .btn i {
        margin-right: 8px;
        font-size: 1.2rem;
    }
    .btn-primary {
        background-image: linear-gradient(45deg, #0e4bf1 0%, #3a75f5 100%);
        border: none;
    }
    .btn-primary:hover {
        background-image: linear-gradient(45deg, #0b3ac7 0%, #2f65e0 100%);
    }

    /* Style untuk filter bar */
    .filter-bar form {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        align-items: flex-end;
    }
    .filter-bar .form-group { flex: 1 1 200px; }
    .filter-bar .form-group.search-group { flex: 2 1 300px; }
    .filter-bar label { display: block; margin-bottom: 8px; font-weight: 500; font-size: 0.9rem; color: #555; }
    .filter-bar input,
    .filter-bar select { width: 100%; padding: 10px 15px; border: 1px solid #ddd; border-radius: 8px; height: 44px; transition: border-color 0.3s, box-shadow 0.3s; font-size: 0.95rem; }
    .filter-bar input:focus,
    .filter-bar select:focus { outline: none; border-color: var(--primary-color); box-shadow: 0 0 0 3px rgba(14, 75, 241, 0.2); }
    .search-input-wrapper { position: relative; }
    .search-input-wrapper i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #aaa; font-size: 1.1rem; pointer-events: none; }
    .search-input-wrapper input { padding-left: 45px; }
    .btn-filter { height: 44px; font-weight: 500; }
    .btn-filter i { margin-right: 5px; font-size: 1.1rem; }

    /* Style untuk tabel data */
    .data-table { width: 100%; border-collapse: collapse; }
    .data-table th, .data-table td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #f0f0f0; vertical-align: middle; }
    .data-table th { background-color: #f8f9fa; font-weight: 600; color: #555; }
    .data-table tbody tr:hover { background-color: #f8f9fa; }
    .data-table .table-img { width: 90px; height: 50px; object-fit: cover; border-radius: 5px; }
    .action-buttons { display: flex; gap: 8px; align-items: center; }
    .action-buttons form { display: inline-block; margin: 0; }
    .action-buttons .btn { padding: 6px 12px; font-size: 0.85rem; border-radius: 6px; }
    .btn-edit { background-color: #ffc107; color: var(--dark-color); }
    .btn-edit:hover { background-color: #e0a800; box-shadow: 0 4px 8px rgba(255, 193, 7, 0.3); }
    .btn-delete { background-color: #dc3545; }
    .btn-delete:hover { background-color: #c82333; box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3); }
    .btn-pdf { background-color: #17a2b8; }
    .btn-pdf:hover { background-color: #138496; box-shadow: 0 4px 8px rgba(23, 162, 184, 0.3); }
    .action-buttons .btn i { font-size: 1rem; margin-right: 5px; }

    .status { padding: 5px 12px; border-radius: 15px; font-size: 12px; color: #fff; font-weight: 500; text-transform: capitalize;}
    .status-tersedia { background-color: #28a745; }
    .status-disewa { background-color: #dc3545; }
</style>
@endpush

@section('content')
<div class="content-header">
    <h2>Manajemen Mobil</h2>
    {{-- Tombol Tambah Mobil menggunakan href="#" --}}
    <a href="{{ route('dashboard.cars.create') }}" class="btn btn-primary"><i class='bx bx-plus'></i> Tambah Mobil</a>
</div>

<div class="filter-bar">
    {{-- Form filter tetap menggunakan route('dashboard.cars') sesuai permintaan --}}
    <form action="{{ route('dashboard.cars') }}" method="GET">
        <div class="form-group search-group">
            <label for="search">Cari Mobil</label>
            <div class="search-input-wrapper">
                <i class='bx bx-search'></i>
                <input type="text" id="search" name="search" placeholder="Ketik merek, model, atau plat nomor..." value="{{ request('search') }}">
            </div>
        </div>
        <div class="form-group">
            <label for="status">Filter Status</label>
            <select name="status" id="status" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="Tersedia" {{ request('status') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="Disewa" {{ request('status') == 'Disewa' ? 'selected' : '' }}>Disewa</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-filter"><i class='bx bx-filter-alt'></i> Filter</button>
    </form>
</div>

<div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Gambar</th>
                <th>Nama Mobil</th>
                <th>Plat Nomor</th>
                <th>Harga/Hari</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cars as $car)
                <tr>
                    <td>{{ $car->id }}</td>
                    <td>
                        <img src="{{ $car->main_image }}" alt="{{ $car->model }}" class="table-img">
                    </td>
                    <td><strong>{{ $car->brand }}</strong> {{ $car->model }}</td>
                    <td>{{ $car->license_plate }}</td>
                    <td>Rp {{ number_format($car->price_per_day, 0, ',', '.') }}</td>
                    <td>
                        @if (strtolower($car->status) == 'tersedia')
                            <span class="status status-tersedia">{{ $car->status }}</span>
                        @else
                            <span class="status status-disewa">{{ $car->status }}</span>
                        @endif
                    </td>
                    <td class="action-buttons">
                        <a href="{{ route('dashboard.cars.edit', $car->id) }}" class="btn btn-edit"><i class='bx bxs-edit-alt'></i> Edit</a>
                        
                        {{-- Tombol PDF menggunakan href="#" --}}
                        <a href="{{ route('dashboard.cars.export-pdf', $car->id) }}" class="btn btn-pdf" target="_blank"><i class='bx bxs-file-pdf'></i> PDF</a>
                        
                        {{-- Form Hapus menggunakan action="#" --}}
                        <form action="{{ route('dashboard.cars.delete', $car->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus mobil ini?');">
                            @csrf
                            <button type="submit" class="btn btn-delete"><i class='bx bxs-trash'></i> Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 20px;">
                        Tidak ada data mobil yang ditemukan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination-container" style="margin-top: 20px;">
    {{ $cars->links('pagination::bootstrap-5') }}
</div>

@endsection

@push('scripts')
{{-- Tidak ada script tambahan yang dibutuhkan untuk halaman ini --}}
@endpush