<?php

namespace App\Http\Controllers\Rack;

use App\Http\Controllers\MyController;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Http\Requests\RackRequest;
use Illuminate\Support\Facades\Log;
use DB;
use Debugbar;

class RackController extends MyController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        if(empty($this->getWarehouseData())) {
            dd('warehouse not found');
        }
        $this->middleware('auth');
    }

    // public function index(Request $request)
    // {
    //     if($request->ajax()) {
    //         $data = \App\Models\Rack::with(['shelf' => function ($query) {

    //             $query->selectRaw(DB::raw('shelf.*, shelf_type.shelf_type AS "type_name", store.store_name, store.store_id, renting.*'));
    //             $query->orderBy('shelf.shelf_seq', 'ASC');
    //             $query->orderBy('renting.date_start', 'ASC');
    //             $query->where('shelf.warehouse_id', $this->getWarehouseData()->warehouse_id);
    //             $query->active();

    //             $query->leftJoin('shelf_type', function ($join) {
    //                 $join->on('shelf.shelf_type_id', '=', 'shelf_type.shelf_type_id');
    //             });

    //             $query->leftJoin(DB::raw('(SELECT * FROM renting WHERE renting.warehouse_id = ' . $this->getWarehouseData()->warehouse_id . ' AND is_active = 1) AS renting'), function ($join) {
    //                 $join->on('shelf.shelf_id', '=', 'renting.shelf_id');
    //                 $join->leftJoin('store', 'store.store_id', '=', 'renting.store_id');
    //             })->active();
    //         }])
    //         ->active()
    //         ->where('rack.warehouse_id', $this->getWarehouseData()->warehouse_id)
    //         ->selectRaw('rack.rack_id, rack.rack_no, rack.rack_unit')
    //         ->groupBy('rack.rack_id')
    //         ->orderByRaw('rack.rack_no', 'ASC')
    //         ->paginate(20);

    //         if(empty($data)) {
    //             return response()->json(['success' => 0, 'data' => []]);
    //         } else {
    //             return response()->json(['success' => 1, 'data' => $data]);
    //         }

    //     }
    //     return view('rack._show');
    // }

    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = \App\Models\Rack::with(['shelf' => function ($query) use ($request) {

                $query->selectRaw(DB::raw('shelf.*, shelf_type.shelf_type AS "type_name", store.store_name, store.store_id, renting.*'));
                $query->orderBy('shelf.shelf_seq', 'ASC');
                $query->orderBy('renting.date_start', 'ASC');
                $query->where('shelf.warehouse_id', $this->getWarehouseData()->warehouse_id);
                $query->active();

                $query->leftJoin('shelf_type', function ($join) {
                    $join->on('shelf.shelf_type_id', '=', 'shelf_type.shelf_type_id');
                });

                $query->leftJoin(DB::raw('(SELECT * FROM renting WHERE renting.warehouse_id = ' . $this->getWarehouseData()->warehouse_id . ' AND is_active = 1) AS renting'), function ($join) {
                    $join->on('shelf.shelf_id', '=', 'renting.shelf_id');
                    $join->leftJoin('store', 'store.store_id', '=', 'renting.store_id');
                })->active();

                if($request->has('store_name')) {
                    $query->where('store.store_name', 'like', '%' . $request->store_name . '%');
                }

                // if($request->has('shelf_status_avaiable') && $request->has('amount_available')) {
                //     if($request->shelf_status_avaiable == 1) { // จำนวน unit ของ rack ที่ว่าง
                //         $query->where('store.amount_available', 'like', '%' . $req->store_name . '%');
                //     } else if($request->shelf_status_avaiable == 2) { // จำนวน unit ของ shelf ที่ว่าง
                //         $query->where('store.amount_available', 'like', '%' . $req->store_name . '%');
                //     }
                // }
            }])->has('shelf', '>', 0) // ไม่กรอง
            ->active()
            ->where('rack.warehouse_id', $this->getWarehouseData()->warehouse_id)
            ->selectRaw('rack.rack_id, rack.rack_no, rack.rack_unit')
            ->groupBy('rack.rack_id')
            ->orderByRaw('rack.rack_no', 'ASC');

            if($request->has('rack_no')) {
                $data = $data->where('rack.rack_no', 'like', '%' . $request->rack_no . '%');
            }

            $data = $data->paginate(20);
            if(empty($data)) {
                return response()->json(['success' => 0, 'data' => []]);
            } else {
                return response()->json(['success' => 1, 'data' => $data]);
            }

        }
        return view('rack._show');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {        
        $lastRack = \App\Models\Rack::selectRaw('CAST(rack_no AS UNSIGNED) AS "rack_no"')
                ->where('warehouse_id', $this->getWarehouseData()->warehouse_id)
                ->orderBy('rack_no', 'desc')
                ->first();

        if(is_numeric($lastRack->rack_no)) {
            $rackNo = $lastRack->rack_no + 1;
        } else {
            $rackNo = '';
        }

        $shelfType = \App\Models\ShelfType::addSelect('shelf_type_id', 'shelf_type')->get();

        return view('rack._create', ['rackNo' => $rackNo, 'shelfType' => $shelfType]);
    }

    public function store(RackRequest $request) 
    {
        // dd('store');
        $arrayRack = [
            'rack_no' => $request->rackNo,
            'rack_unit' => $request->shelfAmount,
            'warehouse_id' => $this->getWarehouseData()->warehouse_id,
        ];
        $arrayShelfType = [];
        $arraySubshelf = [];

        foreach($request->selectShelfType as $index => $shelfTypeId) {
            $arrayShelfType[] = 
                [
                    'shelf_type_id' => $shelfTypeId,
                    'shelf_type' => $request->selectShelfUnit[$index],
                    'shelf_no' => $request->inputShelfName[$index],
                    'shelf_seq' => $index+1,
                    'warehouse_id' => $this->getWarehouseData()->warehouse_id,
                ];
        }

        if(empty($arrayShelfType)) {
            dd('empty array shelf type');
        }
        $createRack = \App\Models\Rack::firstOrCreate($arrayRack)
        ->shelf()->createMany($arrayShelfType);

        if(!empty($createRack)) {
            foreach($createRack as $index => $shelf) {
                $shelfData = \App\Models\Shelf::find($shelf->shelf_id);
                
                if(!empty($shelfData)) {
                    $arraySubshelf = [];
                    for($i = 1; $i <= config('btd.rack.default_subshelf'); $i++) {
                        $barcode = '';
                        $maxBarcode = \App\Models\BarcodeAutoNumber::addSelect('value', 'seq')
                                    ->where('keyword', 'subshelf')
                                    ->where('value', date('y') . date('m'))
                                    ->first();

                        if(is_null($maxBarcode)) {
                            $updateBarcode = \App\Models\BarcodeAutoNumber::where('keyword', 'subshelf')
                                            ->update(['seq' => 1, 'value' => date('y') . date('m')]);
                            $barcode = config('btd.rack.barcode_prefix_ss') . date('y') . date('m') . (sprintf("%0" . config('btd.rack.barcode_length_subshelf') . "d", 1));

                            $updateBarcode = \App\Models\BarcodeAutoNumber::where('keyword', 'subshelf')
                                            ->update(['seq' => 2]);
                        } else if($maxBarcode->exists()) {
                            $barcode = config('btd.rack.barcode_prefix_ss') . $maxBarcode->value . (sprintf("%0" . config('btd.rack.barcode_length_subshelf') . "d", $maxBarcode->seq));
                            $updateBarcode = \App\Models\BarcodeAutoNumber::where('keyword', 'subshelf')
                                            ->update(['seq' => $maxBarcode->seq + 1]);
                        } else {
                          // not exist  
                        }

                        $arraySubshelf[] = [
                            'subshelf_no' => $i,
                            'warehouse_id' => $this->getWarehouseData()->warehouse_id,
                            'rack_id' => $shelf->rack_id,
                            'subshelf_barcode' => $barcode,

                            'shelf_id' => $shelf->shelf_id,
                        ];
                        
                    }

                    $arrayShelf[$shelf->shelf_id] = $arraySubshelf;
                    // dd($arraySubshelf);
                    
                }
                    $createSubshelf = $shelfData->subshelf()->createMany($arraySubshelf);
                    if(empty($createSubshelf)) {
                        Log::debug('Can\'t insert subshelf data shelf id : ' . $shelf->shelf_id);
                    }
            }
        }
   
        return redirect()->route('racks.index', [$subdomain]);
    }

    public function show(Request $request, $subdomain = '', $id = 0)
    {
        // dd('show');
        if($request->ajax()) {
            if(empty($id)) {
                aboard(404);
            } else {
                $data = \App\Models\Rack::with(['shelf' => function ($query) {

                    $query->selectRaw('shelf.*, shelf_type.shelf_type AS "type_name", store.store_name, store.store_id, renting.*, COUNT(subshelf.subshelf_id) AS "count_subshelf", 
                    max_subshelf, IFNULL(amount_of_pd, 0) AS "amount_of_pd", IFNULL(max_subshelf, 1) AS "max_subshelf_has_product", shelf.shelf_type_id AS "type_id", shelf.shelf_type AS "shelf_unit", shelf.shelf_id');
                    $query->orderBy('shelf.shelf_seq', 'ASC');
                    $query->orderBy('renting.date_start', 'ASC');
                    $query->where('shelf.warehouse_id', $this->getWarehouseData()->warehouse_id);
                    $query->active();

                    $query->leftJoin('shelf_type', function ($join) {
                        $join->on('shelf.shelf_type_id', '=', 'shelf_type.shelf_type_id');
                    });

                    $query->leftJoin('subshelf', function ($join) {
                        $join->on('shelf.shelf_id', '=', 'subshelf.shelf_id');
                    })->groupBy('subshelf.shelf_id');

                    // $query->leftJoin('lot_qty', function ($join) {
                    //     $join->on('shelf.shelf_id', '=', 'lot_qty.shelf_id');
                    // })->groupBy('lot_qty.shelf_id');

                    $query->leftJoin(DB::raw('(SELECT shelf_id, SUM(qty) AS "amount_of_pd" FROM lot_qty GROUP BY shelf_id) AS lot_qty'), function ($join) {
                        $join->on('shelf.shelf_id', '=', 'lot_qty.shelf_id');
                    });

                    $query->leftJoin(DB::raw('(SELECT lot_qty.shelf_id, MAX(ss.subshelf_no) AS "max_subshelf", SUM(qty) AS "qty_product_in_subshelf" FROM lot_qty
                    LEFT JOIN subshelf ss ON lot_qty.subshelf_id = ss.subshelf_id
                    GROUP BY lot_qty.subshelf_id HAVING qty_product_in_subshelf > 0) AS lqt'), function ($join) {
                        $join->on('shelf.shelf_id', '=', 'lqt.shelf_id');
                    });

                    $query->leftJoin(DB::raw('(SELECT * FROM renting WHERE renting.warehouse_id = ' . $this->getWarehouseData()->warehouse_id . ' AND is_active = 1) AS renting'), function ($join) {
                        $join->on('shelf.shelf_id', '=', 'renting.shelf_id');
                        $join->leftJoin('store', 'store.store_id', '=', 'renting.store_id');
                    });

                    $query->groupBy('subshelf.shelf_id');

                    $query->orderBy('shelf.shelf_seq');

                }])        
                ->active()
                ->where('rack.warehouse_id', $this->getWarehouseData()->warehouse_id)
                ->where('rack.rack_id', $id)
                ->selectRaw('rack.rack_id, rack.rack_no, rack.rack_unit')
                ->first();

                if(empty($data)) {
                    return response()->json(['success' => 0, 'data' => []]);
                } else {
                    return response()->json(['success' => 1, 'data' => $data]);
                }
            }
        } else {
            $shelfType = \App\Models\ShelfType::all();
            return view('rack._edit', ['id' => $id, 'shelfType' => $shelfType]);
        }
    }

    public function edit($id = '')
    {
        dd('edit id : ' . $id);
    }

    public function update()
    {
        dd('update');
    }

    public function destroy()
    {
        dd('destroy');
    }
}
