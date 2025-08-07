<div class="container">
    <h1>Daftar produk</h1>

    {{-- session flesh --}}
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    {{-- ? add produk button modal --}}
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add-produk">
        Tambah Produk
    </button>

    {{-- ? produk modal --}}
    <div class="modal fade" id="modal-add-produk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <livewire:produk.create-produk />
            </div>
        </div>
    </div>

    <livewire:produk.produk-search />
    <livewire:produk.produk-list />

    <livewire:message.send-message />
    <livewire:message.show-message />

</div>
