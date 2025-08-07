<?php

namespace App\Livewire;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;

class CreateUser extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    protected function rules () : array
    {
        return (new UserRequest())->rules();
    }

    protected function messages () : array
    {
        return (new UserRequest())->messages();
    }

    public function save ()
    {
        $dataValidated = $this->validate();

        User::create($dataValidated);

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
