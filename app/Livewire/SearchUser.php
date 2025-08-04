<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class SearchUser extends Component
{
    public string $query = '';

    public $user = [];

    // * ada method yang bernama mount
    // * method ini akan dipanggil pertama kali ketika komponen ini di render
    // * biasanya digunakan untuk inisialisasi data
    // * contoh: mengambil data dari database, menginisialisasi variabel, dll
    public function mount()
    {
        $this->user = User::all();
    }

    public function resetHistory()
    {
        $this->mount();
        $this->query = '';
    }

    public function setSearch ()
    {
        $this->user = User::query()->where('name', 'like', '%' . $this->query . '%')->get();
    }

    public function render()
    {
        // $user = User::query()
        // ->where('name', 'like', '%' . $this->search . '%')
        // ->get();

        return view('livewire.search-user', [
            // 'user'  => $user,
        ]);
    }
}
