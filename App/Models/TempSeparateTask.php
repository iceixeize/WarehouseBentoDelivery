<?php

namespace App\Models;
use SoftDeletes;
class TempSeparateTask extends MyModel
{
    public $timestamps = false;
    
    protected $table = 'temp_separate_task';
    protected $primaryKey = 'temp_separate_task_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = [
        'date_create',
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

    public function resendOrder()
    {
        return $this->belongsTo('App\Models\ResendOrder');
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
