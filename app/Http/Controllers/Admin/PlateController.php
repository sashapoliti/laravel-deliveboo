<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlateRequest;
use App\Http\Requests\UpdatePlateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurant = Auth::user()->restaurant;
        $plates = Plate::where('restaurant_id', $restaurant->id)->get();
        return view('admin.plates.index', compact('plates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.plates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $form_data = $request->all();
        $form_data['slug'] = Plate::generateSlug($form_data['name']);
        $form_data['restaurant_id'] = Auth::user()->restaurant->id;

        if ($request->hasFile('image')) {
            $name = $request->image->getClientOriginalName(); 
            $path = Storage::putFileAs('plate_images', $request->image, $name);
            $form_data['image'] = $path;
        }

        $newPlate = Plate::create($form_data);
        return redirect()->route('admin.plates.show', $newPlate->slug)->with('message', $newPlate->name . ' è stato creato');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plate $plate)
    {
        return view('admin.plates.show', compact('plate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plate $plate)
    {
        return view('admin.plates.edit', compact('plate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plate $plate)
    {
        $form_data = $request->all();
        $form_data['slug'] = Plate::generateSlug($form_data['name']);

        if ($request->hasFile('image')) {
            if ($plate->image) {
                Storage::delete($plate->image);
            }
            $name = $request->image->getClientOriginalName();
            $path = Storage::putFileAs('plate_images', $request->image, $name);
            $form_data['image'] = $path;
        }

        $plate->update($form_data);
        return redirect()->route('admin.plates.show', $plate->slug)->with('message', $plate->name . ' è stato modificato');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plate $plate)
    {
        if ($plate->image) {
            Storage::delete($plate->image);
        }
        $plate->delete();
        return redirect()->route('admin.plates.index')->with('message', $plate->name . ' è stato eliminato');
    }
}
