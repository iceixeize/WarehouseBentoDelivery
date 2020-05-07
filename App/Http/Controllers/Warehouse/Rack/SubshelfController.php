<?php

namespace App\Http\Controllers\Warehouse\Rack;

use App\Http\Controllers\MyController;
use Illuminate\Http\Request;

class SubshelfController extends MyController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($subdomain, $id, \App\Http\Requests\ShelfRequest $request)
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function print($subdomain, \App\Http\Requests\PrintSubshelfRequest $request) {
        // dd($request->all());

        $paperData = \App\Models\BarcodePaper::where('paper_id', 6)->first();
        if($request->colStart <= $paperData->colDefault && $request->rowStart <= $paperData->rowDefault) {
            $barcodeOutput = [];
            $tempArr = [];
            if($request->has('rackId')) {
                $subshelfData = \App\Models\Subshelf::with(['rack', 'shelf'])->where('rack_id', $request->rackId)->get();
            } else {
                $subshelfData = \App\Models\Subshelf::with(['rack', 'shelf'])->whereIn('subshelf_id', $request->selectSubshelf)->get();
            }
            // dd(['su' => $subshelfData]);
            if(!empty($subshelfData)) {
                foreach($subshelfData as $index => $barcode) {
                    $barcodeOutput[$barcode->subshelf_barcode] = 1;
                    $tempArr['textBarcode'][$barcode->subshelf_barcode] = $barcode->rack->rack_no . "-" . $barcode->shelf->shelf_no . "-" . $barcode->subshelf_no;
                    $jsBarcode[$barcode->subshelf_barcode] = $barcode->subshelf_barcode;
                }
            } else {
                dd('empty subshelf data');
            }

            $data = ['rowStart' => $request->rowStart, 'colStart' => $request->colStart, 'tempBarcode' => $barcodeOutput, 'jsBarcode' => $jsBarcode];
            // dd($data);
				$setPage = $paperData;
				if ($setPage) {
                    $data = $this->_setBarcodeDataCustom($data, $setPage, $tempArr['textBarcode'], 1, 1);
                    // dd($data);
					return view('warehouse.print._lab_js_barcode', $data);

				} else {
					dd('can\'t print barcode');
				}
            // $subshelfData = \App\Models\Subshelf::with(['shelf' => function($q) {
            //     $q->leftJoin('rack', function ($join) {
            //         $join->on('shelf.rack_id', '=', 'rack.rack_id');
            //     });
            //     $q->select(DB::Raw('CONCAT(rack.rack_no)'))
            // }])->whereIn('subshelf_id', $request->selectSubshelf)->get();


        }

    }

    private function _setBarcodeDataCustom($tempBarcode, $setPage = [], $textBarcode = [], $isSubshelf = 0, $showText = 1){
		$rowStart = !empty($tempBarcode['rowStart']) ? $tempBarcode['rowStart'] : 1;
		$colStart = !empty($tempBarcode['colStart']) ? $tempBarcode['colStart'] : 1;
// dd(['col' => $colStart, 'row' => $rowStart, 'data' => $tempBarcode]);
		$data = array(
			'widthBox' => $setPage->widthBox,
			'heightBox' => $setPage->heightBox,
			'gapRow' => $setPage->gapRow,
			'gapCol' => $setPage->gapCol,
			'rowDefault' => $setPage->rowDefault,
			'colDefault' => $setPage->colDefault,
			'pageSpaceL' => $setPage->pageSpaceL,
			'pageSpaceR' => $setPage->pageSpaceR,
			'pageSpaceT' => $setPage->pageSpaceT,
			'pageSpaceB' => $setPage->pageSpaceB,
			'pageWidth' => $setPage->pageWidth,
			'pageHeight' => $setPage->pageHeight,
			'barcodePaddingL' => $setPage->barcodePaddingL,
			'barcodePaddingR' => $setPage->barcodePaddingR,
			'barcodePaddingT' => $setPage->barcodePaddingT,
			'barcodePaddingB' => $setPage->barcodePaddingB,
			'borderline' => 0.1,
			'rowStart' => $rowStart,
			'colStart' => $colStart,
			'border' => $setPage->border,
			'barcode' => $tempBarcode['tempBarcode'],
			'jsBarcode' => $tempBarcode['jsBarcode'],
			'isSubshelf' => $isSubshelf,
			'showText' => $showText,
			'warehouse_id' => $this->warehouseData->warehouse_id,
		);
		$data['textBarcode'] = $textBarcode;
		return $data;
	}

    public function printRack($rackId = NULL) {
		if(!is_numeric($this->input->get('col')) || !is_numeric($this->input->get('row'))) {
			$this->session->set_flashdata('error', '<div class="alert alert-danger">' . lang('print_barcode_setpage_error') . '</div>');
			redirect('managerack/search');
		} 
		$rowStart = (int) $this->input->get('row');
		$colStart = (int) $this->input->get('col'); 
		$paperData = $this->paper_model->getPaperDataBarcodeById(6);

		if (!empty($rowStart) && !empty($colStart) && $colStart <= $paperData->colDefault && $rowStart <= $paperData->rowDefault) {
			$barcodeOutput = [];
			$subshelfData = $this->rack_model->getSubshelfData($rackId, NULL, TRUE, NULL, NULL, 'shelf_no ASC');
			if (!empty($subshelfData)) {
				foreach ($subshelfData as $ss) {
					$subshelfNo = $this->rack_model->getSubshelfNoByBarcode($ss->subshelf_barcode);
					$barcodeOutput[$ss->subshelf_barcode] = '1';
					$tempArr['textBarcode'][$ss->subshelf_barcode] = $subshelfNo;
					$jsBarcode[$ss->subshelf_barcode] = $ss->subshelf_barcode;
				}

				$data = ['rowStart' => $rowStart, 'colStart' => $colStart, 'tempBarcode' => $barcodeOutput, 'jsBarcode' => $jsBarcode];
				$setPage = $this->selectTypeDefinePaper(6);
				if ($setPage) {
                    $barcodeData = $this->_setBarcodeDataCustom($data, $setPage, $tempArr['textBarcode'], 1, 1);
                    return view('warehouse.print._lab_js_barcode', $barcodeData);
					// $this->load->view('pdf/_lab_js_barcode', $barcodeData);

				} 
			} else {
				$this->session->set_flashdata('error', '<div class="alert alert-danger">' . lang('print_barcode_setpage_error') . '</div>');
				redirect('managerack/search');
			}
		} else {
			$this->session->set_flashdata('error', '<div class="alert alert-danger">' . lang('print_barcode_setpage_error') . '</div>');			
			redirect('managerack/search');
		}
	}
}
