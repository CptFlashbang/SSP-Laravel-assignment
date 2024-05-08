<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class LoggedUserTest extends TestCase
{
    use RefreshDatabase; // Ensures database is reset for each test if you're interacting with it.

    public function setUp(): void
    {
        parent::setUp();
        // Create a user for authentication tests
        $this->user = User::factory()->create();
    }

    public function test_dashboard_page_loads()
    {
        // Act: Make a GET request to the dashboard page as an authenticated user
        $response = $this->actingAs($this->user)->get('/dashboard');

        // Assert: Check for the correct view
        $response->assertViewIs('dashboard');
    }

    public function test_menu_page_loads()
    {
        // Act: Make a GET request to the menu page as an authenticated user
        $response = $this->actingAs($this->user)->get('/menu');

        // Assert: Check for the correct view
        $response->assertViewIs('pizzas.index');
    }

    public function test_menu_page_has_pizzas()
    {
        // Act: Make a GET request to the menu page as an authenticated user
        $response = $this->actingAs($this->user)->get('/menu');

        // Assert: Verify that pizzas are passed to the view
        $response->assertViewHas('pizzas');
    }

    public function test_menu_page_has_toppings()
    {
        // Act: Make a GET request to the menu page as an authenticated user
        $response = $this->actingAs($this->user)->get('/menu');

        // Assert: Verify that toppings are passed to the view
        $response->assertViewHas('toppings');
    }
}
