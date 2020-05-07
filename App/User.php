<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'username', 'password', 'email', 'gender', 'user_roles_id', 'id_card', 'birthday', 'tel'
        // 'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];

    protected $table = 'user';

    protected $primaryKey = 'user_id';

    const CREATED_AT = 'date_create';
    const UPDATED_AT = 'date_modified';

        /*
    |--------------------------------------------------
    | Scope
    |--------------------------------------------------
    */
    public function scopeIsNotBlock($query)
    {
        return $query->where('is_blocked', 0);
    }


    /*
    |--------------------------------------------------
    | Relation
    |--------------------------------------------------
    */

    public function accessWarehouse()
    {
        return $this->hasMany('App\Models\AccessWarehouse', 'user_id');
    }

    public function accessWarehouseHistory()
    {
        return $this->hasMany('App\Models\AccessWarehouseHistory');
    }

    public function announcementHistory()
    {
        return $this->hasMany('App\Models\AnnouncementHistory');
    }

    public function boxesHistory()
    {
        return $this->hasMany('App\Models\BoxesHistory');
    }

    public function customOrderShipping()
    {
        return $this->hasMany('App\Models\CustomOrderShipping');
    }

    public function resendOrder()
    {
        return $this->hasMany('App\Models\ResendOrder');
    }

    public function warehouseCard()
    {
        return $this->hasMany('App\Models\WarehouseCard');
    }

    public function outboundTask()
    {
        return $this->hasMany('App\Models\OutboundTask');
    }

    public function lotProduct()
    {
        return $this->hasMany('App\Models\LotProduct');
    }

    public function inboundList()
    {
        return $this->hasMany('App\Models\InboundList');
    }

    public function receiveReceipt()
    {
        return $this->hasMany('App\Models\ReceiveReceipt');
    }

    public function inboundMatchList()
    {
        return $this->hasMany('App\Models\InboundMatchList');
    }

    public function logPrint()
    {
        return $this->hasMany('App\Models\LogPrint');
    }

    public function shelftype()
    {
        return $this->belongsTo('App\Models\ShelfType');
    }

    public function orderCardHistory()
    {
        $this->hasMany('App\Models\OrderCardHistory');
    }

    public function outboundList()
    {
        return $this->hasMany('App\Models\OutboundList');
    }

    public function paymentAdditional()
    {
        $this->hasMany('App\Models\PaymentAdditional');
    }

    public function paymentRenting()
    {
        return $this->hasMany('App\Models\PaymentRenting');
    }

    public function paymentHistory()
    {
        return $this->belongsTo('App\Models\PaymentHistory');
    }

    public function pickupParcel()
    {
        return $this->hasMany('App\Models\PickupParcel');
    }

    public function portalAccessStoreHistory()
    {
        return $this->hasMany('App\Models\PortalAccessStoreHistory');
    }

    public function portalUserHistory()
    {
        return $this->hasMany('App\Models\PortalUserHistory');
    }

    public function priceRateHistory()
    {
        return $this->hasMany('App\Models\PriceRateHistory');
    }

    public function providerHistory()
    {
        return $this->hasMany('App\Models\ProviderHistory');
    }

    public function rackHistory()
    {
        return $this->hasMany('App\Models\RackHistory');
    }

    public function receiveHistory()
    {
        return $this->hasMany('App\Models\ReceiveHistory');
    }

    public function stockBoxHistory()
    {
        return $this->hasMany('App\Models\StockBoxHistory');
    }

    public function stocklist()
    {
        return $this->hasMany('App\Models\Stocklist');
    }

    public function storeConfigPrice()
    {
        return $this->hasMany('App\Models\StoreConfigPrice');
    }

    public function storeHistory()
    {
        return $this->hasMany('App\Models\StoreHistory');
    }

    public function storePromotionHistory()
    {
        return $this->hasMany('App\Models\StorePromotionHistory');
    }

    public function storeShippingKey()
    {
        return $this->hasMany('App\Models\StoreShippingKey');
    }

    public function tempOutboundItem()
    {
        return $this->hasMany('App\Models\TempOutboundItem');
    }

    public function tempPackingTask()
    {
        return $this->hasMany('App\Models\TempPackingTask');
    }

    public function tempSeparateTask()
    {
        return $this->hasMany('App\Models\TempSeparateTask');
    }

    public function tempSms()
    {
        return $this->hasMany('App\Models\TempSms');
    }

    public function unreachableOrder()
    {
        return $this->hasMany('App\Models\UnreachableOrder');
    }

    public function userHistory()
    {
        return $this->hasMany('App\Models\UserHistory');
    }

    public function userRolesHistory()
    {
        return $this->hasMany('App\Models\UserRolesHistory');
    }

    public function warehouseHistory()
    {
        return $this->hasMany('App\Models\WarehouseHistory');
    }

    public function warehouseLocationHistory()
    {
        return $this->hasMany('App\Models\WarehouseLocationHistory');
    }

    public function warehouseOrderHistory()
    {
        return $this->hasMany('App\Models\WarehouseOrderHistory');
    }

    public function warehouseLogError()
    {
        return $this->hasMany('App\Models\WarehouseLogError');
    }

    public function warehouses()
    {
        return $this->belongsToMany('App\Models\Warehouse', 'access_warehouse', 'user_id', 'warehouse_id');
    }

    public function userRoles()
    {
        return $this->belongsTo('App\Models\UserRoles', 'user_roles_id');
    }
}
