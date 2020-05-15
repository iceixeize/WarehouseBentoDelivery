<?php

namespace Tests\Unit\Repositories;

use App\Models\User;
use App\Repositories\UserRepository;
use Tests\UnitTestCase;

class UserRepositoryTest extends UnitTestCase
{
    private $userRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = app()->make(UserRepository::class);
    }

    public function test_get_all_blocked_user()
    {
        $blockedUser1 = factory(User::class)->create([
            'is_blocked' => true,
        ]);
        $blockedUser2 = factory(User::class)->create([
            'is_blocked' => true,
        ]);
        $blockedUser3 = factory(User::class)->create([
            'is_blocked' => true,
        ]);
        $blockedUser4 = factory(User::class)->create([
            'is_blocked' => true,
        ]);
        $blockedUser5 = factory(User::class)->create([
            'is_blocked' => true,
        ]);

        factory(User::class)->create();
        factory(User::class)->create();
        factory(User::class)->create();
        factory(User::class)->create();
        factory(User::class)->create();

        $blckedUsers = $this->userRepository->getAllBlockedUsers();

        $this->assertSame([
            $blockedUser1->id,
            $blockedUser2->id,
            $blockedUser3->id,
            $blockedUser4->id,
            $blockedUser5->id,
        ], $blckedUsers->pluck('id')->toArray());
    }
}
