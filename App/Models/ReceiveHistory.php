<?php

namespace App\Models;
use SoftDeletes;
class ReceiveHistory extends MyModel
{
    public $timestamps = false;

    protected $table = 'receive_history';
    protected $primaryKey = 'receive_history_id';
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
    public function receiveReceipt()
    {
        return $this->belongsTo('App\Models\ReceiveReceipt');
    }

    public function action()
    {
        return $this->belongsTo('App\Models\ActionName');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function lotProduct()
    {
        return $this->belongsTo('App\Models\LotProduct');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }

    public function outboundTask()
    {
        return $this->belongsTo('App\Models\OutboundTask');
    }

    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
