<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Login');
        $response->assertDontSee('Dashboard');

        $user = \App\Models\User::first();
        if ($user) {
            $authResponse = $this->actingAs($user)->get('/');
            $authResponse->assertStatus(200);
            $authResponse->assertSee('Dashboard');
            $authResponse->assertSee(route('admin.dashboard'));
        }
    }
}
