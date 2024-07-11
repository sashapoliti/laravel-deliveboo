<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Http\Requests\StoreRegisterUserRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Restaurant;
use App\Models\Type;

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
    public function store(StoreRegisterUserRequest $request): RedirectResponse
    {
        // Creazione dell'utente
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
            'description' => $request->description,
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