<?php

namespace App\Livewire\User;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('tambah user')]
class Tambah extends Component
{
    public function render()
    {
        return view('livewire.user.tambah');
    }
}
