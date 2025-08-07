<?php

namespace App\Livewire\Produk;

use Livewire\Component;
use App\Livewire\Forms\ProdukForm;

class CreateProduk extends Component
{
    public ProdukForm $form;

    public function save ()
    {
        $this->form->store();
        $this->dispatch('closeModal'); // Dispatch an event if needed
        return $this->redirectRoute('produk', navigate: true); // Redirect to the produk page
    }

    public function render()
    {
        return view('livewire.produk.create-produk');
    }
}
