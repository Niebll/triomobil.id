<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\CarImage;


class CarController extends Controller
{
    
public function postCar(Request $request): RedirectResponse
{
    $validated = $request->validate([
        'brand' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'car_type' => 'required|string|max:255',
        'license_plate' => 'required|string|max:50',
        'year' => 'required|integer|min:1990|max:' . date('Y'),
        'color' => 'required|string|max:50',
        'price_per_day' => 'required|integer|min:0',
        'status' => 'required|in:tersedia,disewa',
        'gearbox' => 'required|in:manual,matic',
        'seat' => 'required|integer|min:1',
        'description' => 'nullable|string',
        'main_image' => 'required|string|max:2048', // Tidak pakai 'url'
        'image_urls' => 'array',
        'image_urls.*' => 'nullable|string|max:2048', // Tidak pakai 'url'
    ]);

    // Simpan mobil ke database
    $car = Car::create([
        'brand' => $validated['brand'],
        'model' => $validated['model'],
        'car_type' => $validated['car_type'],
        'license_plate' => $validated['license_plate'],
        'year' => $validated['year'],
        'color' => $validated['color'],
        'price_per_day' => $validated['price_per_day'],
        'status' => $validated['status'],
        'gearbox' => $validated['gearbox'],
        'seat' => $validated['seat'],
        'description' => $validated['description'] ?? null,
        'main_image' => $validated['main_image'],
    ]);

    // Simpan gambar tambahan (jika ada)
    if (!empty($validated['image_urls'])) {
        foreach ($validated['image_urls'] as $url) {
            if ($url) {
                $car->images()->create(['image_url' => $url]);
            }
        }
    }

    return redirect()->route('dashboard.cars')->with('success', 'Mobil baru berhasil ditambahkan.');
}



    public function getAllCar(Request $request)
    {
    $query = Car::query();

    // Filter by search keyword
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('brand', 'like', "%$search%")
              ->orWhere('model', 'like', "%$search%")
              ->orWhere('license_plate', 'like', "%$search%");
        });
    }

    // Filter by status
    if ($request->has('status') && $request->status != '') {
        $query->where('status', $request->status); // Pastikan 'status' adalah field valid di database
    }

    $cars = $query->paginate(9);
        
        return view('user.car', compact('cars'));
    }

    public function getBestCar()
    {
        $cars = Car::where('status', 'tersedia')->orderBy('created_at', 'desc')->take(3)->get();
        return view('user.home', compact('cars'));
    }



    public function getSearchCarAdmin(Request $request)
    {
        // Mulai query builder
        $query = Car::query();

        // 1. Logika untuk Pencarian (Search)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('brand', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%")
                  ->orWhere('license_plate', 'like', "%{$search}%");
            });
        }

        // 2. Logika untuk Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // 3. Ambil data dengan paginasi
        // withQueryString() penting agar parameter filter/search tidak hilang saat pindah halaman
        $cars = $query->orderBy('id', 'desc')->paginate(8)->withQueryString();

        return view('admin.dashboard.car_management', compact('cars'));
    }


    public function getDashboardAdmin()
    {
        // 1. Ambil data untuk kartu statistik
        $totalCars = Car::count();
        $availableCars = Car::where('status', 'tersedia')->count();
        // Menghitung mobil yang disewa dari total dikurangi yang tersedia
        $rentedCars = $totalCars - $availableCars;

        // 2. [PERUBAHAN] Ambil 3 mobil terbaru
        $latestCars = Car::latest()->take(3)->get();

        // 3. Kirim semua data yang relevan ke view
        return view('admin.dashboard.dashboard', compact(
            'totalCars',
            'availableCars',
            'rentedCars', // Variabel baru
            'latestCars'  // Variabel baru
        ));
    }

    public function showCreateCar(): View
    {
        return view('admin.cars.create');
    }

    public function updateCar(Request $request, Car $car): RedirectResponse
{
    $validated = $request->validate([
        'brand' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'car_type' => 'required|string|max:255',
        'license_plate' => 'required|string|max:50',
        'year' => 'required|integer|min:1990|max:' . date('Y'),
        'color' => 'required|string|max:50',
        'price_per_day' => 'required|integer|min:0',
        'status' => 'required|in:tersedia,disewa',
        'gearbox' => 'required|in:manual,matic',
        'seat' => 'required|integer|min:1',
        'description' => 'nullable|string',
        'main_image' => 'required|string|max:2048',
        'image_urls' => 'array',
        'image_urls.*' => 'nullable|string|max:2048',
    ]);

    // Update data mobil
    $car->update([
        'brand' => $validated['brand'],
        'model' => $validated['model'],
        'car_type' => $validated['car_type'],
        'license_plate' => $validated['license_plate'],
        'year' => $validated['year'],
        'color' => $validated['color'],
        'price_per_day' => $validated['price_per_day'],
        'status' => $validated['status'],
        'gearbox' => $validated['gearbox'],
        'seat' => $validated['seat'],
        'description' => $validated['description'] ?? null,
        'main_image' => $validated['main_image'],
    ]);

    // Hapus gambar lama dan simpan ulang gambar tambahan (opsional)
    $car->images()->delete();
    if (!empty($validated['image_urls'])) {
        foreach ($validated['image_urls'] as $url) {
            if ($url) {
                $car->images()->create(['image_url' => $url]);
            }
        }
    }

    return redirect()->route('dashboard.cars')->with('success', 'Data mobil berhasil diperbarui.');
}

    public function showEditCar(Car $car): View
    {
        return view('admin.cars.edit', compact('car'));
    }


    public function deleteCar($id)
{
    $car = Car::findOrFail($id);
    $car->delete();

    return redirect()->route('dashboard.cars')->with('success', 'Mobil berhasil dihapus.');
    }
}

