<?php

namespace App\Models;
use SoftDeletes;
class WarehouseLogError extends MyModel
{
    public $timestamps = false;
    
    protected $table = 'warehouse_log_error';
    protected $primaryKey = 'warehouse_log_error_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = [
        'date_created'
    ]; // additional date attributes to convert columns to instances of Carbon, which extends the PHP
    protected $casts = [];
    protected $appends = []; // append value to JSON (Eloquent > Serialization)
    protected $hidden = []; // hiding attributes from JSON (Eloquent > Serialization)
    

    protected static function boot() {
        parent::boot();

        static::created(function ($model) {
            
        });
        static::updated(function ($model) {
            
        });
        static::deleted(function ($model) {
            
        });
    }

    /*
    |--------------------------------------------------
    | Cache
    |--------------------------------------------------
    */



    /*
    |--------------------------------------------------
    | Static
    |--------------------------------------------------
    */



    /*
    |--------------------------------------------------
    | Function
    |--------------------------------------------------
    */


    
    /*
    |--------------------------------------------------
    | Get
    |--------------------------------------------------
    */



    /*
    |--------------------------------------------------
    | Set
    |-------------------------------------------------
    */



    /*
    |--------------------------------------------------
    | Scope
    |--------------------------------------------------
    */



    /*
    |--------------------------------------------------
    | Relation
    |--------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
