<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $restaurants = Restaurant::where('user_id', $user->id)->get();
        return view('admin.dashboard',compact('restaurants'));
    }
}
