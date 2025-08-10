<?php

namespace App\Livewire;

use App\Http\Requests\UserRequest;
use App\Livewire\Forms\UserForm;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;

class CreateUser extends Component
{
    public UserForm $form;

    public function save ()
    {
        $this->form->createUser();
        session()->flash('message', 'User created successfully!');
        $this->reset();
        $this->redirectRoute('user', navigate: true);
    }

    public function render()
    {
        return view('livewire.create-user');
    }
}
