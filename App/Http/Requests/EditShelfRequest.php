<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditShelfRequest extends FormRequest
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
        ];

        if($this->request->has('shelfNo')) {
            foreach($this->request->get('shelfNo') as $index => $val) {
                
                $input = $this->request->get('shelfNo');

                if($val == null && empty($this->request->get('shelfNo')[$index])) {
                    $arrayRequired['shelfNo.' . $index] = 'required';
                }
            }
        }

        if($this->request->has('selectShelfType')) {
            foreach($this->request->get('selectShelfType') as $index => $val) {
                $input = $this->request->get('selectShelfType');

                if($val == null && empty($this->request->get('selectShelfType')[$index])) {
                    $arrayRequired['selectShelfType.' . $index] = 'required|min:0';
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

        // if($this->request->has('shelfId')) {
        //     $count = $this->request->get('selectShelfUnit');
        //     if(count($this->request->get('selectShelfUnit')) != $count 
        //     || count($this->request->get('shelfNo')) != $count 
        //     || count($this->request->get('selectShelfType')) != $count) {

        //     }
        // }
// dd(['require' => $arrayRequired]);
        return $arrayRequired;
    }
}
