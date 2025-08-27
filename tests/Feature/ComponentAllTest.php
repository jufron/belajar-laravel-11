<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ComponentAllTest extends TestCase
{
    public function test_component_counter1_excists()
    {
        Livewire::test('counter1')
            ->assertStatus(200);
    }

    public function test_component_counter1_excists_to_home()
    {
        $this->get('home')
            ->assertSeeLivewire('counter1');
    }

    public function test_component_counter1_increment()
    {
        Livewire::test('counter1', ['count' => 0, 'label' => 'counter-1'])
            ->assertSee('0')
            ->call('increment')
            ->assertSee('1');
    }

    public function test_component_counter1_decrement()
    {
        Livewire::test('counter1', ['count' => 0, 'label' => 'counter-1'])
            ->assertSee('0')
            ->call('decrement')
            ->assertSee('0');
    }
}
