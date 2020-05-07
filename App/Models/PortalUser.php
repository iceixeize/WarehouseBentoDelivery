<?php

namespace App\Models;
use SoftDeletes;
use App\Scopes\DeletedScope;

class PortalUser extends MyModel
{
    // public $timestamps = false;
    const CREATED_AT = 'date_create';
    const UPDATED_AT = 'date_modified';

    protected $table = 'portal_user';
    protected $primaryKey = 'portal_user_id';
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

    public function portalAccessStore()
    {
        return $this->hasMany('App\Models\PortalAccessStore');
    }

    public function portalUserHistory()
    {
        return $this->hasMany('App\Models\PortalUserHistory');
    }

    public function accessStores()
    {
        return $this->belongsToMany('App\Models\PortalAccessStore', 'portal_access_store', 'portal_user_id', 'portal_access_store_id');
    }
    
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
