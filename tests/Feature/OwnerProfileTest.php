<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\OwnerProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class OwnerProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_owner_profile_page()
    {
        $user = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($user)->get(route('admin.owner-profil'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.pusat_data.owner_profil');
    }

    public function test_admin_can_update_owner_profile()
    {
        $user = User::factory()->create(['role' => 'admin']);
        Storage::fake('public');

        $file = UploadedFile::fake()->image('logo.jpg');

        $response = $this->actingAs($user)->put(route('admin.owner-profil.update'), [
            'nama_kost' => 'Kost Sejahtera',
            'nama_pemilik' => 'Budi',
            'alamat' => 'Jl. Mawar No. 1',
            'no_telepon' => '08123456789',
            'email' => 'kost@example.com',
            'logo' => $file,
        ]);

        $response->assertRedirect(route('admin.owner-profil'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('owner_profiles', [
            'nama_kost' => 'Kost Sejahtera',
            'email' => 'kost@example.com',
        ]);

        $profile = OwnerProfile::first();
        Storage::disk('public')->assertExists($profile->logo_path);
    }
}
