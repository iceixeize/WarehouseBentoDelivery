<?php

namespace App\Models;
use SoftDeletes;
class TempSeparateTaskItem extends MyModel
{
    public $timestamps = false;
    
    protected $table = 'temp_separate_task_item';
    protected $primaryKey = 'temp_separate_task_item_id';
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
    public function tempSeparateTask()
    {
        return $this->belongsTo('App\Models\TempSeparateTask');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function variant()
    {
        return $this->belongsTo('App\Models\Variant');
    }

    public function orderItem()
    {
        return $this->belongsTo('App\Models\OrderItem');
    }

    public function resendItem()
    {
        return $this->belongsTo('App\Models\ResendItem');
    }

    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}