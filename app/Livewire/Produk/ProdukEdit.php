<?php

namespace App\Livewire\Produk;

use Livewire\Component;

class ProdukEdit extends Component
{
    public $produkID, $nama, $deskripsi, $harga, $stok;

    protected $listener = [
        'edit'  => 'loadProduk',
    ];

    public function loadProduk ($id)
    {
        $produk = Produk::findOrFail($id);

        $this->produkID = $produk->id;
        $this->nama = $produk->nama;
        $this->deskripsi = $produk->deskripsi;
        $this->harga = $produk->harga;
        $this->stok = $produk->stok;
    }

    public function render()
    {
        return view('livewire.produk.produk-edit');
    }
}
