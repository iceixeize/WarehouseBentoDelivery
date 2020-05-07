<?php

namespace App\Models;
use SoftDeletes;
class WarehouseLocation extends MyModel
{
    // public $timestamps = false;
    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_modified';
    const DELETED_AT = 'date_deleted';

    protected $table = 'warehouse_location';
    protected $primaryKey = 'warehouse_location_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = []; // additional date attributes to convert columns to instances of Carbon, which extends the PHP
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

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }

    public function orderCardHistory()
    {
        $this->hasMany('App\Models\OrderCardHistory');
    }

    public function outboundList()
    {
        return $this->hasMany('App\Models\OutboundList');
    }

    public function pickSlip()
    {
        return $this->belongsTo('App\Models\PickSlip', 'warehouse_locaiton_id', 'location_des_id');
    }

    public function productMovement()
    {
        return $this->hasMany('App\Models\ProductMovement');
    }

    public function stocklist()
    {
        return $this->hasMany('App\Models\Stocklist');
    }

    public function tempInboundItem()
    {
        return $this->hasMany('App\Models\TempInboundItem', 'warehouse_location_id', 'location_id');
    }

    public function tempOutboundItem()
    {
        return $this->hasMany('App\Models\TempOutboundItem');
    }

    public function tempPackingTask()
    {
        return $this->hasMany('App\Models\TempPackingTask');
    }

    public function tempSeparateTask()
    {
        return $this->hasMany('App\Models\TempSeparateTask');
    }

    public function warehouseLocationHistory()
    {
        return $this->hasMany('App\Models\WarehouseLocationHistory');
    }

    public function warehouseOrder()
    {
        return $this->hasMany('App\Models\WarehouseOrder');
    }
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
