<?php

namespace App\Http\Requests\EKhairat;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMembershipRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => ['required', 'string', 'max:255'],
            'ic' => ['required', 'string', 'regex:/^\d{6}-\d{2}-\d{4}$/'], 
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required' , 'regex:/^\d{10,15}$/'],
            'emergency_no' => ['required', 'regex:/^\d{10,15}$/'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'tanggungans.*.fullname' => ['required', 'string', 'max:255'],
            'tanggungans.*.ic' => ['required', 'string','regex:/^\d{6}-\d{2}-\d{4}$/'], 
            'tanggungans.*.relationship' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'ic.regex' => 'Sila masukkan nombor NRIC yang sah',
            'phone.regex' => 'Sila masukkan nombor telefon yang sah',
            'emergency_no.regex' => 'Sila masukkan nombor kecemasan yang sah',
            'tanggungans.*.ic.regex' => 'Sila masukkan nombor NRIC yang sah',
        ];
    }
}
