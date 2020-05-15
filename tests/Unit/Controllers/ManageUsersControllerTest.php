<?php

namespace Tests\Unit\Controllers;

use App\Models\User;
use Tests\UnitTestCase;

class ManageUsersControllerTest extends UnitTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(factory(User::class)->create());
    }

    function test_show_all_blocked_users() 
    {
        $response = $this->get(route('users.index'));
        $response->assertStatus(200);
    }
}
