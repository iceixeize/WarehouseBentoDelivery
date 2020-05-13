<?php

namespace App\Repositories;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\UserRoles;

/**
 * Class UserRepository.
 */
class UserRolesRepository implements AllRepositoryInterface
{
    /**
     * Get's a post by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($id)
    {
        return UserRoles::find($id);
    }

    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function all()
    {
        return UserRoles::all();
    }

    /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($id)
    {
        UserRoles::destroy($id);
    }

    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function update($id, array $data)
    {
        UserRoles::find($id)->update($data);
    }
}
