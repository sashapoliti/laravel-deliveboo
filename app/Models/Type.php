<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Illuminate\Support\Str;

class Type extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function generateSlug($title){
        $slug = Str::slug($title, '-');
        $count = 1;
        while (Type::where('slug', $slug)->first()) {
            $slug = Str::of($title)->slug('-') . "-{$count}";
            $count++;
        }
        return $slug;

    }
    public function restaurants(): BelongsToMany
    {
        return $this->belongsToMany(Restaurant::class, 'restaurant_type', 'type_id', 'restaurant_id');
    }
}
