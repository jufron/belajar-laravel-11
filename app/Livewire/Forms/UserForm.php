<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\User;
use Livewire\Attributes\Validate;

class UserForm extends Form
{
    public ?string $userId = null;

    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function rulesCreate(): array
    {
        return [
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6',
        ];
    }

    public function rulesUpdate(): array
    {
        return [
            'name' => 'required|string|max:255|unique:users,name,' . $this->userId,
            'email' => 'required|email|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa string.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'name.unique' => 'Nama sudah terdaftar.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi.',
            'password_confirmation.min' => 'Konfirmasi password minimal 8 karakter.',
            'password_confirmation.confirmed' => 'Konfirmasi password tidak cocok.',
            'password_confirmation.string' => 'Konfirmasi password harus berupa string.',
            'password.string' => 'Password harus berupa string.',
        ];
    }

    public function createUser () : void
    {
        $this->validate(
            $this->rulesCreate()
        );

        User::create(
            $this->all()
        );

        session()->flash('message', 'User created successfully!');
        $this->reset();
    }

    public function updateUser (User $user) : void
    {
        $this->userId = $user->id;

        $this->validate(
            $this->rulesUpdate()
        );

        $user->update(
            $this->only('name', 'email')
        );

        session()->flash('message', 'User updated successfully!');
        $this->reset();
    }

    public function deleteUser(User $user): void
    {
        $user->delete();
        session()->flash('message', 'User deleted successfully!');
        $this->reset();
    }
}
