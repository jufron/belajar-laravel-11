<?php

namespace App\Livewire\Produk;

use App\Models\Produk;
use Livewire\Component;

class ProdukList extends Component
{
    public $keyword = '';

    protected $listeners = [
        'searchUpdated' => 'setKeyword',
    ];

    public function setKeyword($value)
    {
        $this->keyword = $value;
    }

    public function getProduksProperty()
    {
        return Produk::where('nama', 'like', '%' . $this->keyword . '%')
            ->orWhere('deskripsi', 'like', '%' . $this->keyword . '%')
            ->get();
    }

    public function render()
    {
        return view('livewire.produk.produk-list', []);
    }
}
