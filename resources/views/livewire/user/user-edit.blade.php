<div class="container">
    <h1 class="mt-4">Edit User</h1>
    <form wire:submit.prevent="update">
        <div class="row">
            {{-- * name --}}
            <div class="col-md-5 my-2">
                <label for="name" class="form-label">Username</label>
                <input
                    type="text"
                    class="form-control @error('form.name') is-invalid @enderror"
                    id="name"
                    wire:model="form.name"
                    placeholder="masukkan nama"
                />
                @error('form.name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- * email --}}
            <div class="col-md-5 my-2">
                <label for="email" class="form-label">Email</label>
                <input
                    type="email"
                    class="form-control @error('form.email') is-invalid @enderror"
                    id="email"
                    wire:model="form.email"
                    placeholder="masukkan email"
                />
                @error('form.email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        {{-- ? submit button --}}
        <div class="col-md-5 mt-3">
            <button type="submit" class="btn btn-primary">Perbaharui</button>
            <a class="btn btn-secondary" href="{{ route('user') }}" wire:navigate>Kembali</a>
        </div>
    </form>
</div>
