<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class deleteTodoTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. '46|FlCLctbUvj3fRIiPNI2aGVANlqxpC9HHI9BujDNa',
        ])->delete('/api/todo'); // add todo id in the url eg. /api/todo/{id}

        $response->assertStatus(202)
            ->assertJsonFragment([
                'To do successfully deleted'
            ]);
    }
}
