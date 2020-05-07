<?php

namespace App\Http\Controllers\Warehouse\Rack;

use App\Http\Controllers\MyController;
use Illuminate\Http\Request;

class ShelfController extends MyController
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
    // public function edit($subdomain = '', $id = '', \App\Http\Requests\EditShelfRequest $request)
    // {
    //     //
    //     $rack = \App\Models\Rack::with(['shelf', 'subshelf'])->where('rack_id', $id)->first();
    //     if($rack) {
    //         if($request->has('shelfId')) {
    //             $arrayNewShelf = [];
    //             $arrayNewSubshelf = [];
    //             $arrayUpdateShelf = [];
    //             $seq = 1;

    //             $lastShelfId = array_filter($request->shelfId);  
    //             $arrayRemoveShelf = array_diff($rack->shelf()->pluck('shelf_id')->toArray(), $lastShelfId);
                
    //             // delete shelf
    //             if(!empty($arrayRemoveShelf)) {
    //                 $delShelf = $rack->shelf()->whereIn('shelf_id', $arrayRemoveShelf)->update([
    //                     'shelf_active' => 0
    //                 ]);
    //                 if(!$delShelf) {
    //                     \Log::info('**** can\'t delete shelf data id : ' . json_encode($arrayRemoveShelf));
    //                 }

    //                 $delSubshelf = $rack->subshelf()->whereIn('shelf_id', $arrayRemoveShelf)->update([
    //                     'subshelf_active' => 0
    //                 ]);
    //                 if(!$delShelf) {
    //                     \Log::info('**** can\'t delete subshelf data id : ' . json_encode($arrayRemoveShelf));
    //                 }
    //             }

    //             foreach($request->shelfId as $index => $shelfId) {

    //                 if(is_null($shelfId)) {
                        
    //                     $arrNewShelf = [
    //                         'shelf_no' => $request->shelfNo[$index],
    //                         'shelf_type_id' => $request->selectShelfType[$index],
    //                         'shelf_type' => $request->selectShelfUnit[$index],
    //                         'shelf_seq' => $request->shelfPickSeq[$index],
    //                         'rack_id' => $id,
    //                         'warehouse_id' => $rack->warehouse_id,
    //                         'shelf_active' => 1,

    //                     ];

    //                     if(!empty($arrNewShelf)) {
    //                         $newShelf = $rack->shelf()->insertGetId($arrNewShelf);
        
    //                         if(!$newShelf) {
    //                             \Log::info('**** can\'t new shelf data : ' . json_encode($arrayNewShelf));
    //                         }

                            
    //                     }

    //                     // $arrayNewSubshelf = [];
    //                         for($i = 1; $i <= config('btd.rack.default_subshelf'); $i++) {
    //                             $barcode = '';
    //                             $maxBarcode = \App\Models\BarcodeAutoNumber::addSelect('value', 'seq')
    //                                         ->where('keyword', 'subshelf')
    //                                         ->where('value', date('y') . date('m'))
    //                                         ->first();
        
    //                             if(is_null($maxBarcode)) {
    //                                 $updateBarcode = \App\Models\BarcodeAutoNumber::where('keyword', 'subshelf')
    //                                                 ->update(['seq' => 1, 'value' => date('y') . date('m')]);
    //                                 $barcode = config('btd.rack.barcode_prefix_ss') . date('y') . date('m') . (sprintf("%0" . config('btd.rack.barcode_length_subshelf') . "d", 1));
        
    //                                 $updateBarcode = \App\Models\BarcodeAutoNumber::where('keyword', 'subshelf')
    //                                                 ->update(['seq' => 2]);
    //                             } else if($maxBarcode->exists()) {
    //                                 $barcode = config('btd.rack.barcode_prefix_ss') . $maxBarcode->value . (sprintf("%0" . config('btd.rack.barcode_length_subshelf') . "d", $maxBarcode->seq));
    //                                 $updateBarcode = \App\Models\BarcodeAutoNumber::where('keyword', 'subshelf')
    //                                                 ->update(['seq' => $maxBarcode->seq + 1]);
    //                             } else {
    //                               // not exist  
    //                             }
        
    //                             $arrayNewSubshelf[] = [
    //                                 'subshelf_no' => $i,
    //                                 'warehouse_id' => $rack->warehouse_id,
    //                                 'rack_id' => $id,
    //                                 'subshelf_barcode' => $barcode,
    //                                 'shelf_id' => $newShelf,
    //                             ];
                                
    //                         }                            
                        
                            
                        

    //                     array_push($arrayNewShelf, $arrNewShelf);
    //                 } else {
    //                     $arrUpdate = [
    //                         'shelf_no' => $request->shelfNo[$index],
    //                         'shelf_type_id' => $request->selectShelfType[$index],
    //                         'shelf_type' => $request->selectShelfUnit[$index],
    //                         'shelf_seq' => $request->shelfPickSeq[$index],
    //                         'rack_id' => $id,
    //                         'warehouse_id' => $rack->warehouse_id,

    //                     ];
    //                     array_push($arrayUpdateShelf, $arrUpdate);

    //                     if(!empty($arrUpdate)) {
    //                         $update = $rack->shelf()->where('shelf_id', $shelfId)->update($arrUpdate);

    //                         if(!$update) {
    //                             \Log::info('**** can\'t update shelf data id : ' . $shelfId . ' data : ' . json_encode($arrUpdate));
    //                         }
    //                     }
    //                 }
                    
    //                 $seq++;
    //                 $arrNewShelf = [];
    //             }

                
    //             if(!empty($arrayNewSubshelf)) {
    //                 $newSubshelf = $rack->subshelf()->createMany(
    //                     $arrayNewSubshelf
    //                 );

    //                 if(!$newSubshelf) {
    //                     \Log::info('**** can\'t new shelf data : ' . json_encode($arrayNewSubshelf));
    //                 }
    //             }
    //             dd('case_1');
    //             // return redirect()->route('racks.show', ['id' => $id, 'subdomain' => $subdomain])->with('success', 'แก้ไขข้อมูลชั้นวางสินค้าแล้ว');

    //             // dd(['new' => $arrayNewShelf, 'update' => $arrayUpdateShelf, 'del' => $arrayRemoveShelf, 'new_subshelf' => $arrayNewSubshelf]);
    //         }
    //         dd('case_2');
    //         return redirect()->route('racks.show', ['id' => $id, 'subdomain' => $subdomain])->with('error', 'ไม่สามารถแก้ไขข้อมูลชั้นวางสินค้าได้ กรุณาลองอีกครั้ง');

    //     }
    //     echo 'edit : id => ' . $id;
    //     dd($request->all());
    // }

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
}
