<tr>
    <th scope="row">{{ $nomor }}</th>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
        <a class="btn btn-info" href="{{ route('user-show', $user->id) }}" wire:navigate>Detail</a>
        <a class="btn btn-warning" href="{{ route('user-edit', $user->id) }}" wire:navigate>Edit</a>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModalUser{{ $user->id }}">
            Delete
        </button>

        <div class="modal fade" id="deleteModalUser{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalUserLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus user tersebut</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a
                            href="{{ route('user-delete', $user->id) }}"
                            class="btn btn-primary"
                            wire:navigate>
                            Hapus
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </td>
</tr>
