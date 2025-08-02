<?php

namespace App\Livewire\User;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('user list')]
class User extends Component
{
    public function render()
    {
        return view('livewire.user.user');
    }
}
