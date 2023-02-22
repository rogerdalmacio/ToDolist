<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class registerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->post('/api/register',[
            'name' => 'testUser',
            'email' => 'testemail@gmail.com',
            'password' => 'password'
        ]);

        $token = $response->json(['token']);

        $response->assertStatus(201)
            ->assertJsonCount(2)
            ->assertJsonFragment(['name' => $response->json(['name'])]);

    }
}
