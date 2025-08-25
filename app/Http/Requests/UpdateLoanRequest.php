<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateLoanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();

        // return auth()->check();
    }

    public function rules(): array
    {
        return [
            'type' => 'required|in:borrowed,given',
            'person' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'status' => 'in:pending,paid',
            'due_date' => 'nullable|date',
            'description' => 'nullable|string',
        ];
    }
}
