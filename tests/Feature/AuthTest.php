<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\AssertableJsonString;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->post('/api/login',[
            'email' => 'nernser@example.net',
            'password' => 'password'
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonCount(2)
            ->assertJsonFragment([
                'name' => 'Delilah Beahan'
            ]);

        $response->assertJson(fn (AssertableJson $json) =>
            $json->hasAll('name','token')
                ->whereAllType([
                    'name' => 'string',
                    'token' => 'string'
                ])
        );

        $this->assertFalse($response->json()['name'] == 'James Smith');
        $this->assertFalse($response->getStatusCode() == '500');
    }
}
