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
        $plates = Plate::where('restaurant_id', $restaurant->id)
            ->orderBy('name', 'asc') // Ordina per il campo 'name' in ordine alfabetico ascendente
            ->get();
        
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
    public function store(StorePlateRequest $request)
    {
        $form_data = $request->validated();
        $form_data['slug'] = Plate::generateSlug($form_data['name']);
        $form_data['restaurant_id'] = Auth::user()->restaurant->id;

        // Gestisce il caricamento dell'immagine
        if ($request->hasFile('image')) {
            $imagePath = $this->handleFileUpload($request->file('image'), 'plate_images');
            $form_data['image'] = $imagePath;
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
    public function update(UpdatePlateRequest $request, Plate $plate)
    {
        $form_data = $request->validated();
        $form_data['slug'] = Plate::generateSlug($form_data['name']);

        // Gestisce il caricamento dell'immagine
        if ($request->hasFile('image')) {
            // Rimuove l'immagine precedente se presente
            if ($plate->image) {
                Storage::delete($plate->image);
            }

            // Carica la nuova immagine
            $imagePath = $this->handleFileUpload($request->file('image'), 'plate_images');
            $form_data['image'] = $imagePath;
        }

        $plate->update($form_data);
        return redirect()->route('admin.plates.show', $plate->slug)->with('message', $plate->name . ' è stato modificato');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plate $plate)
    {
        // Rimuove l'immagine associata al piatto se presente
        if ($plate->image) {
            Storage::delete($plate->image);
        }

        $plate->delete();
        return redirect()->route('admin.plates.index')->with('message', $plate->name . ' è stato eliminato');
    }

    /**
     * Gestisce il caricamento del file e restituisce il percorso del file caricato.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $directory
     * @return string
     */
    private function handleFileUpload($file, $directory)
    {
        // Genera un nome di file unico
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        
        // Carica il file nella directory specificata
        try {
            $path = Storage::putFileAs($directory, $file, $filename);
        } catch (\Exception $e) {
            // Gestisce eventuali errori durante il caricamento
            throw new \Exception('Errore durante il caricamento del file: ' . $e->getMessage());
        }

        return $path;
    }
}
