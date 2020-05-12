<?php

namespace App\Models;
use SoftDeletes;
class TempPackingTask extends MyModel
{
    public $timestamps = false;
    
    protected $table = 'temp_packing_task';
    protected $primaryKey = 'temp_packing_task_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = [
        'date_create',
    ]; // additional date attributes to convert columns to instances of Carbon, which extends the PHP
    protected $casts = [
        'scanned_box' => 'array',
    ];
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
    public function warehouseOrder()
    {
        return $this->belongsTo('App\Models\WarehouseOrder');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function warehouseLocation()
    {
        return $this->belongsTo('App\Models\WarehouseLocation');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }

    public function shippingCountry()
    {
        return $this->belongsTo('App\Models\Country', 'country_id', 'shipping_country_id');
    }

    public function resendOrder()
    {
        return $this->belongsTo('App\Models\ResendOrder');
    }

    public function selectShippingProvider()
    {
        return $this->belongsTo('App\Models\ShippingProvider', 'shipping_provider_id', 'select_shipping_provider_id');
    }

    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
