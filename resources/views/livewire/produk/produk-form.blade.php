<form wire:submit.prevent="save">
    <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Produk</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        {{-- * nama produk --}}
        <div class="my-2">
            <label for="name" class="form-label">Nama Produk</label>
            <input
                type="text"
                class="form-control @error('nama_produk') is-invalid @enderror"
                id="name"
                wire:model="nama_produk"
                placeholder="masukkan nama produk"
            />
            @error('nama_produk')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        {{-- * harga --}}
        <div class="my-2">
            <label for="harga" class="form-label">Harga</label>
            <input
                type="number"
                class="form-control @error('harga') is-invalid @enderror"
                id="harga"
                wire:model="harga"
                placeholder="masukkan harga"
            />
            @error('harga')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        {{-- * stok --}}
        <div class="my-2">
            <label for="stok" class="form-label">Stok</label>
            <input
                type="number"
                class="form-control @error('stok') is-invalid @enderror"
                id="stok"
                wire:model="stok"
                placeholder="masukkan stok"
            />
            @error('stok')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        {{-- * deskripsi --}}
        <div class="my-2">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea
                class="form-control @error('deskripsi') is-invalid @enderror"
                id="deskripsi"
                wire:model="deskripsi"
                placeholder="masukkan deskripsi"
                rows="3"
            ></textarea>
            @error('deskripsi')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
