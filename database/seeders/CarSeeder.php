<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                Car::create([
            'brand' => 'BMW',
            'model' => 'X5',
            'car_type' => 'SUV',
            'license_plate' => 'B 1234 VIP',
            'year' => 2021,
            'color' => 'Hitam',
            'seat' => 5,
            'gearbox' => 'matic',
            'price_per_day' => 1500000,
            'status' => 'tersedia',
            'description' => 'SUV mewah dengan kenyamanan premium dan tenaga kuat.',
            'main_image' => 'https://www.usnews.com/object/image/00000191-25b6-d8d6-a3fb-f5f6b8c60001/01-usnpx-2025bmwx5-angularfront-jmv.JPG?update-time=1722914668697&size=responsive640',
        ]);

        Car::create([
            'brand' => 'Mercedes-Benz',
            'model' => 'S-Class',
            'car_type' => 'Sedan',
            'license_plate' => 'B 9876 ELG',
            'year' => 2022,
            'color' => 'Silver',
            'seat' => 5,
            'gearbox' => 'matic',
            'price_per_day' => 2000000,
            'status' => 'disewa',
            'description' => 'Sedan elegan dengan fitur lengkap dan kenyamanan tinggi.',
            'main_image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRtyD8ep96F_mcX3l7OsIYzymj8O7S9013Xhg&s',
        ]);

        Car::create([
            'brand' => 'Tesla',
            'model' => 'Model S',
            'car_type' => 'Electric',
            'license_plate' => 'B 1122 TES',
            'year' => 2023,
            'color' => 'Putih',
            'seat' => 5,
            'gearbox' => 'matic',
            'price_per_day' => 2500000,
            'status' => 'tersedia',
            'description' => 'Mobil listrik futuristik dengan akselerasi cepat dan fitur autopilot.',
            'main_image' => 'https://teslamotorsclub.com/tmc/attachments/img_8598-jpg.709259/',
        ]);
    }
}
