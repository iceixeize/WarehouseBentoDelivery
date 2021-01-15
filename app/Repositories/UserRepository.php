<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function get(int $id): User
    {
        return User::find($id);
    }

    public function create(array $params = []): User 
    {
        return User::create($params);
    }

    public function all(): Collection
    {
        return User::all();
    }

    public function delete($id): int
    {
        return User::destroy($id);
    }

    public function update(int $id, array $data): int
    {
        return User::where('user_id', $id)->update($data);
    }

    public function getAllBlockedUsers(): Collection
    {
        return User::where('is_blocked', true)->get();
    }
}
