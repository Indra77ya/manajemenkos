<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Branch;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        // Seed roles as migration does
        if (Role::count() === 0) {
            Role::create(['name' => 'admin', 'label' => 'Administrator']);
            Role::create(['name' => 'staff', 'label' => 'Staff']);
            Role::create(['name' => 'tenant', 'label' => 'Tenant']);
        }
    }

    public function test_admin_can_view_users_list()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($admin)->get(route('admin.pengguna'));
        $response->assertStatus(200);
    }

    public function test_admin_can_create_user()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $branch = Branch::create(['name' => 'Cabang Pusat', 'address' => 'Jl. Pusat No 1']);
        Storage::fake('public');
        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->actingAs($admin)->post(route('admin.pengguna.store'), [
            'name' => 'New User',
            'username' => 'newuser',
            'email' => 'new@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'staff',
            'branch_id' => $branch->id,
            'status' => '1',
            'photo' => $file,
        ]);

        $response->assertRedirect(route('admin.pengguna'));
        $this->assertDatabaseHas('users', ['email' => 'new@example.com', 'username' => 'newuser']);
    }

    public function test_validation_fails_if_staff_missing_branch()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post(route('admin.pengguna.store'), [
            'name' => 'Staff User',
            'email' => 'staff@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'staff',
            'branch_id' => null, // Should fail
            'status' => '1',
        ]);

        $response->assertSessionHasErrors('branch_id');
    }

    public function test_admin_can_update_user()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $branch = Branch::create(['name' => 'Cabang Pusat', 'address' => 'Jl. Pusat No 1']);
        $user = User::factory()->create(['role' => 'staff', 'name' => 'Old Name', 'branch_id' => $branch->id]);

        $response = $this->actingAs($admin)->put(route('admin.pengguna.update', $user), [
            'name' => 'New Name',
            'username' => 'updateduser',
            'email' => $user->email,
            'role' => 'staff',
            'branch_id' => $branch->id, // Required for staff
            'status' => '1',
        ]);

        $response->assertRedirect(route('admin.pengguna'));
        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'New Name']);
    }

    public function test_login_with_username()
    {
        $user = User::factory()->create([
            'username' => 'johndoe',
            'password' => bcrypt('password'),
            'status' => true
        ]);

        $response = $this->post('/login', [
            'login' => 'johndoe',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);
    }
}
