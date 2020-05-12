<?php

namespace App\Models;
use SoftDeletes;
class StoreHistory extends MyModel
{
    public $timestamps = false;
    
    protected $table = 'store_history';
    protected $primaryKey = 'store_history_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = [
        'datetime'
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
    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function action()
    {
        return $this->belongsTo('App\Models\ActionName');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function variant()
    {
        return $this->belongsTo('App\Models\Variant');
    }

    public function customBoxPrice()
    {
        return $this->belongsTo('App\Models\CustomBoxPrice');
    }
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
