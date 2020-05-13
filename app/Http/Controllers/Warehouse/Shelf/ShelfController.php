<?php

namespace App\Http\Controllers\Warehouse\Shelf;

use App\Http\Controllers\MyController;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Http\Requests\ShelfRequest;
use Illuminate\Support\Facades\Log;
use DB;
use Debugbar;

class ShelfController extends MyController
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

    public function index(Request $request)
    {
        dd('index');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {        
        dd('create');
    }

    public function store(ShelfRequest $request) 
    {
        if($request->has('shelfId')) {
            foreach($request->shelfId as $index => $shelfId) {
                $shelf = \App\Models\Shelf::withCount('subshelf')->where('shelf_id', $shelfId)->first();
                // dd($shelf->subshelf);
                $subshelf = $shelf->subshelf()->selectRaw('IFNULL(MAX(subshelf_no), 1) as max_subshelf_can_do, IFNULL(SUM(qty), 0) as amount_product')->leftJoin('lot_qty', function ($join) {
                    $join->on('subshelf.subshelf_id', '=', 'lot_qty.subshelf_id');
                })->groupBy('lot_qty.subshelf_id')->first();
                if(!empty($shelf)) {
                    // dd(['ss' => $subshelf]);
                    if(is_null($subshelf) || intVal($subshelf->amount_product) == 0) {
                        if(intVal($request->maxSubshelf[$index]) < intVal($subshelf->max_subshelf_can_do)) { // check ว่า subshelf มากสุดที่แก้ไขได้ (ไม่มีสินค้า)
                            $remove = \App\Models\Subshelf::where('shelf_id', $shelfId)->delete();

                            if($remove) {
                                $arraySubshelf = [];
                                for($i = 1; $i <= intVal($request->maxSubshelf[$index]); $i++) {
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
    
                                    $shelfModel = \App\Models\Shelf::where('shelf_id', $shelfId)->first();

                                    $arraySubshelf[] = [
                                        'subshelf_no' => $i,
                                        'warehouse_id' => $this->getWarehouseData()->warehouse_id,
                                        'rack_id' => $shelf->rack_id,
                                        'subshelf_barcode' => $barcode,
                                        'shelf_id' => $shelfId,
                                    ];
                                }
                                $newSubshelf = $shelfModel->subshelf()->createMany($arraySubshelf);
                            }
                            // remove
                            echo 'shelf id : ' . $shelfId . ' remove => old : ' . $subshelf->max_subshelf_can_do . ' new : ' . $request->maxSubshelf[$index] . '<br>';
                        } else if (intVal($request->maxSubshelf[$index]) > intVal($subshelf->max_subshelf_can_do)) { // new
                            $rowAmount = intVal($request->maxSubshelf[$index]) - intVal($subshelf->max_subshelf_can_do);
                            // $arraySubshelf = [];
                            $start = intVal($subshelf->max_subshelf_can_do) + 1;
                            for($i = $start; $i <= intVal($request->maxSubshelf[$index]); $i++) {
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

                                $shelfModel = \App\Models\Shelf::where('shelf_id', $shelfId)->first();
                                $newSubshelf = $shelfModel->subshelf()->create([
                                    'subshelf_no' => $i,
                                    'warehouse_id' => $this->getWarehouseData()->warehouse_id,
                                    'rack_id' => $shelf->rack_id,
                                    'subshelf_barcode' => $barcode,
                                    'shelf_id' => $shelfId,
                                ]);

                                echo 'new subshelf : ' . $newSubshelf . '<br>';
                            }
                            echo 'shelf id : ' . $shelfId .'new => add new : ' . $subshelf->max_subshelf_can_do . ' new : ' . $request->maxSubshelf[$index] . '<br>';
                        }
                    }
                    // dd(['subshelf' => $shelf]);
                }
                // dd(['shelf' => $shelf]);
            }
        }
        dd($request->all());
    }

    public function edit()
    {
        dd('edit');
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
