@extends('admin.layouts.admin')

{{-- 2. Mengisi judul halaman spesifik --}}
@section('title', 'Dashboard Admin')

{{-- 3. Menambahkan CSS khusus HANYA untuk halaman ini --}}
@push('styles')
<style>
    /* CSS untuk Kartu Statistik */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    .stat-card {
        background-color: #fff;
        padding: 25px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .stat-card .stat-icon {
        font-size: 2.5rem;
        padding: 15px;
        border-radius: 50%;
        margin-right: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .stat-card .stat-icon.icon-car { background-color: #e6f3ff; color: #0e4bf1; }
    .stat-card .stat-icon.icon-rented { background-color: #fff0e7; color: #ff8c42; }
    .stat-card .stat-info h4 { font-size: 1rem; color: #888; margin-bottom: 5px; font-weight: 500;}
    .stat-card .stat-info p { font-size: 1.8rem; font-weight: 700; color: var(--secondary-color); }
    
    /* CSS untuk wadah konten & header di dalamnya */
    .content-container { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.05); }
    .content-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .content-header h2 { color: var(--dark-color); }
    .btn { padding: 10px 20px; border-radius: 5px; border: none; color: #fff; font-size: 16px; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; transition: background-color 0.3s; }
    .btn i { margin-right: 8px; }
    .btn-primary { background-color: var(--primary-color); }
    .btn-primary:hover { background-color: #0b3ac7; }

    /* CSS untuk CAR-GRID & CAR-CARD */
    .car-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; }
    .car-card { background-color: #fff; border-radius: 10px; border: 1px solid #eee; box-shadow: 0 4px 8px rgba(0,0,0,0.08); overflow: hidden; cursor: pointer; transition: all 0.3s ease; }
    .car-card:hover { transform: translateY(-5px); box-shadow: 0 8px 16px rgba(0,0,0,0.12); }
    .car-card .card-content { padding: 16px; }
    .car-card .card-title { font-size: 1.1rem; font-weight: 600; color: var(--dark-color); }
    .car-card .card-brand { font-size: 0.9rem; color: #666; }
    .car-card .card-image-container { height: 180px; position: relative; }
    .car-card .card-img { width: 100%; height: 100%; object-fit: cover; }
    .status-on-card { position: absolute; top: 12px; right: 12px; z-index: 2; padding: 5px 10px; border-radius: 15px; font-size: 12px; color: #fff; font-weight: 500; box-shadow: 0 2px 5px rgba(0,0,0,0.2); }
    .status { padding: 5px 10px; border-radius: 15px; font-size: 12px; color: #fff; font-weight: 500; }
    .status-tersedia { background-color: #28a745; }
    .status-disewa { background-color: #dc3545; }

    /* CSS Modal Pop-up */
    .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6); z-index: 1000; display: flex; align-items: center; justify-content: center; visibility: hidden; opacity: 0; transition: visibility 0s 0.3s, opacity 0.3s ease; }
    .modal-overlay.active { visibility: visible; opacity: 1; transition: visibility 0s, opacity 0.3s ease; }
    .modal-content { background: #fff; padding: 30px; border-radius: 10px; width: 90%; max-width: 600px; position: relative; transform: translateY(-20px) scale(0.95); transition: transform 0.3s ease, opacity 0.3s ease; }
    .modal-overlay.active .modal-content { transform: translateY(0) scale(1); }
    .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .modal-header h3 { font-size: 1.5rem; color: var(--dark-color); }
    .modal-header .close-modal { font-size: 2.5rem; font-weight: bold; color: #aaa; cursor: pointer; line-height: 1; }
    .modal-header .close-modal:hover { color: var(--dark-color); }
    .modal-body { display: flex; flex-direction: column; gap: 20px; }
    .modal-body .modal-image { width: 100%; height: 200px; object-fit: cover; border-radius: 8px; }
    .modal-body .modal-details ul { list-style: none; padding: 0; margin: 0; }
    .modal-body .modal-details ul li { margin-bottom: 12px; display: flex; align-items: flex-start; font-size: 0.95rem; }
    .modal-body .modal-details ul li strong { color: #555; font-weight: 600; width: 120px; flex-shrink: 0; margin-right: 10px; }
    .modal-body .modal-details ul li span { color: var(--dark-color); }
    .modal-footer { margin-top: 25px; display: flex; gap: 10px; border-top: 1px solid #eee; padding-top: 20px; }
    .btn-edit, .btn-delete, .btn-export-pdf { padding: 8px 12px; font-size: 14px; border-radius: 5px; color: #fff; text-decoration: none; flex-grow: 1; text-align: center; justify-content: center;}
    .btn-edit { background-color: #ffc107; color: #333; }
    .btn-delete { background-color: #dc3545; }
    .btn-export-pdf { background-color: #17a2b8; }
    .no-cars-found { padding: 40px; text-align: center; background-color: #f9f9f9; border-radius: 8px; grid-column: 1 / -1; }
    
    @media (max-width: 1200px) {
        .stats-grid { grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); }
    }
    @media (max-width: 768px) {
        .stats-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon icon-car"><i class='bx bxs-car'></i></div>
            <div class="stat-info">
                <h4>Total Mobil</h4>
                <p>{{ $totalCars }}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-car"><i class='bx bx-car-garage'></i></div>
            <div class="stat-info">
                <h4>Mobil Tersedia</h4>
                <p>{{ $availableCars }}</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon icon-rented"><i class='bx bxs-key'></i></div>
            <div class="stat-info">
                <h4>Mobil Disewa</h4>
                <p>{{ $rentedCars }}</p>
            </div>
        </div>
    </div>

    <div class="content-container">
        <div class="content-header">
            <h2>Mobil Terbaru Ditambahkan</h2>
            <a href="#" class="btn btn-primary"><i class='bx bx-list-ul'></i> Lihat Semua Mobil</a>
        </div>
        
        <div class="car-grid">
            @forelse ($latestCars as $car)
                <div class="car-card"
                    data-title="{{ $car->brand }} {{ $car->model }}"
                    data-brand="{{ $car->brand }}"
                    data-price="Rp {{ number_format($car->price_per_day, 0, ',', '.') }}/hari"
                    data-status="{{ $car->status }}"
                    data-status-class="{{ strtolower($car->status) == 'tersedia' ? 'status-tersedia' : 'status-disewa' }}"
                    data-year="{{ $car->year }}"
                    data-transmission="{{ $car->gearbox }}"
                    data-image="{{ $car->main_image }}">
                    
                    <div class="card-image-container">
                        <img src="{{ $car->main_image }}" alt="{{ $car->brand }} {{ $car->model }}" class="card-img">
                        @if (strtolower($car->status) == 'tersedia')
                            <span class="status status-on-card status-tersedia">Tersedia</span>
                        @else
                            <span class="status status-on-card status-disewa">Disewa</span>
                        @endif
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">{{ $car->brand }} {{ $car->model }}</h3>
                        <p class="card-brand">{{ $car->car_type }}</p>
                    </div>
                </div>
            @empty
                <div class="no-cars-found">
                    <p>Belum ada data mobil. Silakan tambahkan mobil baru.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div id="car-modal-overlay" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-car-title">Detail Mobil</h3>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body">
                <img id="modal-car-image" src="" alt="Gambar Mobil" class="modal-image">
                <div class="modal-details">
                    <ul>
                        <li><strong>Merek</strong><span id="modal-car-brand"></span></li>
                        <li><strong>Harga Sewa</strong><span id="modal-car-price"></span></li>
                        <li><strong>Tahun</strong><span id="modal-car-year"></span></li>
                        <li><strong>Transmisi</strong><span id="modal-car-transmission"></span></li>
                        <li><strong>Status</strong><span id="modal-car-status" class="status"></span></li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-edit"><i class='bx bxs-edit'></i> Edit</a>
                <a href="#" class="btn btn-delete"><i class='bx bxs-trash'></i> Hapus</a>
                <a href="#" class="btn btn-export-pdf"><i class='bx bxs-file-pdf'></i> Export PDF</a>
            </div>
        </div>
    </div>
@endsection

{{-- 5. Menambahkan JavaScript khusus halaman ini ke dalam 'stack' scripts --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const carCards = document.querySelectorAll('.car-card');
        const modalOverlay = document.getElementById('car-modal-overlay');
        if (modalOverlay) {
            const closeModalBtn = modalOverlay.querySelector('.close-modal');
            const modalTitle = modalOverlay.querySelector('#modal-car-title');
            const modalImage = modalOverlay.querySelector('#modal-car-image');
            const modalBrand = modalOverlay.querySelector('#modal-car-brand');
            const modalPrice = modalOverlay.querySelector('#modal-car-price');
            const modalYear = modalOverlay.querySelector('#modal-car-year');
            const modalTransmission = modalOverlay.querySelector('#modal-car-transmission');
            const modalStatus = modalOverlay.querySelector('#modal-car-status');
            
            const openModal = () => modalOverlay.classList.add('active');
            const closeModal = () => modalOverlay.classList.remove('active');

            carCards.forEach(card => {
                card.addEventListener('click', function() {
                    const carData = this.dataset;
                    modalTitle.textContent = carData.title;
                    modalImage.src = carData.image;
                    modalBrand.textContent = `: ${carData.brand}`;
                    modalPrice.textContent = `: ${carData.price}`;
                    modalYear.textContent = `: ${carData.year}`;
                    modalTransmission.textContent = `: ${carData.transmission}`;
                    modalStatus.textContent = carData.status;
                    modalStatus.className = 'status ' + carData.statusClass;
                    openModal();
                });
            });

            if(closeModalBtn) closeModalBtn.addEventListener('click', closeModal);
            modalOverlay.addEventListener('click', (event) => { if (event.target === modalOverlay) closeModal(); });
            document.addEventListener('keydown', (event) => { if (event.key === 'Escape' && modalOverlay.classList.contains('active')) closeModal(); });
        }
    });
</script>
@endpush