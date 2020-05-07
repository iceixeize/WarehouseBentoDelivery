<?php

namespace App\Models;
use SoftDeletes;
class PickSlip extends MyModel
{
    public $timestamps = false;

    protected $table = 'pickslip';
    protected $primaryKey = 'pickslip_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = [
        'date_created',
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

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }

    public function warehouseLocation()
    {
        return $this->belongsTo('App\Models\WarehouseLocation', 'location_des_id', 'warehouse_locaiton_id');
    }

    public function pickSlipList()
    {
        return $this->hasMany('App\Models\PickSlipList');
    }
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
