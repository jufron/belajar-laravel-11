<form wire:submit.prevent="save">
    @if (session()->has('message'))
        <div class="col-md-5">
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        </div>
    @endif
    <div class="row">
        {{-- * name --}}
        <div class="col-md-5 my-2">
            <label for="name" class="form-label">Username</label>
            <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="name"
                wire:model="name"
                placeholder="masukkan nama"
            />
            @error('name')
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
                class="form-control @error('email') is-invalid @enderror"
                id="email"
                wire:model="email"
                placeholder="masukkan email"
            />
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        {{-- * password --}}
        <div class="col-md-5 my-2">
            <label for="password" class="form-label">Password</label>
            <input
                type="password"
                class="form-control @error('password') is-invalid @enderror"
                id="password"
                wire:model="password"
                placeholder="masukkan password"
            />
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        {{-- * confirm password --}}
        <div class="col-md-5 my-2">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input
                type="password"
                class="form-control @error('password_confirmation') is-invalid @enderror"
                id="password_confirmation"
                wire:model.defer="password_confirmation"
                wire:model="password_confirmation"
                placeholder="konfirmasi password"
            />
            @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    {{-- ? submit button --}}
    <div class="col-md-5 mt-3">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a class="btn btn-secondary" href="{{ route('user') }}" wire:navigate>Kembali</a>
    </div>
</form>
