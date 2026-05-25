<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function getStats(): JsonResponse
    {
        return response()->json([
            'totalProducts'  => Product::count(),
            'pendingOrders'  => Order::where('status', 'pending')->count(),
            'totalCustomers' => User::count(), 
            'totalExpenses'  => Expense::sum('amount'), // Backend database calculates this instantly!
        ]);
    }
}