<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Requests\StoreReastaurantRequest;
use App\Http\Controllers\Controller;


class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('admin.restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReastaurantRequest $request)
    {
        $from_data = $request->validated();
        $from_data['slug'] = Restaurant::generateSlug($from_data['name']);
        $newRestaurant = Restaurant::create($from_data);
        return redirect()->route('admin.restaurants.index', $newRestaurant->slug)->with('message', $newRestaurant->name . ' è stato creato');
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        //no!
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        //no!
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //no!
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return redirect()->route('admin.restaurants.index')->with('message', $restaurant->name . ' è stato eliminato');
    }
}
