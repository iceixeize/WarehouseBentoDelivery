<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Log;
use DB;
use Debugbar;

class ManageWarehouseController extends Controller
{
    private $userData;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = app('user', ['user_id' => Auth::user()->user_id]);
        
        if($request->ajax()){
            if($user->userRoles->is_super_admin) {
                $data = \App\Models\Warehouse::paginate(5);
                if(empty($data)) {
                    return response()->json(['success' => 0, 'data' => []]);
                } else {
                    return response()->json(['success' => 1, 'data' => $data]);
                }
            } else {
                dd('not super admin');
            }
        } else {
            return view('manage._choose_warehouse');
        }
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

    public function store(RackRequest $request) 
    {
        dd('store');
    }

    public function show()
    {
        dd('show');
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
