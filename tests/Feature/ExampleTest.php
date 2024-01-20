<?php

namespace Tests\Feature;

use App\Domain\Users\User\Domain\Model\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function testGetProfile(): void
    {
        //        $this->artisan('optimize:clear');
        //        dd(Route::getRoutes());
        $user = User::factory()->create();

        $response = $this->getJson('/api/users/'.$user->id);

        $response->assertStatus(200)
            ->assertJson([
                'name' => $user->name,
                'email' => $user->email,
            ]);
    }
}
