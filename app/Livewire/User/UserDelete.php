<?php

namespace App\Livewire\User;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Livewire\Component;

class UserDelete extends Component
{
    public User $user;
    public UserForm $form;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->form->deleteUser($this->user);
        return $this->redirectRoute('user', navigate: true);
    }

    public function render()
    {
        return null;
        // return view('livewire.user.user-delete');
    }
}
