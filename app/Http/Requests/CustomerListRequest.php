<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class CustomerListRequest extends FormRequest
{

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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'country' => [Rule::in(['Morocco','Cameroon','Uganda','Mozambique','Ethiopia','All'])],
            'valid' => [Rule::in(['yes','no','all'])]
        ];
    }

    /**
     * Failed Validation Response
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        if ($validator->fails()) {
            throw new HttpResponseException(new JsonResponse($validator->errors()->all(),422));
        }
    }

    protected function prepareForValidation()
    {
        $request = $this->request->all();
        if(!empty($request['country']) && $request['country']=='All'){
            unset($request['country']);
        }
        $this->replace($request);
    }
}
