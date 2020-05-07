<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = \App\User::with(['userRoles' => function ($query) {
            // $query->select('roles_name');
        }])->addSelect('userRoles.roles_name')->get();
        dd(['data' => $data]);
        $dashOrder = \App\Models\WarehouseOrder::where('warehouse_order.can_not_find_warehouse', 1)
        ->select('warehouse_order.*', 'store.store_name')
        ->orWhere('warehouse_order.is_waiting_for_manual', 1)
        ->leftJoin('store', 'store.store_id', '=', 'warehouse_order.store_id')
        ->get();
dd($dashOrder);
        // $dashOrder = \App\Models\WarehouseOrder::with(['store'])->first();
        // dd($dashOrder);
        $dashOrder = \App\Models\WarehouseOrder::with(['store'])
        // ->selectRaw('warehouse_order.order_no, warehouse_order.date_create, warehouse_order.firstname, warehouse_order.lastname, warehouse_order.phone, warehouse_order.can_not_find_warehouse, warehouse_order.warehouse_order_id, warehouse_order.is_waiting_for_manual')
        ->where('warehouse_order.can_not_find_warehouse', 1)
        ->orWhere('warehouse_order.is_waiting_for_manual', 1)
        ->first();

        dd(['order_unreachable' => $dashOrder]);

        return view('warehouse.print._lab_js_barcode', ['pageHeight' => 160, 'pageWidth' => 224, 'barcode' => '898989898989']);
        $rack = \App\Models\Rack::with('shelf')->where('rack_id', 153)->active()->first();
        // dd($rack->shelf()->pluck('shelf_id')->toArray());
        dd(array_diff($rack->shelf()->pluck('shelf_id')->toArray(), ['1006', '1009']));

        $query = \App\Models\ActionPayment::where('action_payment_id', 1)->first();
        dd($query->paymentHistory());
        // $stores = DB::table('store')
        //         ->whereJsonLength('store_config_price->config_price_sms', '>', 0)
        //         ->get();
        // dd(['order_all', $stores]);
    }

    public function test(\App\Http\Requests\TestRequest $request) {
        dd(['req' => $request]);
    }


    
}
