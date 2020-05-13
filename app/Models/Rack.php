<?php

namespace App\Models;
use Illuminate\Database\Eloquent\softDeletes;
use App\Scopes\RackActiveScope;
class Rack extends MyModel
{
    use SoftDeletes;
    // public $timestamps = false;
    const CREATED_AT = 'rack_date_create';

    protected $table = 'rack';
    protected $primaryKey = 'rack_id';
    protected $attributes = [
        'rack_active' => 1
    ]; // define default value
    
    // Mutators
    protected $dates = []; // additional date attributes to convert columns to instances of Carbon, which extends the PHP
    protected $casts = [];
    protected $appends = []; // append value to JSON (Eloquent > Serialization)
    protected $hidden = []; // hiding attributes from JSON (Eloquent > Serialization)
    
    protected $fillable = [
        'rack_no', 'rack_unit', 'warehouse_id', 'updated_at', 'deleted_at',
    ];

    protected static function boot() {
        parent::boot();
        static::addGlobalScope(new RackActiveScope);

        static::created(function ($model) {
            
        });

        static::updated(function ($model) {
            
        });
        
        static::deleting(function($model) {
            $model->rack_active = 0;
            $model->save();
            $model->shelf()->each(function($shelf) {
                $shelf->shelf_active = 0;
                $shelf->save();
                $shelf->delete();
             });
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

    public function scopeActive($query)
    {
        return $query->where('rack_active', 1);
    }


    /*
    |--------------------------------------------------
    | Relation
    |--------------------------------------------------
    */

    public function lotQty()
    {
        return $this->hasMany('App\Models\LotQty');
    }

    public function warehouse()
    {
        return $this->hasMany('App\Models\Warehouse');
    }

    public function shelf()
    {
        return $this->hasMany('App\Models\Shelf', 'rack_id');
    }

    public function subshelf()
    {
        return $this->hasMany('App\Models\Subshelf', 'rack_id');
    }

    public function outboundList()
    {
        return $this->hasMany('App\Models\OutboundList');
    }

    public function productMovement()
    {
        return $this->hasMany('App\Models\ProductMovement');
    }

    public function rackHistory()
    {
        return $this->hasMany('App\Models\RackHistory');
    }

    public function stocklist()
    {
        return $this->hasMany('App\Models\Stocklist');
    }
    /*
    |--------------------------------------------------
    | Private
    |--------------------------------------------------
    */


}
