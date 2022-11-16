<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RegisterTouristTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = [
            'role' => 'tourist',
            'last_name' => 'Smith',
            'first_name' => 'Joe',
            'middle_name' => 'Clark',
            'birthday' => '01.01.2000',
            'email' => 'maksym.shekhovtsev@gmail.com',
            'mobile_phone' => '+38 (033) 333-33-33',
            'password' => 'passwordtest',
            'password_confirmation' => 'passwordtest'
        ];

        $response = $this->post('/auth/register', $user);

        $response
            ->assertSessionDoesntHaveErrors()
            ->assertRedirect('/register/success')
            ->assertSessionHas('newUser');

        $this->assertDatabaseHas('users', Arr::only($user, 'email'));
    }
}
