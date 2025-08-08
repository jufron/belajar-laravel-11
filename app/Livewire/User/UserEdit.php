<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use App\Livewire\Forms\UserForm;

class UserEdit extends Component
{
    public UserForm $form;
    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;

        $this->form->name = $user->name;
        $this->form->email = $user->email;
    }

    public function update ()
    {
        $this->form->updateUser($this->user);
        return $this->redirectRoute('user', navigate: true);
    }

    public function render()
    {
        return view('livewire.user.user-edit');
    }
}
