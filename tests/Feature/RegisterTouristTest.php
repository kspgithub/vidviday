<?php

namespace Tests\Feature;

use App\Models\User;
use Faker\Generator;
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
        $faker = $this->app->make(Generator::class);

        $user = [
            'role' => 'tourist',
            'last_name' => $faker->lastName,
            'first_name' => $faker->firstName,
            'middle_name' =>  $faker->firstName,
            'birthday' => $faker->date,
            'email' => $faker->email,
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
