<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MyModel extends Model
{
    protected $currencyInstance;

	public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    /*
    |--------------------------------------------------
    | Function
    |--------------------------------------------------
    */

    

    /*
    |--------------------------------------------------
    | Static
    |--------------------------------------------------
    */

    

    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */

    protected function getFormat($value, $decimalPlace = 2) {
        return number_format($value, $decimalPlace);
    }
}