<?php

namespace App\Models;
use SoftDeletes;
class SerialNumberHistory extends MyModel
{
    public $timestamps = false;
    
    protected $table = 'serial_number_history';
    protected $primaryKey = 'serial_number_history_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = [
        'date_create',
        'date_modified',
        'date_import',
        'date_export',
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
    public function variant()
    {
        return $this->belongsTo('App\Models\Variant');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product'); 
    }

    public function lotProduct()
    {
        return $this->belongsTo('App\Models\LotProduct');
    }

    public function warehouseOrder()
    {
        return $this->belongsTo('App\Models\WarehouseOrder'); 
    }

    public function resendOrder()
    {
        return $this->belongsTo('App\Models\ResendOrder');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }
    
    public function outboundTask()
    {
        return $this->belongsTo('App\Models\OutboundTask');
    }

    public function receiveReceipt()
    {
        return $this->belongsTo('App\Models\ReceiveReceipt');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }

    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
