<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Cualquier empleado autenticado puede gestionar clientes.
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // 'sometimes' en unique para la actualización (cuando el email no cambia)
        $emailRule = 'required|string|email|max:255|unique:customers,email';
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $emailRule .= ',' . $this->route('customer')->id;
        }

        return [
            'name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'email' => $emailRule,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'is_active' => 'boolean',
        ];
    }
}
