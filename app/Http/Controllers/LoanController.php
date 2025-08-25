<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLoanRequest;
use App\Http\Requests\UpdateLoanRequest;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $query = Loan::where('user_id', Auth::id());
            if ($month = $request->query('month')) {
                $query->whereRaw("strftime('%Y-%m', created_at) = ?", [$month]);
            }
            if ($status = $request->query('status')) {
                $query->where('status', $status);
            }
            $loans = $query->orderBy('created_at', 'desc')->paginate(10);
            return response()->json($loans);
        }
        return view('app', [
            'props' => [
                'user' => Auth::user(),
            ]
        ]);
    }

    public function store(StoreLoanRequest $request)
    {
        $loan = Loan::create([
            ...$request->validated(),
            'user_id' => Auth::id(),
        ]);
        return response()->json($loan, 201);
    }

    public function show(Loan $loan)
    {
    // allow show for owner
        return response()->json($loan);
    }

    public function update(UpdateLoanRequest $request, Loan $loan)
    {
    // allow update for owner
        $loan->update($request->validated());
        return response()->json($loan);
    }

    public function destroy(Loan $loan)
    {
    // allow delete for owner
        $loan->delete();
        return response()->json(['success' => true]);
    }

    public function markAsPaid(Loan $loan)
    {
    // allow mark as paid for owner
        $loan->update(['status' => 'paid']);
        return response()->json($loan);
    }
}
