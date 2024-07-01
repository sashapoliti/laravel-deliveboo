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
        return view('admin.restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReastaurantRequest $request)
    {
        // Valida i dati e li assegna a $from_data
        $from_data = $request->validated();
        
        // Genera lo slug e lo aggiunge ai dati
        $from_data['slug'] = Restaurant::generateSlug($from_data['name']);
        
        // Assegna l'ID dell'utente autenticato ai dati del ristorante
        $from_data['user_id'] = Auth::user()->id;
    
        // Gestisce il caricamento dell'immagine
        if ($request->hasFile('image')) {
            $name = $request->image->getClientOriginalName(); 
            $path = Storage::putFileAs('post_images', $request->image, $name);
            $from_data['image'] = $path;
        }
    
        // Gestisce il caricamento del logo
        if ($request->hasFile('logo')) {
            $name = $request->logo->getClientOriginalName(); 
            $path = Storage::putFileAs('post_images', $request->logo, $name);
            $from_data['logo'] = $path;
        }
    
        // Crea il nuovo ristorante
        $newRestaurant = Restaurant::create($from_data);
        
        // Reindirizza alla lista dei ristoranti con un messaggio di successo
        return redirect()->route('admin.restaurants.index')->with('message', $newRestaurant->name . ' è stato creato');
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
        if ($restaurant->image) {
            Storage::delete($restaurant->image);
        }
        $restaurant->delete();
        return redirect()->route('admin.restaurants.index')->with('message', $restaurant->name . ' è stato eliminato');
    }
}
