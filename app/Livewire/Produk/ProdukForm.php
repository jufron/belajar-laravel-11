<?php

namespace App\Livewire\Produk;

use Livewire\Component;
use App\Models\Produk;

class ProdukForm extends Component
{
    public $nama_produk;
    public $harga;
    public $stok;
    public $deskripsi;

    public function save ()
    {
        $dataValidated = $this->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string|max:1000',
        ]);

        // Logic to save the product would go here, e.g., using a model
        Produk::create($dataValidated);

        session()->flash('message', 'Produk berhasil ditambahkan!');

        // Optionally reset the form fields
        $this->reset(['nama_produk', 'harga', 'stok', 'deskripsi']);
        $this->dispatch('closeModal'); // Dispatch an event if needed
        $this->redirectRoute('produk', navigate: true); // Redirect to the produk page
    }

    public function render()
    {
        return view('livewire.produk.produk-form');
    }
}
