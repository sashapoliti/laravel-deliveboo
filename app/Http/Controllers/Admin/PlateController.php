<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlateRequest;
use App\Http\Requests\UpdatePlateRequest;

class PlateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plates = Plate::all();
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
    public function store(StorePlateRequest  $request)
    {
        $from_data = $request->validated();
        $from_data['slug'] = Plate::generateSlug($from_data['name']);
        $newPlate = Plate::create($from_data);
        return redirect()->route('admin.plates.index', $newPlate->slug)->with('message', $newPlate->name . ' è stato creato');
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
    public function update(UpdatePlateRequest  $request, Plate $plate)
    {
        $from_data = $request->validated();
        $from_data['slug'] = Plate::generateSlug($from_data['name']);
        $plate->update($from_data);
        return redirect()->route('admin.plates.index', $plate->slug)->with('message', $plate->name . ' è stato modificato');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plate $plate)
    {
        $plate->delete();
        return redirect()->route('admin.plates.index')->with('message', $plate->name . ' è stato eliminato');
    }
}
