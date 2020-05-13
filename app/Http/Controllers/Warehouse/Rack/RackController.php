<?php

namespace App\Http\Controllers\Warehouse\Rack;

use App\Http\Controllers\MyController;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Http\Requests\RackRequest;
use Illuminate\Support\Facades\Log;
use Debugbar;
use DB;

class RackController extends MyController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        if(empty($this->getWarehouseData())) {
            dd('warehouse not found');
        }
        // $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($subdomain, Request $request)
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

                $query->leftJoin(DB::raw('(SELECT * FROM renting WHERE renting.warehouse_id = ' . $this->getWarehouseData()->warehouse_id . ' AND is_active = 1) AS renting'), function ($join) use ($request) {
                    $join->on('shelf.shelf_id', '=', 'renting.shelf_id');
                    $join->leftJoin('store', 'store.store_id', '=', 'renting.store_id');



                })->active();

                if($request->has('store_name')) {
                    $query->where('store.store_name', 'like', '%' . $request->store_name . '%');
                }
            }])
            ->active()
            ->where('rack.warehouse_id', $this->getWarehouseData()->warehouse_id)
            ->selectRaw('rack.rack_id, rack.rack_no, rack.rack_unit, rack.pick_seq')
            ->groupBy('rack.rack_id');

            if($request->has('rack_no')) {
                $data = $data->where('rack.rack_no', 'like', '%' . $request->rack_no . '%');
            }



            if($request->has('order_by')) {
                if($request->order_by == "seq") {
                    $data = $data->orderByRaw('rack.pick_seq', 'ASC');
                }
            } else {
                $data = $data->orderByRaw('rack.rack_no', 'ASC');
            }

            $data = $data->paginate(5);

            if(empty($data)) {
                return response()->json(['success' => 0, 'data' => []]);
            } else {
                return response()->json(['success' => 1, 'data' => $data]);
            }


        }
        return view('rack._show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($subdomain, Request $request)
    {
        $lastRack = \App\Models\Rack::selectRaw('CAST(rack_no AS UNSIGNED) AS "rack_no"')
                ->where('warehouse_id', $this->getWarehouseData()->warehouse_id)
                ->orderBy('rack_no', 'desc')
                ->first();

        if(is_null($lastRack)) {
            $rackNo = 1;
        } else if(is_numeric($lastRack->rack_no)) {
            $rackNo = $lastRack->rack_no + 1;
        } else {
            $rackNo = '';
        }

        $shelfType = \App\Models\ShelfType::addSelect('shelf_type_id', 'shelf_type')->get();

        return view('rack._create', ['rackNo' => $rackNo, 'shelfType' => $shelfType, 'subdomain' => $subdomain]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store($subdomain, Request $request)
    public function store($subdomain, \App\Http\Requests\RackRequest $request)

    {
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
                }
                    $createSubshelf = $shelfData->subshelf()->createMany($arraySubshelf);
                    if(empty($createSubshelf)) {
                        Log::debug('Can\'t insert subshelf data shelf id : ' . $shelf->shelf_id);
                    }
            }
            return redirect()->route('racks.index', [$subdomain])->with('success', 'สร้างชั้นวางสำเร็จ');
        } else {
            return redirect()->route('racks.index', [$subdomain])->with('error', 'ไม่สามารถสร้างชั้นวางสินค้าได้ กรุณาลองอีกครั้ง');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($subdomain, $id, Request $request)
    {
        if($request->ajax()) {
                $data = \App\Models\Rack::with(['subshelf', 'shelf' => function ($query) {

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
            } else {
                $shelfType = \App\Models\ShelfType::all();
                return view('rack._edit', ['id' => $id, 'shelfType' => $shelfType, 'subdomain' => $subdomain]);
            }

    }

    public function editPickSequence($subdomain = '', $id = '', Request $request)
    {
        if(!empty($id)) {
            $rack = \App\Models\Rack::where('rack_id', $id)->first();

            if($rack && $request->has('seq')) {
                $rack->pick_seq = $request->seq;
                $rack->save();
                return response()->json(['success' => true, 'message' => 'แก้ไขชั้นวางสินค้าแล้ว']);
            }
            return response()->json(['success' => false, 'message' => 'ไม่พบชั้นวางนี้ในระบบ กรุณาลองอีกครั้ง']);
        }
        return response()->json(['success' => false, 'message' => 'ไม่พบชั้นวางนี้ในระบบ กรุณาลองอีกครั้ง']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($subdomain = '', $id = '', \App\Http\Requests\EditShelfRequest $request)
    {
        //
        $rack = \App\Models\Rack::with(['shelf', 'subshelf'])->where('rack_id', $id)->first();
        if($rack) {
            if($request->has('shelfId')) {
                $arrayNewShelf = [];
                $arrayNewSubshelf = [];
                $arrayUpdateShelf = [];
                $seq = 1;

                $lastShelfId = array_filter($request->shelfId);
                $arrayRemoveShelf = array_diff($rack->shelf()->pluck('shelf_id')->toArray(), $lastShelfId);

                // delete shelf
                if(!empty($arrayRemoveShelf)) {
                    $delShelf = $rack->shelf()->whereIn('shelf_id', $arrayRemoveShelf)->update([
                        'shelf_active' => 0
                    ]);
                    if(!$delShelf) {
                        \Log::info('**** can\'t delete shelf data id : ' . json_encode($arrayRemoveShelf));
                    }

                    $delSubshelf = $rack->subshelf()->whereIn('shelf_id', $arrayRemoveShelf)->update([
                        'subshelf_active' => 0
                    ]);
                    if(!$delShelf) {
                        \Log::info('**** can\'t delete subshelf data id : ' . json_encode($arrayRemoveShelf));
                    }
                }

                foreach($request->shelfId as $index => $shelfId) {

                    if(is_null($shelfId)) {

                        $arrNewShelf = [
                            'shelf_no' => $request->shelfNo[$index],
                            'shelf_type_id' => $request->selectShelfType[$index],
                            'shelf_type' => $request->selectShelfUnit[$index],
                            'shelf_seq' => $request->shelfPickSeq[$index],
                            'rack_id' => $id,
                            'warehouse_id' => $rack->warehouse_id,
                            'shelf_active' => 1,

                        ];

                        if(!empty($arrNewShelf)) {
                            $newShelf = $rack->shelf()->insertGetId($arrNewShelf);

                            if(!$newShelf) {
                                \Log::info('**** can\'t new shelf data : ' . json_encode($arrayNewShelf));
                            }


                        }

                        // $arrayNewSubshelf = [];
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

                                $arrayNewSubshelf[] = [
                                    'subshelf_no' => $i,
                                    'warehouse_id' => $rack->warehouse_id,
                                    'rack_id' => $id,
                                    'subshelf_barcode' => $barcode,
                                    'shelf_id' => $newShelf,
                                ];

                            }




                        array_push($arrayNewShelf, $arrNewShelf);
                    } else {
                        $arrUpdate = [
                            'shelf_no' => $request->shelfNo[$index],
                            'shelf_type_id' => $request->selectShelfType[$index],
                            'shelf_type' => $request->selectShelfUnit[$index],
                            'shelf_seq' => $request->shelfPickSeq[$index],
                            'rack_id' => $id,
                            'warehouse_id' => $rack->warehouse_id,

                        ];
                        array_push($arrayUpdateShelf, $arrUpdate);

                        if(!empty($arrUpdate)) {
                            $update = $rack->shelf()->where('shelf_id', $shelfId)->update($arrUpdate);

                            if(!$update) {
                                \Log::info('**** can\'t update shelf data id : ' . $shelfId . ' data : ' . json_encode($arrUpdate));
                            }
                        }
                    }

                    $seq++;
                    $arrNewShelf = [];
                }


                if(!empty($arrayNewSubshelf)) {
                    $newSubshelf = $rack->subshelf()->createMany(
                        $arrayNewSubshelf
                    );

                    if(!$newSubshelf) {
                        \Log::info('**** can\'t new shelf data : ' . json_encode($arrayNewSubshelf));
                    }
                }
                // dd('case_1');
                return redirect()->route('racks.show', [$subdomain, $id])->with('success', 'แก้ไขข้อมูลชั้นวางสินค้าแล้ว');

                // dd(['new' => $arrayNewShelf, 'update' => $arrayUpdateShelf, 'del' => $arrayRemoveShelf, 'new_subshelf' => $arrayNewSubshelf]);
            }
            // dd('case_2');
            return redirect()->route('racks.show', [$subdomain, $id])->with('error', 'ไม่สามารถแก้ไขข้อมูลชั้นวางสินค้าได้ กรุณาลองอีกครั้ง');

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        dd('--- update ---');
        //
        dd($request->all(), $id);
        $rackData = \App\Models\Rack::with('shelf')->where('rack_id', $id)->active()->get();
    }

    public function deleteRack($subdomain, $id = "") {
        // dd(['sub' => $subdomain, 'id' => $id]);
        if(empty($id)) {
            aboard(404);
        }

        $data = \App\Models\Shelf::has('renting')->where('shelf.rack_id', $id)
        ->leftJoin('lot_qty', function ($join) {
                    $join->on('lot_qty.shelf_id', '=', 'shelf.shelf_id');
        })
        ->selectRaw('shelf.*, SUM(lot_qty.qty) AS "amount_pd"')
        ->groupBy('shelf.shelf_id')
        ->active()
        ->orderBy('shelf.shelf_seq')
        ->get();


        if(!empty($data)) {

            $hasProductInShelf = $data->where('amount_pd', '>', 0);
            // if($hasProductInShelf)
            if($hasProductInShelf->count() > 0) {
                // ลบไม่ได้
                return redirect()->route('racks.index', ['subdomain' => $subdomain]);
        }
    }


    $deleteRack = \App\Models\Rack::where('rack_id', $id)->first();

    if($deleteRack) {
        $deleteRack->delete();
    }
    return redirect()->route('racks.index', ['subdomain' => $subdomain]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($subdomain, $id = '')
    {
        dd('--- destroy ---');


    }
}
