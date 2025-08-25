<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Loan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return view('app', [
            'props' => [
                'user' => $request->user(),
            ]
        ]);
    }

    public function stats(Request $request)
    {
        $user = $request->user();
        $month = Carbon::now()->format('Y-m');
        // Use SQLite-safe strftime for tests running on sqlite
        $totalSpent = Expense::where('user_id', $user->id)
            ->whereRaw("strftime('%Y-%m', spent_at) = ?", [$month])
            ->sum('amount');

        $totalBorrowed = Loan::where('user_id', $user->id)
            ->where('type', 'borrowed')
            ->where('status', 'pending')
            ->sum('amount');

        $totalGiven = Loan::where('user_id', $user->id)
            ->where('type', 'given')
            ->where('status', 'pending')
            ->sum('amount');

        return response()->json([
            'totalSpent' => $totalSpent,
            'totalBorrowed' => $totalBorrowed,
            'totalGiven' => $totalGiven,
        ]);
    }

    public function expensesByCategory(Request $request)
    {
        $user = $request->user();
        $month = Carbon::now()->format('Y-m');
        $data = Expense::where('user_id', $user->id)
            ->whereRaw("strftime('%Y-%m', spent_at) = ?", [$month])
            ->selectRaw('category, SUM(amount) as total')
            ->groupBy('category')
            ->get();

        return response()->json($data);
    }
}
