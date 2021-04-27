<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        // $this->assertTrue(true);
        for($i = 0; $i < 100; $i++) {
            factory(User::class)->create();
        }

        $count = User::get()->count();
        $user = User::find(rand(1, $count));
        $data = $user->toArray();
        print_r($data);
        print_r($count);

        $this->assertDatabaseHas('users', $data);

        $user->delete();
        $this->assertDatabaseMissing('users', $data);

    }
}
