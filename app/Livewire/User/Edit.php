<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('edit user')]
class Edit extends Component
{
    public function render()
    {
        return view('livewire.user.edit');
    }
}
