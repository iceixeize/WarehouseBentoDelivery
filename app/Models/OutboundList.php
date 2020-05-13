<?php

namespace App\Models;
use SoftDeletes;
class OutboundList extends MyModel
{
    // public $timestamps = false;
    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_last_update';

    protected $table = 'outbound_list';
    protected $primaryKey = 'outbound_list_id';
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

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function variant()
    {
        return $this->belongsTo('App\Models\Variant');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function rack()
    {
        return $this->belongsTo('App\Models\Rack');
    }

    public function shelf()
    {
        return $this->belongsTo('App\Models\Shelf');
    }

    public function subshelf()
    {
        return $this->belongsTo('App\Models\Subshelf');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function outboundTask()
    {
        return $this->belongsTo('App\Models\OutboundTask');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }

    public function warehouseLocation() 
    {
        return $this->belongsTo('App\Models\WarehouseLocation');
    }

    public function lotProduct()
    {
        return $this->belongsTo('App\Models\LotProduct');
    }

    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
