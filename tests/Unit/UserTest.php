<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function a_user_has_projects()
    {
        $user = User::factory()->create();
        $this->assertNotNull($user->projects);
    }
}
