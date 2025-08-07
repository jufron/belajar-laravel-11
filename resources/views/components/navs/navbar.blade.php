<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <x-navs.nav-link href="{{ route('home') }}" label="Home" route="home" />
                <x-navs.nav-link href="{{ route('about') }}" label="About" route="about" />
                <x-navs.nav-link href="{{ route('contact') }}" label="Contact" route="contact" />
                <x-navs.nav-link href="{{ route('user') }}" label="User" route="user" />
                <x-navs.nav-link href="{{ route('produk') }}" label="Produk" route="produk" />
            </ul>
        </div>
    </div>
</nav>
