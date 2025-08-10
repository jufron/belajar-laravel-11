<form wire:submit.prevent="save">
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
        {{-- * password --}}
        <div class="col-md-5 my-2">
            <label for="password" class="form-label">Password</label>
            <input
                type="password"
                class="form-control @error('form.password') is-invalid @enderror"
                id="password"
                wire:model="form.password"
                placeholder="masukkan password"
            />
            @error('form.password')
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
                class="form-control @error('form.password_confirmation') is-invalid @enderror"
                id="password_confirmation"
                wire:model.defer="form.password_confirmation"
                wire:model="form.password_confirmation"
                placeholder="konfirmasi password"
            />
            @error('form.password_confirmation')
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
