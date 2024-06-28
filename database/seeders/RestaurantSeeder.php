<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = config('Restaurant_db.restaurants');
        $count = 1;
        foreach ($restaurants as $restaurant) {            
            $new_restaurant = new Restaurant();
            $new_restaurant->user_id = $count++;
            $new_restaurant->address = $restaurant['address'];
            $new_restaurant->vat_number = $restaurant['vat_number'];
            $new_restaurant->name = $restaurant['name'];
            $new_restaurant->image = $restaurant['image'];
            $new_restaurant->description = $restaurant['description'];
            $new_restaurant->logo = $restaurant['logo'];
            $new_restaurant->slug = Restaurant::generateSlug($new_restaurant->name);
            $new_restaurant->save();

        }
    }
}
