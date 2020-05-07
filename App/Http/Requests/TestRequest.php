<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
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
        // dd(['test_validate']);
        $arrayRequired = [
            'test' => 'array',
            'test.*' => 'required',
        ];

        if($this->request->has('test')) {
            foreach($this->request->get('test') as $index => $val) {
                
                $input = $this->request->get('test');

                if($val == null && empty($this->request->get('test')[$index])) {
                    $arrayRequired['test.' . $index] = 'required|min:1';
                }
            }
        }

        return $arrayRequired;
    }
}
