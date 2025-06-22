<!DOCTYPE html>
<html>
<head>
    <title>Detail Mobil</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        td { padding: 8px; border-bottom: 1px solid #ccc; }
        .label { font-weight: bold; width: 30%; }
    </style>
</head>
<body>
    <h2>Detail Mobil</h2>
    <table>
        <tr>
            <td class="label">Brand</td>
            <td>{{ $car->brand }}</td>
        </tr>
        <tr>
            <td class="label">Model</td>
            <td>{{ $car->model }}</td>
        </tr>
        <tr>
            <td class="label">Tipe Mobil</td>
            <td>{{ $car->car_type }}</td>
        </tr>
        <tr>
            <td class="label">Plat Nomor</td>
            <td>{{ $car->license_plate }}</td>
        </tr>
        <tr>
            <td class="label">Tahun</td>
            <td>{{ $car->year }}</td>
        </tr>
        <tr>
            <td class="label">Warna</td>
            <td>{{ $car->color }}</td>
        </tr>
        <tr>
            <td class="label">Jumlah Kursi</td>
            <td>{{ $car->seat }}</td>
        </tr>
        <tr>
            <td class="label">Transmisi</td>
            <td>{{ ucfirst($car->gearbox) }}</td>
        </tr>
        <tr>
            <td class="label">Harga per Hari</td>
            <td>Rp{{ number_format($car->price_per_day, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="label">Status</td>
            <td>{{ ucfirst($car->status) }}</td>
        </tr>
    </table>
</body>
</html>
