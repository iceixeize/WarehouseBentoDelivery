<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository as UserRepository;
use App\Http\Controllers\MyController;

class UserController extends MyController
{
    /**
     * The user repository instance.
     */
    protected $users;

    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
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
}