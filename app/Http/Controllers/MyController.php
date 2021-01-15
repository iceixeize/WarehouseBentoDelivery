<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use URL;

class MyController extends Controller
{

    protected $warehouseData = [];
    protected $userRoles = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    $url = parse_url(URL::current());
    $domain = explode('.', $url['host']);
    $subdomain = $domain[0];

    // dd(['subdomain' => $subdomain]);
        // $parameters = $request->route()->parameters();
    //  dd(['p' => $parameters, 'sub' => request("sub")]);

        // if(isset($subdomain) && !empty($subdomain)) {
        //     $this->warehouseData = app('warehouse', ['subdomain' => $subdomain]);
        // }

        // $this->userRoles = \App\Models\UserRoles::all();
    }

    protected function getWarehouseData()
    {
        return $this->warehouseData;
    }

    protected function getUserRoles()
    {
        return $this->userRoles;
    }

    protected function isSuperAdmin()
    {
        return Auth::user()->userRoles->is_super_admin;
    }

    protected function isBlocked()
    {
        return Auth::user()->is_blocked;
    }


}
