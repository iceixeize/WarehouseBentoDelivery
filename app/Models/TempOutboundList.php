<?php

namespace App\Models;
use SoftDeletes;
class TempOutboundList extends MyModel
{
    public $timestamps = false;
    
    protected $table = 'temp_outbound_list';
    protected $primaryKey = 'temp_list_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = [
        'date_updated',
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
    public function outboundTask()
    {
        return $this->belongsTo('App\Models\OutboundTask');
    }

    public function lotProduct()
    {
        return $this->belongsTo('App\Models\LotProduct');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function variant()
    {
        return $this->belongsTo('App\Models\Variant');
    }

    public function warehouseLocation()
    {
        return $this->belongsTo('App\Models\WarehouseLocation', 'warehouse_location_id', 'location_id');
    }

    public function subshelf()
    {
        return $this->belongsTo('App\Models\Subshelf');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function serialNumber()
    {
        return $this->belongsTo('App\Models\SerialNumber');
    }
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
