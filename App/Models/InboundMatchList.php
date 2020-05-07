<?php

namespace App\Models;
use SoftDeletes;
use App\Scopes\DeletedScope;

class InboundMatchList extends MyModel
{
    public $timestamps = false;
    const CREATED_AT = 'date_created';

    protected $table = 'inbound_match_list';
    protected $primaryKey = 'inbound_match_list_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = []; // additional date attributes to convert columns to instances of Carbon, which extends the PHP
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

    public function lotProduct()
    {
        return $this->belongsTo('App\Models\LotProduct');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function receiveReceipt()
    {
        return $this->belongsTo('App\Models\ReceiveReceipt');
    }

    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
