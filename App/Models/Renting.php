<?php

namespace App\Models;
use SoftDeletes;
class Renting extends MyModel
{
    // public $timestamps = false;
    const CREATED_AT = 'date_create';

    protected $table = 'renting';
    protected $primaryKey = 'renting_id';
    protected $attributes = [
        'renting_date_start',
        'renting_date_expire',
    ]; // define default value
    
    // Mutators

    protected $dates = [
        'date_start', 
        'date_expire'
    ]; // additional date attributes to convert columns to instances of Carbon, which extends the PHP
    protected $casts = [
        // 'date_start'  => 'datetime:d-m-Y',
        // 'date_expire'  => 'datetime:d-m-Y',

    ];

    //protected $dateFormat = 'd-m-Y';
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

//     public function setRentingDateCreateAttribute($value)
//     {
//         $this->attributes['renting_date_create'] = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');

//     }

//     public function setRentingDateExpireAttribute($date) {
//         $this->attributes['renting_date_expire'] = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
//    }

    /*
    |--------------------------------------------------
    | Scope
    |--------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    /*
    |--------------------------------------------------
    | Relation
    |--------------------------------------------------
    */

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function shelf()
    {
        return $this->belongsTo('App\Models\Shelf', 'shelf_id');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }

    public function paymentRenting()
    {
        return $this->hasMany('App\Models\PaymentRenting');
    }

    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
