<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class NavigationTest extends TestCase
{
    use RefreshDatabase;

    public function test_navigation_displays_user_photo()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'photo_path' => 'profile-photos/test.jpg',
            'role' => 'admin',
        ]);

        $response = $this->actingAs($user)->get(route('admin.dashboard')); // Fix: Use correct route

        $response->assertStatus(200);
        $response->assertSee('src="http://localhost/storage/profile-photos/test.jpg"', false);
    }

    public function test_navigation_displays_placeholder_when_no_photo()
    {
        $user = User::factory()->create([
            'name' => 'Test User No Photo',
            'photo_path' => null,
            'role' => 'admin',
        ]);

        $response = $this->actingAs($user)->get(route('admin.dashboard')); // Fix: Use correct route

        $response->assertStatus(200);
        $response->assertDontSee('src="http://localhost/storage/"', false);
        // It should see the SVG path d="..."
        $response->assertSee('M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z');
    }
}
