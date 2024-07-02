<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $types = Type::all();
        return view('auth.register', compact('types'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            // Validazione dei campi utente
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
    
            // Validazione dei campi ristorante
            'restaurant_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'vat_number' => ['required', 'string', 'max:50'],
            'image' => ['nullable', 'image', 'max:2048'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'types' => ['required', 'array', 'min:1'],
            'types.*' => ['exists:types,id'],
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        event(new Registered($user));
    
        Auth::login($user);
    
        // Creazione del ristorante associato all'utente
        $form_data = [
            'name' => $request->restaurant_name,
            'slug' => Restaurant::generateSlug($request->restaurant_name),
            'address' => $request->address,
            'vat_number' => $request->vat_number,
            'user_id' => $user->id,
        ];
    
        if ($request->hasFile('image')) {
            $name = $request->image->getClientOriginalName();
            $path = Storage::putFileAs('post_images', $request->image, $name);
            $form_data['image'] = $path;
        }
    
        if ($request->hasFile('logo')) {
            $name = $request->logo->getClientOriginalName();
            $path = Storage::putFileAs('post_images', $request->logo, $name);
            $form_data['logo'] = $path;
        }
    
        $newRestaurant = Restaurant::create($form_data);
    
        if ($request->has('types')) {
            $newRestaurant->types()->attach($request->types);
        }
    
        return redirect(RouteServiceProvider::HOME)->with('message', 'Registration successful and restaurant created.');
    }
    
    
}
