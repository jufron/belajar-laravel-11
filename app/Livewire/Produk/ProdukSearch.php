<?php

namespace App\Livewire\Produk;

use Livewire\Component;

class ProdukSearch extends Component
{
    public $search = '';

    public function updateSearch ()
    {
        $this->emit('searchUpdated', $this->search);
    }

    public function render()
    {
        return view('livewire.produk.produk-search');
    }
}
