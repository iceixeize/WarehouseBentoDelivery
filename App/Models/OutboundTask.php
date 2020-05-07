<?php

namespace App\Models;
use SoftDeletes;
use App\Scopes\DeletedScope;

class OutboundTask extends MyModel
{
    // public $timestamps = false;
    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_update';

    protected $table = 'outbound_task';
    protected $primaryKey = 'outbound_task_id';
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

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse');
    }

    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }

    public function warehouseExport()
    {
        return $this->belongsTo('App\Models\Warehouse', 'warehouse_id', 'warehouse_id_export');
    }

    public function paymentDoc()
    {
        return $this->belongsTo('App\Models\PaymentDoc');
    }

    public function receiveReceipt()
    {
        return $this->hasMany('App\Models\ReceiveReceipt');
    }

    public function outboundList()
    {
        return $this->hasMany('App\Models\OutboundList');
    }

    public function paymentAdditional()
    {
        $this->hasMany('App\Models\PaymentAdditional');
    }

    public function paymentHistory()
    {
        return $this->belongsTo('App\Models\PaymentHistory');
    }

    public function productMovement()
    {
        return $this->hasMany('App\Models\ProductMovement');
    }

    public function receiveHistory()
    {
        return $this->hasMany('App\Models\ReceiveHistory');
    }

    public function serialNumber()
    {
        return $this->hasMany('App\Models\SerialNumber');
    }

    public function serialNumberHistory()
    {
        return $this->hasMany('App\Models\SerialNumberHistory');
    }

    public function tempInboundItem()
    {
        return $this->hasMany('App\Models\TempInboundItem');
    }

    public function tempOutboundItem()
    {
        return $this->hasMany('App\Models\TempOutboundItem');
    }
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
