<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class createTodoTest extends TestCase
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
        ])->post('/api/todo',[
            'title' => 'test title',
            'todo' => 'test todo'
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'To do successfully added'
            ]);
    }
}
