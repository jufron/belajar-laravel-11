<div>
    <input
        type="text"
        wire:model="message"
        placeholder="Tulis pesan..."
        class="border p-1"
    />
    <button wire:click="send" class="btn btn-primary">Kirim</button>
</div>
