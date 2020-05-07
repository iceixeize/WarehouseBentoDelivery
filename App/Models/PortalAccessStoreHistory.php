<?php

namespace App\Models;
use SoftDeletes;
class PortalAccessStoreHistory extends MyModel
{
    public $timestamps = false;

    protected $table = 'portal_access_store_history';
    protected $primaryKey = 'portal_access_store_history_id';
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

    public function portalAccessStore()
    {
        return $this->belongsTo('App\Models\PortalAccessStore');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function action()
    {
        return $this->belongsTo('App\Models\ActionName');
    }
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
