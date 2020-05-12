<?php

namespace App\Models;
use SoftDeletes;
class LotQty extends MyModel
{
    public $timestamps = false;
    protected $table = 'lot_qty';
    protected $primaryKey = 'qty_id';
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

    public function lotProduct()
    {
        return $this->belongsTo('App\Models\LotProduct');
    }

    public function subshelf()
    {
        return $this->belongsTo('App\Models\Subshelf');
    }

    public function variant()
    {
        return $this->belongsTo('App\Models\Variant');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }

    public function warehouseLocation()
    {
        return $this->belongsTo('App\Models\WarehouseLocation');
    }

    public function shelf()
    {
        return $this->belongsTo('App\Models\Shelf', 'shelf_id');
    }

    public function rack()
    {
        return $this->belongsTo('App\Models\Rack');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
