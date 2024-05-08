<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GuestUserTest extends TestCase
{

    public function test_welcome_page_loads()
    {
        // Act: Make a GET request to the welcome page route
        $response = $this->get('/');

        // Assert: Check for status code and view
        $response->assertStatus(200);
        $response->assertViewIs('welcome');
    }

    public function test_welcome_page_has_pizzas()
    {
        // Act: Make a GET request to the welcome page route
        $response = $this->get('/');
        // Assert: Verify the pizzas are passed to the view
        $response->assertViewHas('pizzas');
    }

    public function test_welcome_page_has_toppings()
    {
        // Act: Make a GET request to the welcome page route
        $response = $this->get('/');

        // Assert: Verify the toppings are passed to the view
        $response->assertViewHas('toppings');
    }
}
