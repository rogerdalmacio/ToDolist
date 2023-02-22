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
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. '46|FlCLctbUvj3fRIiPNI2aGVANlqxpC9HHI9BujDNa',
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
