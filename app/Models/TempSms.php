<?php

namespace App\Models;
use SoftDeletes;
use App\Scopes\DeletedScope;

class TempSms extends MyModel
{
    public $timestamps = false;
    
    protected $table = 'temp_sms';
    protected $primaryKey = 'temp_sms_id';
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
        static::addGlobalScope(new DeletedScope);

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

    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
