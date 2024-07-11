<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $types = $request->input('type', []);
    $perPage = 5; // Numero di ristoranti per pagina

    $restaurants = Restaurant::with('plates', 'types')
        ->whereHas('types', function ($query) use ($types) {
            $query->whereIn('type_id', $types);
        });

    $restaurants = $restaurants->withCount([
        'types' => function ($query) use ($types) {
            $query->whereIn('type_id', $types);
        }
    ])->having('types_count', '=', count($types))
    ->paginate($perPage);

    return response()->json([
        'status' => 'success',
        'message' => 'Restaurants retrieved successfully',
        'results' => $restaurants->items(),
        'current_page' => $restaurants->currentPage(),
        'last_page' => $restaurants->lastPage(),
        'total' => $restaurants->total(),
    ], 200);
}

    

    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->with('plates', 'types')->first();

        if (!$restaurant) {
            return response()->json(['message' => 'Restaurant not found'], 404);
        }

        return response()->json($restaurant);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
