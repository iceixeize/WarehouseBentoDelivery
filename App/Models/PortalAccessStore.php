<?php

namespace App\Models;
use SoftDeletes;
use App\Scopes\DeletedScope;

class PortalAccessStore extends MyModel
{
    public $timestamps = false;

    protected $table = 'portal_access_store';
    protected $primaryKey = 'portal_access_store_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = [
        'date_create',
        'date_delete',
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

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function portalUser()
    {
        return $this->belongsTo('App\Models\PortalUser');
    }

    public function portalAccessStoreHistory()
    {
        return $this->hasMany('App\Models\PortalAccessStoreHistory');
    }

    public function accessUsers()
    {
        return $this->belongsToMany('App\Models\PortalAccessUser', 'portal_access_store_id', 'portal_user_id', 'portal_access_store');
    }
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
