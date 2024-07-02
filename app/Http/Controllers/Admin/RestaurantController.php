<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Requests\StoreReastaurantRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $restaurants = Restaurant::where('user_id', $user->id)->get();
        return view('admin.restaurants.index', compact('restaurants'));
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
    public function store(StoreReastaurantRequest $request)
    {
       //
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        // Implementazione di visualizzazione, se necessario
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        // Implementazione di modifica, se necessario
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        // Implementazione di aggiornamento, se necessario
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        if ($restaurant->image) {
            Storage::delete($restaurant->image);
        }
        if ($restaurant->logo) {
            Storage::delete($restaurant->logo);
        }
        $restaurant->delete();
        return redirect()->route('admin.restaurants.index')->with('message', $restaurant->name . ' è stato eliminato');
    }
}
