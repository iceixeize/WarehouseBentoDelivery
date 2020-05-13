<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrintSubshelfRequest extends FormRequest
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
        $arrayRequired = [
            'colStart' => 'required|numeric|min:0',
            'rowStart' => 'required|numeric|min:0',

        ];

        if($this->request->has('selectSubshelf')) {
            foreach($this->request->get('selectSubshelf') as $index => $val) {
                $input = $this->request->get('selectSubshelf');

                if($val == null && empty($this->request->get('selectSubshelf')[$index])) {
                    $arrayRequired['selectSubshelf.' . $index] = 'required';
                }
            }
        }

        
        return $arrayRequired;
    }
}
