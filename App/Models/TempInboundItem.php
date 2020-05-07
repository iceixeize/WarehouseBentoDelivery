<?php

namespace App\Models;
use SoftDeletes;
class TempInboundItem extends MyModel
{
    public $timestamps = false;
    
    protected $table = 'temp_inbound_item';
    protected $primaryKey = 'temp_inbound_item_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = []; // additional date attributes to convert columns to instances of Carbon, which extends the PHP
    protected $casts = [
        'serial_list' => 'array',
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
    public function receiveReceipt()
    {
        return $this->belongsTo('App\Models\ReceiveReceipt');
    }

    public function outboundTask()
    {
        return $this->belongsTo('App\Models\OutboundTask');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function description()
    {
        return $this->belongsTo('App\Models\Description');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function variant()
    {
        return $this->belongsTo('App\Models\Variant');
    }

    public function lotProduct()
    {
        return $this->belongsTo('App\Models\LotProduct');
    }

    public function warehouseLocation()
    {
        return $this->belongsTo('App\Models\WarehouseLocation', 'warehouse_location_id', 'location_id');
    }
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
