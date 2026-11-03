<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthRoleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        User::create([
            'name' => 'Rina Anggraini',
            'email' => 'user@aihealth.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Amélie Laurent',
            'email' => 'admin@aihealth.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }

    /**
     * Test that the login page renders properly.
     */
    public function test_login_page_renders_successfully(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Masuk ke Portal');
        $response->assertSee('Pasien / User');
        $response->assertSee('Administrator');
    }

    /**
     * Test that logging in as user redirects to patient dashboard.
     */
    public function test_user_login_redirects_to_home(): void
    {
        $response = $this->post('/login', [
            'email' => 'user@aihealth.com',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticated();
        $this->assertFalse(auth()->user()->isAdmin());
    }

    /**
     * Test that logging in as admin redirects to admin calendar portal.
     */
    public function test_admin_login_redirects_to_admin_portal(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin@aihealth.com',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticated();
        $this->assertTrue(auth()->user()->isAdmin());
    }

    /**
     * Test guest cannot access admin dashboard.
     */
    public function test_guest_is_redirected_from_admin_dashboard(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect(route('login'));
    }

    /**
     * Test regular user is redirected away from admin dashboard.
     */
    public function test_regular_user_cannot_access_admin_dashboard(): void
    {
        $user = User::where('role', 'user')->first();

        $response = $this->actingAs($user)->get('/admin');

        $response->assertRedirect(route('home'));
        $response->assertSessionHas('warning');
    }

    /**
     * Test admin can access admin calendar dashboard.
     */
    public function test_admin_can_access_admin_calendar_dashboard(): void
    {
        $admin = User::where('role', 'admin')->first();

        $response = $this->actingAs($admin)->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('Calendar');
        $response->assertSee('Amélie Laurent');
    }

    /**
     * Test quick login route for user.
     */
    public function test_quick_login_for_user(): void
    {
        $response = $this->get('/quick-login/user');

        $response->assertRedirect(route('home'));
        $this->assertAuthenticated();
        $this->assertEquals('user', auth()->user()->role);
    }

    /**
     * Test quick login route for admin.
     */
    public function test_quick_login_for_admin(): void
    {
        $response = $this->get('/quick-login/admin');

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticated();
        $this->assertEquals('admin', auth()->user()->role);
    }

    /**
     * Test logout redirects to login.
     */
    public function test_logout_redirects_to_login(): void
    {
        $user = User::where('role', 'user')->first();

        $response = $this->actingAs($user)->post('/logout');

        $response->assertRedirect(route('login'));
        $this->assertGuest();
    }
}
