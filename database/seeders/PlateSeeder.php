<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plate;

class PlateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plates = config('Plate_db.plates');
        foreach ($plates as $plate) {            
            $new_plate = new Plate();
            $new_plate->name = $plate['name'];
            $new_plate->description = $plate['description'];
            $new_plate->visibility = $plate['visibility'];
            $new_plate->price = $plate['price'];
            $new_plate->image = $plate['image'];
            $new_plate->restaurant_id = $plate['restaurant_id'];
            $new_plate->slug = Plate::generateSlug($new_plate->name);
            $new_plate->save();
        }
    }
}
