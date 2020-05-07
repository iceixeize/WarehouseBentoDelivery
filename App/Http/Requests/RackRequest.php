<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RackRequest extends FormRequest
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
            // 'inputShelfName' => 'array',
            // 'selectShelfUnit' => 'array',
            // 'selectShelfType' => 'array',
            // 'inputShelfName.*' => 'required',
            // 'selectShelfUnit.*' => 'required',
            // 'selectShelfType.*' => 'required',
            'rackNo' => 'required|unique:rack,rack_no,NULL,id,deleted_at,NULL',
            'shelfAmount' => 'required',
        ];

        if($this->request->has('inputShelfName')) {
            foreach($this->request->get('inputShelfName') as $index => $val) {
                
                $input = $this->request->get('inputShelfName');

                if($val == null && empty($this->request->get('inputShelfName')[$index])) {
                    $arrayRequired['inputShelfName.' . $index] = 'required|min:1';
                }
            }
        }


        if($this->request->has('selectShelfUnit')) {
            foreach($this->request->get('selectShelfUnit') as $index => $val) {
                $input = $this->request->get('selectShelfUnit');

                if($val == null && empty($this->request->get('selectShelfUnit')[$index])) {
                    $arrayRequired['selectShelfUnit.' . $index] = 'required|min:1';
                }
            }
        }

        if($this->request->has('selectShelfType')) {
            foreach($this->request->get('selectShelfType') as $index => $val) {
                $input = $this->request->get('selectShelfType');
                if($val == null && empty($this->request->get('selectShelfType')[$index])) {
                    $arrayRequired['selectShelfType.' . $index] = 'required|min:1';
                }
            }
        }
// dd(['require' => $arrayRequired]);
        return $arrayRequired;
    }
}
