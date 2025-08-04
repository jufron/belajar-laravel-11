<div class="container">
    <h1>daftar user</h1>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a class="btn btn-primary" href="{{ route('user-tambah') }}" wire:navigate>tambah</a>

    <livewire:search-user />
</div>
