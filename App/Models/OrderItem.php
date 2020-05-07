<?php

namespace App\Models;
use SoftDeletes;
class OrderItem extends MyModel
{
    public $timestamps = false;

    protected $table = 'order_item';
    protected $primaryKey = 'order_item_id';
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
    public function warehouseOrder()
    {
        return $this->belongsTo('App\Models\WarehouseOrder');
    }

    public function variant()
    {
        return $this->belongsTo('App\Models\Variant');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    
    public function tempSeparateTaskItem()
    {
        return $this->hasMany('App\Models\TempSeparateTaskItem');
    }

    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
