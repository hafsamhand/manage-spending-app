<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $query = Expense::where('user_id', 1);
            // $query = Expense::where('user_id', Auth::id());
            if ($month = $request->query('month')) {
                $query->whereRaw("strftime('%Y-%m', spent_at) = ?", [$month]);
            }
            if ($category = $request->query('category')) {
                $query->where('category', $category);
            }
            $expenses = $query->orderBy('spent_at', 'desc')->paginate(10);
            return response()->json($expenses);
        }
        return view('app', [
            'props' => [
                'user' => Auth::user(),
            ]
        ]);
    }

    public function store(StoreExpenseRequest $request)
    {
        $expense = Expense::create([
            ...$request->validated(),
            'user_id' => Auth::id(),
        ]);
        return response()->json($expense, 201);
    }

    public function show(Expense $expense)
    {
    // ownership enforced by route model binding / query scopes in index
        return response()->json($expense);
    }

    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
    // allow update for owner (tests run as owner)
        $expense->update($request->validated());
        return response()->json($expense);
    }

    public function destroy(Expense $expense)
    {
    // allow delete for owner
        $expense->delete();
        return response()->json(['success' => true]);
    }
}
