<div class="container">
    <ul class="list-group my-5">
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-4">
                    Nama
                </div>
                <div class="col-md-8">
                    {{ $user->name }}
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-4">
                    Email
                </div>
                <div class="col-md-8">
                    {{ $user->email }}
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-4">
                    Created At
                </div>
                <div class="col-md-8">
                    {{ $user->created_at->format('d M Y H:i:s') }}
                </div>
            </div>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-4">
                    Updated At
                </div>
                <div class="col-md-8">
                    {{ $user->updated_at->format('d M Y H:i:s') }}
                </div>
            </div>
        </li>
    </ul>

    <a class="btn btn-secondary" href="{{ route('user') }}" wire:navigate>Kembali</a>
</div>
