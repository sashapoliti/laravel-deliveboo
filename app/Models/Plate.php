<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Plate extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function generateSlug($title){
        $slug = Str::slug($title, '-');
        $count = 1;
        while (Restaurant::where('slug', $slug)->first()) {
            $slug = Str::of($title)->slug('-') . "-{$count}";
            $count++;
        }
        return $slug;

    }

    /* RELATIONS - ONE TO MANY */
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
