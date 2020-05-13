<?php

namespace App\Models;
use SoftDeletes;
use App\Scopes\DeletedScope;

class UserRoles extends MyModel
{
    public $timestamps = false;
    const CREATED_AT = 'date_create';
    const UPDATED_AT = 'date_edit';
    
    protected $table = 'user_roles';
    protected $primaryKey = 'user_roles_id';
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
    public function userHistory()
    {
        return $this->hasMany('App\Models\UserHistory');
    }

    public function userRolesHistory()
    {
        return $this->hasMany('App\Models\UserRolesHistory');
    }

    public function users()
    {
        return $this->hasMany('App\User', 'user_roles_id');
    }

    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
