<?php

namespace App\Livewire\User;

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

    public function placeholder()
    {
        return <<<'HTML'
        <div>
            <h1>Loading</h1>
        </div>
        HTML;
    }

    public function render()
    {
        // $user = User::query()
        // ->where('name', 'like', '%' . $this->search . '%')
        // ->get();

        return view('livewire.user.search-user', [
            // 'user'  => $user,
        ]);
    }
}
