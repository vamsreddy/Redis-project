<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redis;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:20'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'regex:/^[6-9][0-9]{9}$/'],
            'place' => ['required'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->hasDuplicates()) {
                $validator->errors()->add('email', 'The email or phone number is not unique.');
            }
        });
    }

    private function hasDuplicates(): bool
    {
        $email = $this->input('email');
        $phone = $this->input('phone');

        $records = Redis::hvals('employee_data');
        foreach ($records as $record) {
            $data = json_decode($record, true);
            if ($data['email'] === $email || $data['phone'] === $phone) {
                return true; // Not unique
            }
        }

        return false; // Unique
    }
}
