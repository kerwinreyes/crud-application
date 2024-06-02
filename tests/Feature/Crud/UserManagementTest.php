<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_users_page_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/users');

        $response->assertOk();
    }
    public function test_user_page_can_create(): void 
    {
        $user = User::factory()->create();
        $createData = [
            'first_name' => 'Test User',
            'last_name' => 'User',
            'username' => 'Username',
            'email' => 'tes1t@example.com',
            'password' => 'password',
            'address' => 'address',
            'postcode' => '123',
            'phone_number' => '095454534343',
            'password_confirmation' => 'password',
        ];
        $response = $this->actingAs($user)->post(route('users.store'), $createData);
        
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/dashboard');

        $user->refresh(); $this->assertDatabaseHas('users', [
            'username' => $user['username'],
            'email' => $user['email'],
        ]);

        $response->assertRedirect(route('dashboard'));
    }

    public function test_user_creation_fails_with_invalid_data(): void
    {
        $createData = [
            'first_name' => 'Test User',
            'last_name' => 'User',
            'username' => 'Username',
            'email' => 'tes',
            'password' => 'password',
            'address' => 'address',
            'postcode' => '123',
            'phone_number' => '095454534343',
            'password_confirmation' => 'password',
        ];
        $response = $this->post(route('users.store'), []);
    
        $response->assertSessionHasErrors([
            'email'
        ]);
    
        $this->assertDatabaseMissing('users', []);
    }
    public function test_user_can_be_updated(): void
    {
        $user = User::factory()->create();

        $updateData = [
            'first_name' => 'Test',
            'last_name' => 'User',
        ];

        $response = $this->actingAs($user)->patch(route('users.update', $user->id), $updateData);

        $response->assertRedirect(route('dashboard'));

        $user->refresh();

        $this->assertSame('Test', $user->first_name);
        $this->assertSame('User', $user->last_name);
    }

    public function test_user_can_be_delete(): void
    {
        $users = User::factory()->count(3)->create();
        $user = User::factory()->create();

        $ids = $users->pluck('id')->toJson();
        $response = $this->actingAs($user)->delete(route('users.destroy', $ids));

        $response->assertRedirect(route('dashboard'));
        foreach ($users as $user) {
            $this->assertDatabaseMissing('users', ['id' => $user->id]);
        }
    }
}
