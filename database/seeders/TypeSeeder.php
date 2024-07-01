<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = config('Type_db.types');
        foreach ($types as $type) {            
            $new_type = new Type();
            $new_type->name = $type['name'];
            $new_type->image = $type['image'];
            $new_type->slug = Type::generateSlug($new_type->name);
            $new_type->save();
        }
    }
}
