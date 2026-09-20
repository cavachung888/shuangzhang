<?php

namespace InnoCMS\Panel\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CopperPriceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'price_date'   => 'required|date',
            'market'       => 'required|in:ccmn,smm,lme',
            'copper_price' => 'required|numeric|min:0',
            'currency'     => 'required|in:cny,usd',
        ];
    }
}
