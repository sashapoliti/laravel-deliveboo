<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Order;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $restaurants = Restaurant::where('user_id', $user->id)->get();
        $orders = Order::where('restaurant_id', $user->restaurant->id)->get();

        // Ottieni il primo ordine
        $firstOrder = Order::where('restaurant_id', $user->restaurant->id)
            ->orderBy('created_at', 'asc')
            ->first();

        if ($firstOrder) {
            $startMonth = Carbon::parse($firstOrder->created_at)->startOfMonth();
        } else {
            $startMonth = Carbon::now()->startOfMonth();
        }

        $endMonth = $startMonth->copy()->addMonths(11)->endOfMonth();

        $monthlyData = Order::where('restaurant_id', $user->restaurant->id)
            ->whereBetween('created_at', [$startMonth, $endMonth])
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_price) as total_profit'),
                DB::raw('COUNT(*) as order_count')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        return view('admin.dashboard', compact('restaurants', 'orders', 'monthlyData', 'startMonth'));
    }
}

