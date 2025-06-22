@extends('admin.layouts.admin')

@section('title', 'Edit Mobil')

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
    <h2>Edit Mobil</h2>
    <a href="{{ route('dashboard.cars') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="form-container">
    <form method="POST" action="{{ route('dashboard.cars.update', ['car' => $car->id]) }}">
        @csrf
        <div class="form-grid">

            <div class="form-group">
                <label>Merek</label>
                <input type="text" name="brand" class="form-control" value="{{ old('brand', $car->brand) }}" required>
            </div>

            <div class="form-group">
                <label>Model</label>
                <input type="text" name="model" class="form-control" value="{{ old('model', $car->model) }}" required>
            </div>

            <div class="form-group">
                <label>Tipe Mobil</label>
                <input type="text" name="car_type" class="form-control" value="{{ old('car_type', $car->car_type) }}" required>
            </div>

            <div class="form-group">
                <label>Plat Nomor</label>
                <input type="text" name="license_plate" class="form-control" value="{{ old('license_plate', $car->license_plate) }}" required>
            </div>

            <div class="form-group">
                <label>Tahun</label>
                <input type="number" name="year" class="form-control" min="1990" max="{{ date('Y') }}" value="{{ old('year', $car->year) }}" required>
            </div>

            <div class="form-group">
                <label>Warna</label>
                <input type="text" name="color" class="form-control" value="{{ old('color', $car->color) }}" required>
            </div>

            <div class="form-group">
                <label>Jumlah Kursi</label>
                <input type="number" name="seat" class="form-control" value="{{ old('seat', $car->seat) }}" required>
            </div>

            <div class="form-group">
                <label>Transmisi</label>
                <select name="gearbox" class="form-control" required>
                    <option value="manual" {{ old('gearbox', $car->gearbox) == 'manual' ? 'selected' : '' }}>Manual</option>
                    <option value="matic" {{ old('gearbox', $car->gearbox) == 'matic' ? 'selected' : '' }}>Matic</option>
                </select>
            </div>

            <div class="form-group">
                <label>Harga per Hari</label>
                <input type="number" name="price_per_day" class="form-control" value="{{ old('price_per_day', $car->price_per_day) }}" required>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="tersedia" {{ old('status', $car->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="disewa" {{ old('status', $car->status) == 'disewa' ? 'selected' : '' }}>Disewa</option>
                </select>
            </div>

            <div class="form-group full-width">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description', $car->description) }}</textarea>
            </div>

            <div class="form-group full-width">
                <label>Link Gambar Utama</label>
                <input type="text" name="main_image" class="form-control" value="{{ old('main_image', $car->main_image) }}" required>
            </div>

            <div class="form-group full-width">
                <label>Link Gambar Tambahan</label>
                <div id="image-url-wrapper">
                    @foreach (explode(',', old('image_urls', $car->images->pluck('image_url')->implode(','))) as $url)
                    <div class="image-url-group mb-2">
                        <input type="text" name="image_urls[]" class="form-control" value="{{ $url }}" placeholder="https://...">
                        <button type="button" class="btn btn-cancel" onclick="removeImageUrlField(this)">Hapus</button>
                    </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-secondary mt-2" onclick="addImageUrlField()">+ Tambah Link</button>
            </div>

        </div>

        <div class="form-actions">
            <a href="{{ route('dashboard.cars') }}" class="btn btn-cancel">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
