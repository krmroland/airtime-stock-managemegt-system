<?php

namespace App\Http\Requests;

use App\Traits\CommonValidationRules;
use Illuminate\Foundation\Http\FormRequest;

class FielderRequest extends FormRequest
{
    use CommonValidationRules;


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * customrules
     *
     * @return     array  
     */
    public function otherRulles()
    {
        return [
            "saving"=>"required|array",
            "stock"=>"required|array"
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->prepareRules("fielders");
    }
}
