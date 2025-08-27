<?php

use Livewire\Volt\Component;

new class extends Component {
    public int $count = 0;
    public string $label;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        if ($this->count > 0) {
            $this->count--;
        }
    }
}

?>

<div>
    <h1 class="text-3xl font-bold my-10">{{ $count }}</h1>
    <button
        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
        wire:click="increment"
        >
        Tambah
    </button>
    <button
        class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50"
        wire:click="decrement">
        Kurang
    </button>
</div>

