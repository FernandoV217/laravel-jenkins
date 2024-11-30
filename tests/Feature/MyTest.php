<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MyTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->getJson('/api/students');

        $response->assertStatus(200);
    }

    public function test_post_method(): void
    {
        $response = $this->postJson('/api/students', [
            'nombre' => 'fer',
            'edad' => 123
        ]);

        $response->assertStatus(201);
    }
}
