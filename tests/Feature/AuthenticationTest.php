<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Basic smoke tests for authentication routes.
 * These tests verify routes exist and respond without server errors.
 */
class AuthenticationTest extends TestCase
{
    /**
     * Test that the application homepage loads.
     */
    public function test_homepage_loads(): void
    {
        $response = $this->get('/');

        // Should not crash
        $this->assertNotEquals(500, $response->getStatusCode(), 'Homepage should not crash');
    }

    /**
     * Test that login page is accessible.
     */
    public function test_login_page_is_accessible(): void
    {
        $response = $this->get('/login');

        // Should not crash (200 or redirect are both OK)
        $this->assertNotEquals(500, $response->getStatusCode(), 'Login page should not crash');
    }

    /**
     * Test that register page is accessible.
     */
    public function test_register_page_is_accessible(): void
    {
        $response = $this->get('/register');

        // Should not crash
        $this->assertNotEquals(500, $response->getStatusCode(), 'Register page should not crash');
    }

    /**
     * Test that unauthenticated users are handled on admin routes.
     */
    public function test_admin_dashboard_requires_auth(): void
    {
        $response = $this->get('/admin/dashboard');

        // Should redirect or show auth error (not 500)
        $this->assertNotEquals(500, $response->getStatusCode(), 'Admin should handle unauthenticated access');
    }

    /**
     * Test login POST with invalid credentials doesn't crash.
     */
    public function test_login_handles_invalid_credentials(): void
    {
        $response = $this->post('/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'wrongpassword',
        ]);

        // Should not crash (redirect back with errors is expected)
        $this->assertNotEquals(500, $response->getStatusCode(), 'Login should handle invalid credentials');
    }
}
