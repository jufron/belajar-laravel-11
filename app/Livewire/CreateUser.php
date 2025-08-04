<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class CreateUser extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function save ()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Logic to save the user would go here, e.g.:
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        session()->flash('message', 'User created successfully!');

        // Optionally reset the form fields
        $this->reset(['name', 'email', 'password']);

        // Redirect to a different page or stay on the same page
        $this->redirectRoute('user', navigate: true);
    }

    public function render()
    {
        return view('livewire.create-user');
    }
}
