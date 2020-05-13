<?php

namespace App\Models;
use SoftDeletes;
class WarehouseOrderHistory extends MyModel
{
    public $timestamps = false;
    
    protected $table = 'warehouse_order_history';
    protected $primaryKey = 'warehouse_order_history_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = [
        'datetime',
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
    public function warehouseOrder()
    {
        return $this->belongsTo('App\Models\WarehouseOrder');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function action()
    {
        return $this->belongsTo('App\Models\ActionName');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }

    public function packing()
    {
        return $this->belongsTo('App\Models\Packing');
    }

    public function resendOrder()
    {
        return $this->belongsTo('App\Models\ResendOrder');
    }

    public function customOrderShipping()
    {
        return $this->belongsTo('App\Models\CustomOrderShipping');
    }
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
