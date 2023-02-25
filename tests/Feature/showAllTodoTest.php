<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class showAllTodoTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {

        $response = $this->post('/api/login', [
            'email' => 'nernser@example.net',
            'password' => 'password'
        ]);

        $token = $response->json(['token']);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->get('/api/todo');

        $response->assertStatus(200);

        $this->assertFalse($response->getStatusCode() == '500');
    }
}
