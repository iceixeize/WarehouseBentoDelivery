<?php

namespace App\Models;
use SoftDeletes;
use App\Scopes\DeletedScope;

class Packing extends MyModel
{
    // public $timestamps = false;
    const UPDATED_AT = 'date_last_update';

    protected $table = 'packing';
    protected $primaryKey = 'packing_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = []; // additional date attributes to convert columns to instances of Carbon, which extends the PHP
    protected $casts = [];
    protected $appends = []; // append value to JSON (Eloquent > Serialization)
    protected $hidden = []; // hiding attributes from JSON (Eloquent > Serialization)
    

    protected static function boot() {
        parent::boot();
        static::addGlobalScope(new DeletedScope);

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

    public function warehouseOrder() 
    {
        return $this->belongsTo('App\Models\WarehouseOrder');
    }

    public function boxes() 
    {
        return $this->belongsTo('App\Models\Boxes');
    }

    public function warehouse() 
    {
        return $this->belongsTo('App\Models\Warehouse');
    }

    public function store() 
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function paymentDoc() 
    {
        return $this->belongsTo('App\Models\PaymentDoc');
    }

    public function resendOrder() 
    {
        return $this->belongsTo('App\Models\ResendOrder');
    }

    public function customOrderShipping() 
    {
        return $this->belongsTo('App\Models\CustomOrderShipping');
    }

    public function paymentHistory()
    {
        return $this->belongsTo('App\Models\PaymentHistory');
    }

    public function warehouseOrderHistory()
    {
        return $this->hasMany('App\Models\WarehouseOrderHistory');
    }

    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
