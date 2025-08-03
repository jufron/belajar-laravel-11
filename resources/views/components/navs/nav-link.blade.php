<li class="nav-item">
    <a wire:navigate @class(['nav-link', 'active' => request()->routeIs($route)]) aria-current="page" href="{{ $href }}">{{ $label }}</a>
</li>
