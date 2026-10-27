<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test halaman utama website.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $this->seed();
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Test route dashboard mengarahkan guest ke admin dashboard lalu login.
     */
    public function test_guest_is_redirected_to_login_from_admin_dashboard(): void
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/login');
    }

    /**
     * Test route /dashboard mengarahkan ke /admin/dashboard.
     */
    public function test_dashboard_shortcut_redirects_to_admin_dashboard(): void
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect(route('admin.dashboard'));
    }
}
