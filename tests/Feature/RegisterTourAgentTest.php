<?php

namespace Tests\Feature;

use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class RegisterTourAgentTest extends TestCase
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
            'role' => 'tour-agent',
            'company' => $faker->company,
            'address' => $faker->address,
            'position' => $faker->word,
            'work_email' => $faker->email,
            'website' => $faker->url,
            'last_name' => $faker->lastName,
            'first_name' => $faker->firstName,
            'middle_name' =>  $faker->firstName,
            'birthday' => $faker->date,
            'email' => $faker->email,
            'mobile_phone' => '+38 (033) 333-33-33',
            'password' => 'passwordtest',
            'password_confirmation' => 'passwordtest'
        ];

        $response = $this->post('/auth/register?tour_agent', $user);

        $response
            ->assertSessionDoesntHaveErrors()
            ->assertRedirect('/register/success')
            ->assertSessionHas('newUser');

        $this->assertDatabaseHas('users', Arr::only($user, 'email'));
    }
}
