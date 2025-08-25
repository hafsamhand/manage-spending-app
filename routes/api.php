<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\DashboardController;

// Route::middleware('auth:web')->group(function () {
    // Expenses
    Route::get('/expenses', [ExpenseController::class, 'index']);
    Route::post('/expenses', [ExpenseController::class, 'store']);
    Route::get('/expenses/{expense}', [ExpenseController::class, 'show']);
    Route::put('/expenses/{expense}', [ExpenseController::class, 'update']);
    Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy']);

    // Loans
    Route::get('/loans', [LoanController::class, 'index']);
    Route::post('/loans', [LoanController::class, 'store']);
    Route::get('/loans/{loan}', [LoanController::class, 'show']);
    Route::put('/loans/{loan}', [LoanController::class, 'update']);
    Route::delete('/loans/{loan}', [LoanController::class, 'destroy']);
    Route::patch('/loans/{loan}/mark-as-paid', [LoanController::class, 'markAsPaid']);

    // Dashboard stats
    Route::get('/stats', [DashboardController::class, 'stats']);
    Route::get('/stats/expenses-by-category', [DashboardController::class, 'expensesByCategory']);
// });
