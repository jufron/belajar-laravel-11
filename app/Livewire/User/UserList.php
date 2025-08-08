<?php

namespace App\Livewire\User;

use Livewire\Component;

class UserList extends Component
{
    public $user, $nomor;

    public function render()
    {
        return view('livewire.user.user-list');
    }
}
