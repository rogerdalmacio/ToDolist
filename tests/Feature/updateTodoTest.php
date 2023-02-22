<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class updateTodoTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. '46|FlCLctbUvj3fRIiPNI2aGVANlqxpC9HHI9BujDNa',
        ])->patch('/api/todo/5',[
            'title' => 'newtitle',
            'todo' => 'newtodo'
        ]); // add todo id in the url eg. /api/todo/{id}

        $response->assertStatus(201)
        ->assertJsonFragment([
            'To do successfully updated'
        ]);
    }
}
