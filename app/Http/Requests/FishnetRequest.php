<?php

namespace App\Http\Requests;

use App\Enums\FishnetEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FishnetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'rfid' => 'required|string',
            'seller_id' => 'nullable|numeric',
            'customer_id' => 'nullable|numeric'
        ];
    }
}
