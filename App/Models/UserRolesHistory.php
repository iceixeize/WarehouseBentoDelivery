<?php

namespace App\Models;
use SoftDeletes;
class UserRolesHistory extends MyModel
{
    public $timestamps = false;
    
    protected $table = 'user_roles_history';
    protected $primaryKey = 'user_roles_history_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = [
        'datetime'
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
    public function userRoles()
    {
        return $this->belongsTo('App\Models\UserRoles');
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
