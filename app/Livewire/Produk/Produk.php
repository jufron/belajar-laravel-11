<?php

namespace App\Livewire\Produk;

use Livewire\Component;

class Produk extends Component
{
    public $search = '';
    public $produkID = null;

    protected $listener = [
        'produkSesuaiPencarian' => 'setSearch',
        'editProduk' => 'setProdukID',
    ];

    public function setSearch($value)
    {
        $this->search = $value;
    }

    public function setProdukID($id)
    {
        $this->produkID = $id;
    }

    public function render()
    {
        return view('livewire.produk.produk');
    }
}
