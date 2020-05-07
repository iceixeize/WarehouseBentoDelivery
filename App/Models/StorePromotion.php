<?php

namespace App\Models;
use SoftDeletes;
use App\Scopes\DeletedScope;

class StorePromotion extends MyModel
{
    const CREATED_AT = 'date_create';
    const UPDATED_AT = 'date_modified';

    protected $table = 'store_promotion';
    protected $primaryKey = 'store_promotion_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = []; // additional date attributes to convert columns to instances of Carbon, which extends the PHP
    protected $casts = [
        'product_variat_list' => 'array',
        'condition' => 'array',
    ];
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

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function resendItem()
    {
        return $this->hasMany('App\Models\ResendItem');
    }

    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
