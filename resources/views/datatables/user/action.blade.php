{{-- <a href="{{ route('get.user.id', $id) }}" class="btn btn-info">
    <i class="fa-solid fa-circle-info"></i>
</a> --}}
<button class="btn btn-info" data-url="{{ route('get.user.id', $id) }}" id="buttonShow">
    <i class="fa-solid fa-circle-info"></i>
</button>
<a href="{{ route('get.user.id', $id) }}" class="btn btn-warning">
    <i class="fa-solid fa-pen-to-square"></i>
</a>
<a href="{{ route('get.user.id', $id) }}" class="btn btn-danger">
    <i class="fa-solid fa-trash"></i>
</a>
