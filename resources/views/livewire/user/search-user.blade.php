<div>
    <form wire:submit='setSearch'>
        <div class="col-md-5 mt-3">
            <label for="search" class="form-label">Search</label>
            <input
                {{-- wire:model.live='search' --}}
                {{-- wire:model.live.debounce.500ms='search' --}}
                {{-- wire:keydown.enter='setSearch' --}}
                wire:model='query'
                class="form-control"
                id="search"
                placeholder="search..."
            />
        </div>
        <button class="btn btn-success my-2" type="submit">Search</button>
        <button class="btn btn-secondary" type="button" wire:click='resetHistory'>reset</button>
    </form>

    <h1>Daftar Pengguna</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Eamil</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $u)
            <livewire:user.user-list
                :user="$u"
                :key="$u->id"
                :nomor="$loop->iteration"
            />
            @endforeach
        </tbody>
    </table>
</div>
