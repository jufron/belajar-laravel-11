<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Session;
use App\Models\User;

new class extends Component {
    #[Session(key: 'search-user')]
    public string $search = '';

    #[Computed]
    public function users ()
    {
        return User::query()
            ->when($this->search, function ($query) {
                return $query->where('name', 'like', '%' . $this->search . '%')
                             ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->get();
    }
}; ?>

<div>
    <input
        type="text"
        wire:model.live.debounce.500ms="search"
        placeholder="Search User..."
        class="border p-2 rounded w-full mb-4"
    />

    <ul>
        <x-table :labels="['Name', 'Email']">
            @forelse ($this->users as $user)
                <tr>
                    <td class="border border-gray-200 px-4 py-2">{{ $user->name }}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $user->email }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="border border-gray-200 px-4 py-2 text-center">
                        No users found.
                    </td>
                </tr>
            @endforelse
        </x-table>
    </ul>
</div>
