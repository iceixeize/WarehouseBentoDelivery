<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\MyController;
use Illuminate\Http\Request;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;
use Auth;
use App\User;
use App\Models\UserRoles;
use Illuminate\Support\Facades\Hash;

class ManageUserController extends MyController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // protected $dataTableRelationships = [
    //     "belongsTo" => [
    //         'role' => [
    //             "model" => \App\Models\UserRoles::class,
    //             'foreign_key' => 'user_roles_id',
    //             'columns' => [
    //                 'name' => [
    //                     'searchable' => true,
    //                     'orderable' => true,
    //                 ],
    //             ],
    //         ],
    //     ],
    // ];

    // public function userRoles()
    // {
    //     return $this->belongsTo(\App\Models\UserRoles::class);
    // }

    public function index(Request $request)
    {
        return view('manage._manage_user');
    }

    public function datatable(Request $request) {
        $data = User::with('userRoles');
            if(!$this->isSuperAdmin()) {
                $data->where('user_roles_id', '!=', 1);
            }

            $data = $data->paginate($request->length);
            // dd(['data' => $data]);
            return new DataTableCollectionResource($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $userRoles = UserRoles::all();
        return view('manage._create_user', ['userRoles' => $userRoles]);
        // dd(['create' => 'create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\CreateUserRequest $request)
    {
        $data = (array) $request->all();
        $create = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'gender' => $data['gender'],
            'user_roles_id' => $data['userRolesId'],
            'id_card' => $data['idCard'],
            'birthday' => $data['birthday'],
            'tel' => $data['tel'],
        ]);

        if($create) {
            return redirect()->route('users.index')->with('success', 'เพิ่มผู้ใช้แล้ว');
        } else {
            return redirect()->route('users.index')->with('error', 'ไม่สามารถเพิ่มผู้ใช้ได้ กรุณาลองอีกครั้ง');
        }
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
    public function edit($id)
    {
        //
        // dd(['edit_id' => $id]);
        $roles = [];
        if($this->isSuperAdmin()) {
            $roles = $this->getUserRoles();
        }
        return view('manage._edit_user', ['userData' => Auth::user(), 'id' => $id, 'roles' => $roles]);
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
}
