<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Models\Type;
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
        $types = Type::all();
        return view('admin.restaurants.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
    */
    public function store(StoreReastaurantRequest $request)
    {
        // Valida i dati e li assegna a $form_data
        $form_data = $request->validated();
    
        // Genera lo slug e lo aggiunge ai dati
        $form_data['slug'] = Restaurant::generateSlug($form_data['name']);
    
        // Assegna l'ID dell'utente autenticato ai dati del ristorante
        $form_data['user_id'] = Auth::user()->id;
    
        // Gestisce il caricamento dell'immagine
        if ($request->hasFile('image')) {
            $name = $request->image->getClientOriginalName();
            $path = Storage::putFileAs('post_images', $request->image, $name);
            $form_data['image'] = $path;
        }
    
        // Gestisce il caricamento del logo
        if ($request->hasFile('logo')) {
            $name = $request->logo->getClientOriginalName();
            $path = Storage::putFileAs('post_images', $request->logo, $name);
            $form_data['logo'] = $path;
        }
        
        // Crea il nuovo ristorante
        $newRestaurant = Restaurant::create([
            'name' => $form_data['name'],
            'slug' => $form_data['slug'],
            'address' => $form_data['address'],
            'vat_number' => $form_data['vat_number'],
            'user_id' => $form_data['user_id'],
        ]);
    
        // Gestisce l'associazione con i tipi di ristorante selezionati
        if ($request->has('types')) {
            $newRestaurant->types()->attach($request->types);
        }
    
        // Reindirizza alla lista dei ristoranti con un messaggio di successo
        return redirect()->route('admin.restaurants.index')->with('message', $newRestaurant->name . ' è stato creato');
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
