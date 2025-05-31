@extends('admin.layouts.admin')

@section('title', 'Dashboard Utama')

@push('styles')
<style>
    /* CSS UNTUK HEADER, TOMBOL, & KONTEN */
    .header { display: flex; align-items: center; justify-content: space-between; background: #fff; padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
    .header .menu-toggle { font-size: 24px; cursor: pointer; }
    .header .user-profile { display: flex; align-items: center; }
    .header .user-profile span { margin-right: 10px; font-weight: 500; }
    .header .user-profile i { font-size: 28px; }
    .content-container { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
    .content-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    .content-header h2 { color: var(--dark-color); }
    .btn { padding: 10px 20px; border-radius: 5px; border: none; color: #fff; font-size: 16px; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; transition: background-color 0.3s; }
    .btn i { margin-right: 8px; }
    .btn-primary { background-color: var(--primary-color); }
    .btn-primary:hover { background-color: #0b3ac7; }
    
    /* CSS UNTUK CARD LAYOUT */
    .car-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 24px; }
    .car-card { background-color: #fff; border-radius: 10px; border: 1px solid #eee; box-shadow: 0 4px 8px rgba(0,0,0,0.08); overflow: hidden; cursor: pointer; transition: all 0.3s ease; }
    .car-card:hover { transform: translateY(-5px); box-shadow: 0 8px 16px rgba(0,0,0,0.12); }
    .car-card .card-content { padding: 16px; }
    .car-card .card-title { font-size: 1.1rem; font-weight: 600; color: var(--dark-color); }
    .car-card .card-brand { font-size: 0.9rem; color: #666; }

    /* [PERUBAHAN] Container gambar harus relative untuk menampung status */
    .car-card .card-image-container { 
        height: 180px; 
        position: relative; /* Penting untuk positioning status badge */
    }
    .car-card .card-img { width: 100%; height: 100%; object-fit: cover; }
    
    /* [BARU] CSS untuk Status Badge di atas Gambar Kartu */
    .status-on-card {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 2;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    /* CSS untuk Modal Pop-up */
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
    .status { padding: 5px 10px; border-radius: 15px; font-size: 12px; color: #fff; font-weight: 500; }
    .status-tersedia { background-color: #28a745; }
    .status-disewa { background-color: #dc3545; }
    .modal-footer { margin-top: 25px; display: flex; gap: 10px; border-top: 1px solid #eee; padding-top: 20px; }
    .btn-edit, .btn-delete, .btn-export-pdf { padding: 8px 12px; font-size: 14px; border-radius: 5px; color: #fff; text-decoration: none; flex-grow: 1; text-align: center; justify-content: center;}
    .btn-edit { background-color: #ffc107; color: #333; }
    .btn-delete { background-color: #dc3545; }
    .btn-export-pdf { background-color: #17a2b8; }
</style>
@endpush

@section('content')
<section class="main-section">
    <header class="header">
        <div class="menu-toggle"><i class='bx bx-menu'></i></div>
        <div class="user-profile"><span>Halo, Admin</span><i class='bx bxs-user-circle'></i></div>
    </header>

    <div class="content-container">
        <div class="content-header">
            <h2>Daftar Mobil</h2>
            <a href="#" class="btn btn-primary"><i class='bx bx-plus'></i> Tambah Mobil</a>
        </div>
        
        <div class="car-grid">
            {{-- Kartu Mobil 1 --}}
            <div class="car-card"
                data-title="Chevrolet Camaro"
                data-brand="Chevrolet"
                data-price="Rp 1.500.000/hari"
                data-status="Tersedia"
                data-status-class="status-tersedia"
                data-year="2022"
                data-transmission="Otomatis"
                data-image="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?q=80&w=2070&auto=format&fit=crop">
                <div class="card-image-container">
                    <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?q=80&w=2070&auto=format&fit=crop" alt="Mobil" class="card-img">
                    {{-- [PERUBAHAN] Menambahkan Status Badge di sini --}}
                    <span class="status status-on-card status-tersedia">Tersedia</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Chevrolet Camaro</h3>
                    <p class="card-brand">Chevrolet</p>
                </div>
            </div>

            {{-- Kartu Mobil 2 --}}
            <div class="car-card"
                data-title="Porsche 911"
                data-brand="Porsche"
                data-price="Rp 2.500.000/hari"
                data-status="Disewa"
                data-status-class="status-disewa"
                data-year="2023"
                data-transmission="Otomatis"
                data-image="https://images.unsplash.com/photo-1542281286-9e0e16bb7366?q=80&w=2070&auto=format&fit=crop">
                <div class="card-image-container">
                    <img src="https://images.unsplash.com/photo-1542281286-9e0e16bb7366?q=80&w=2070&auto=format&fit=crop" alt="Mobil" class="card-img">
                    {{-- [PERUBAHAN] Menambahkan Status Badge di sini --}}
                    <span class="status status-on-card status-disewa">Disewa</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">Porsche 911</h3>
                    <p class="card-brand">Porsche</p>
                </div>
            </div>
        </div>
    </div>
</section>

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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const carCards = document.querySelectorAll('.car-card');
    const modalOverlay = document.getElementById('car-modal-overlay');
    const closeModalBtn = document.querySelector('.close-modal');
    const modalTitle = document.getElementById('modal-car-title');
    const modalImage = document.getElementById('modal-car-image');
    const modalBrand = document.getElementById('modal-car-brand');
    const modalPrice = document.getElementById('modal-car-price');
    const modalYear = document.getElementById('modal-car-year');
    const modalTransmission = document.getElementById('modal-car-transmission');
    const modalStatus = document.getElementById('modal-car-status');
    
    function openModal() { modalOverlay.classList.add('active'); }
    function closeModal() { modalOverlay.classList.remove('active'); }

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

    closeModalBtn.addEventListener('click', closeModal);
    modalOverlay.addEventListener('click', function(event) { if (event.target === modalOverlay) { closeModal(); } });
    document.addEventListener('keydown', function(event) { if (event.key === 'Escape' && modalOverlay.classList.contains('active')) { closeModal(); } });
});
</script>
@endsection