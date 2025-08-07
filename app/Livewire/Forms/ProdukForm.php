<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Produk;
use Livewire\Attributes\Validate;

class ProdukForm extends Form
{
    public $idProduk = null;
    public $nama_produk;
    public $harga;
    public $stok;
    public $deskripsi;

    public function rules(): array
    {
        return [
            'nama_produk' => 'required|string|max:255|unique:produks,nama_produk,' . $this->idProduk,
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_produk.required' => 'Nama produk harus diisi.',
            'harga.required' => 'Harga produk harus diisi.',
            'stok.required' => 'Stok produk harus diisi.',
        ];
    }

    public function store () : void
    {
        $this->validate();
        Produk::create(
            $this->all()
        );
        session()->flash('message', 'Produk berhasil ditambahkan!');
        $this->reset();
    }

    public function update ($id)
    {
        $this->idProduk = $id;

        $this->validate();

        Produk::findOrFail($id)->update(
            $this->all()
        );
        session()->flash('message', 'Produk berhasil diperbarui!');
        $this->reset();
    }
}
