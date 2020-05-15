<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\MyController;
use Illuminate\Http\Request;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepository as UserRepository;
use App\Repositories\UserRolesRepository;

class ManageUserController extends MyController
{
    protected $userRepository;
    protected $userRoles;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(UserRepository $userRepository, UserRolesRepository $userRoles)
    {
        $this->userRepository = $userRepository;
        $this->userRoles = $userRoles;
    }

    public function index(Request $request)
    {
        return view('manage._manage_user');
    }
    
    public function datatable(Request $request) {
        $data = \App\User::with('userRoles');
            if(!$this->isSuperAdmin()) {
                $data->where('user_roles_id', '!=', 1);
            }

            $data = $data->paginate($request->length);
            return new DataTableCollectionResource($data);
    }

    /**
     * Show the user with the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $data = $this->users->get($id);
        dd(['data' => $data]);
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userRoles = $this->userRoles->all();
        return view('manage._create_user', ['userRoles' => $userRoles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\CreateUserRequest $request)
    // public function store(Request $request)

    {
        $data = (array) $request->all();
        // dd(['data' => $data]);
        $create = $this->users->create($data);

        if($create) {
            return redirect()->route('users.index')->with('success', 'เพิ่มผู้ใช้แล้ว');
        } else {
            return redirect()->route('users.index')->with('error', 'ไม่สามารถเพิ่มผู้ใช้ได้ กรุณาลองอีกครั้ง');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $roles = [];

        if($this->isSuperAdmin()) {
            $roles = $this->getUserRoles();

            if(empty($roles)) {
                return redirect()->route('dashboard');
            }
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
        $params = [];

        if($request->has('firstname')) {
            $params['firstname'] = $request->firstname;
        }
        if($request->has('lastname')) {
            $params['lastname'] = $request->lastname;
        }
        if($request->has('idCard')) {
            $params['id_card'] = $request->idCard;
        }
        if($request->has('tel')) {
            $params['tel'] = $request->tel;
        }
        if($request->has('gender')) {
            $params['gender'] = $request->gender;
        }
        if($request->has('birthday')) {
            $params['birthday'] = $request->birthday;
        }
        $update = $this->users->update($id, $params);

        if($this->isSuperAdmin() && empty($this->userRoles)) {
            return redirect()->route('dashboard')->with('error', 'ไม่สามารถทำรายการได้ กรุณาตรวจสอบ User roles ในระบบ');
        }

        if(!$update) 
        {
            return redirect()->route('dashboard')->with('error', 'ไม่สามารถทำรายการได้ กรุณาลองอีกครั้ง');
        }
        else 
        {
            return redirect()->route('users.edit', [$id])->with('success', 'แก้ไขรายการสำเร็จ');
        }
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

    public function showAllBlockedUsers() {
        $this->userRepository->getAllBlockedUsers();
    }
}
