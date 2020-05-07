<?php

namespace App\Models;
use SoftDeletes;
use App\Scopes\DeletedScope;

class Variant extends MyModel
{
    // public $timestamps = false;
    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_modified';

    protected $table = 'user';
    protected $primaryKey = 'user_id';
    protected $attributes = []; // define default value
    
    // Mutators
    protected $dates = [
        'date_imported',
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

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function inboundList()
    {
        return $this->hasMany('App\Models\InboundList');
    }

    public function lotProduct()
    {
        return $this->hasMany('App\Models\LotProduct');
    }

    public function logChangeStock()
    {
        return $this->hasMany('App\Models\LogChangeStock');
    }

    public function LotQty()
    {
        return $this->hasMany('App\Models\LotQty');
    }

    public function orderItem()
    {
        $this->hasMany('App\Models\OrderItem');
    }

    public function outboundList()
    {
        return $this->hasMany('App\Models\OutboundList');
    }

    public function pickSlipList()
    {
        return $this->hasMany('App\Models\PickSlipList');
    }

    public function productMovement()
    {
        return $this->hasMany('App\Models\ProductMovement');
    }

    public function resendItem()
    {
        return $this->hasMany('App\Models\ResendItem');
    }

    public function serialNumber()
    {
        return $this->hasMany('App\Models\SerialNumber');
    }

    public function serialNumberHistory()
    {
        return $this->hasMany('App\Models\SerialNumberHistory');
    }

    public function storeHistory()
    {
        return $this->hasMany('App\Models\StoreHistory');
    }

    public function tempInboundItem()
    {
        return $this->hasMany('App\Models\TempInboundItem');
    }

    public function tempOutboundItem()
    {
        return $this->hasMany('App\Models\TempOutboundItem');
    }

    public function tempSeparateTaskItem()
    {
        return $this->hasMany('App\Models\TempSeparateTaskItem');
    }
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
