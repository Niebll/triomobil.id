<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\CarImage;
class CarImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
$images = [
    1 => [ // car_id 1 (x5)
        'https://hips.hearstapps.com/hmg-prod/images/p90495464-1677001974.jpg?crop=0.720xw:0.608xh;0.250xw,0.329xh&resize=1200:*',
        'https://awsimages.detik.net.id/community/media/visual/2023/10/15/new-bmw-x5_169.jpeg?w=1200',
        'https://engineroom.nl/wp-content/uploads/2024/06/BMW-X-X-e-1-32.jpg',
    ],
    2 => [ // car_id 2 (s class)
                'https://i.ytimg.com/vi/nnqIkYpB1L0/maxresdefault.jpg',
                'https://imgcdn.oto.com/large/gallery/exterior/25/204/mercedes-benz-s-class-front-angle-low-view-127879.jpg',
                'https://www.chasingcars.com.au/wp-content/uploads/2020/09/Mercedes-Benz-S-Class-2021-3-1024x576.jpg',

    ],
    3 => [ // car_id 3 (model s)
                'https://media.carsandbids.com/cdn-cgi/image/width=2080,quality=70/1477bbe21e8d6b5e719c7c3ccab577fd47dd8cc3/photos/KZQ8aqm3-RkBpY7QDXO-(edit).jpg?t=168107725614',
                'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTvFDrCYqr_h1NPHhEd93vKbyD-HSfbwhgVRg&s',
                'https://images.squarespace-cdn.com/content/v1/5b2437bcc3c16a6fea91cd4d/1529295195083-1IC5SKFIU1UPE3JACOFR/IMG_3938.jpg?format=1000w',
    ],
];

foreach ($images as $car_id => $urls) {
    foreach ($urls as $url) {
        CarImage::create([
            'car_id' => $car_id,
            'image_url' => $url,
        ]);
    }
}
    }
}
