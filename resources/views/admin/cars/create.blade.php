@extends('admin.layouts.admin')

@section('title', 'Tambah Mobil Baru')

@push('styles')
<style>
    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .form-container {
        background: #fff;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .form-control {
        padding: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 8px;
    }

    .form-control.is-invalid {
        border-color: red;
    }

    .invalid-feedback {
        color: red;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
    }

    .btn {
        padding: 0.6rem 1.2rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }

    .btn-cancel {
        background-color: #dc3545;
        color: white;
    }

    .full-width {
        grid-column: 1 / -1;
    }

    .image-url-group {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .image-url-group input {
        flex: 1;
    }
</style>
@endpush

@section('content')
<div class="content-header">
    <h2>Tambah Mobil Baru</h2>
    <a href="{{ route('dashboard.cars') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="form-container">
    <form action="{{ route('dashboard.cars.create.post') }}" method="POST">
        @csrf
        <div class="form-grid">
            <!-- Field sesuai fillable -->

            <div class="form-group">
                <label for="brand">Merk</label>
                <input type="text" name="brand" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="model">Model</label>
                <input type="text" name="model" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="car_type">Tipe Mobil</label>
                <input type="text" name="car_type" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="license_plate">Plat Nomor</label>
                <input type="text" name="license_plate" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="year">Tahun</label>
                <input type="number" name="year" class="form-control" min="1990" max="{{ date('Y') }}" required>
            </div>

            <div class="form-group">
                <label for="color">Warna</label>
                <input type="text" name="color" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="seat">Jumlah Kursi</label>
                <input type="number" name="seat" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="gearbox">Transmisi</label>
                <select name="gearbox" class="form-control" required>
                    <option value="manual">Manual</option>
                    <option value="matic">Matic</option>
                </select>
            </div>

            <div class="form-group">
                <label for="price_per_day">Harga per Hari (Rp)</label>
                <input type="number" name="price_per_day" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control" required>
                    <option value="tersedia">Tersedia</option>
                    <option value="disewa">Disewa</option>
                </select>
            </div>

            <div class="form-group full-width">
                <label for="description">Deskripsi</label>
                <textarea name="description" class="form-control" rows="4"></textarea>
            </div>

            <div class="form-group full-width">
                <label for="main_image">Link Gambar Utama</label>
                <input type="text" name="main_image" class="form-control" placeholder="https://..." required>
                @error('main_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group full-width">
                <label for="image_urls[]">Link Gambar Tambahan</label>
                <div id="image-url-wrapper">
                    <div class="image-url-group mb-2">
                        <input type="text" name="image_urls[]" class="form-control" placeholder="https://...">
                        <button type="button" class="btn btn-cancel" onclick="removeImageUrlField(this)">Hapus</button>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary mt-2" onclick="addImageUrlField()">+ Tambah Link</button>
                @error('image_urls.*')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('dashboard.cars') }}" class="btn btn-cancel">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Mobil</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function addImageUrlField() {
        const wrapper = document.getElementById('image-url-wrapper');

        const group = document.createElement('div');
        group.classList.add('image-url-group', 'mb-2');

        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'image_urls[]';
        input.placeholder = 'https://...';
        input.classList.add('form-control');

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.classList.add('btn', 'btn-cancel');
        removeBtn.innerText = 'Hapus';
        removeBtn.onclick = function () {
            removeImageUrlField(removeBtn);
        };

        group.appendChild(input);
        group.appendChild(removeBtn);
        wrapper.appendChild(group);
    }

    function removeImageUrlField(button) {
        const group = button.parentElement;
        group.remove();
    }
</script>
@endpush
