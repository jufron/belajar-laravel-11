<button class="btn btn-info" data-url="{{ route('get.user.id', $id) }}" id="buttonShow">
    <i class="fa-solid fa-circle-info"></i>
</button>
<button
    class="btn btn-warning"
    data-url-edit="{{ route('get.user.id', $id) }}"
    data-url-update="{{ route('update.user.id', $id) }}"
    id="buttonEdit"
    >
    <i class="fa-solid fa-pen-to-square"></i>
</button>
<button class="btn btn-danger" data-url="{{ route('delete.user.id', $id) }}" id="buttonDelete">
    <i class="fa-solid fa-trash"></i>
</button>
