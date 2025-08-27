<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserSearchComponentTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_component_usersearch_exists()
    {
        Livewire::test('usersearch')
            ->assertStatus(200);
    }

    public function test_component_usersearch_exists_to_home()
    {
        $this->get(route('home'))
            ->assertSeeLivewire('usersearch');
    }

    public function test_component_usersearch ()
    {
        Livewire::test('usersearch')
            ->assertSee('Search User');
    }

    public function test_component_usersearch_when_user_search()
    {
        User::factory()->create([
            'name' => 'james',
            'email' => 'james@mail.com',
            'password' => bcrypt('password'),
        ]);

        Livewire::test('usersearch')
            ->set('search', 'james')
            ->assertSee('james')
            ->assertSee('james@mail.com');
    }

    public function test_component_usersearch_when_user_search_no_result()
    {
        User::factory()->create([
            'name' => 'james',
            'email' => 'james@mail.com',
            'password' => bcrypt('password'),
        ]);

        Livewire::test('usersearch')
            ->set('search', 'john')
            ->assertSee('No users found.');
    }
}
