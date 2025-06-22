<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
    'brand', 'model', 'car_type', 'license_plate', 'year', 'color',
    'seat', 'gearbox', 'price_per_day', 'status', 'description', 'main_image',
    ];


    public function images()
    {
        return $this->hasMany(CarImage::class);
    }

}
