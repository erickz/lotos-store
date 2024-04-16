<ul class="menu-nav">
    <li class="menu-item menu-item-submenu menu-item-rel {{ request()->routeIs('web.home') ? 'menu-item-open menu-item-here' : '' }}" data-menu-toggle="click" aria-haspopup="true">
        <a href="/" class="menu-link">
            <span class="menu-text">Home</span>
            <i class="menu-arrow"></i>
        </a>
    </li>
    <li class="menu-item menu-item-submenu menu-item-rel {{ request()->routeIs('web.boloes.listing') || request()->routeIs('web.boloes.listingByLot') || request()->routeIs('web.boloes.listing_all') || request()->routeIs('web.boloes.customer') ? 'menu-item-open menu-item-here' : '' }}" data-menu-toggle="click" aria-haspopup="true">
        <a href="{{ route('web.boloes.listing') }}" class="menu-link">
            <span class="menu-text">Bolões</span>
            <span class="menu-desc"></span>
            <i class="menu-arrow"></i>
        </a>
    </li>
    <li class="menu-item menu-item-submenu menu-item-rel {{ request()->routeIs('web.boloes.create') || request()->routeIs('web.boloes.config') || request()->routeIs('web.boloes.finalize') ? 'menu-item-open menu-item-here' : '' }}" data-menu-toggle="click" aria-haspopup="true">
        <a href="{{ route('web.boloes.create') }}" class="menu-link">
            <span class="menu-text">Criar Bolão</span>
            <span class="menu-desc"></span>
            <i class="menu-arrow"></i>
        </a>
    </li>
    <!-- @if(auth()->guard('web')->check())
        <li class="menu-item menu-item-submenu menu-item-rel {{ request()->routeIs('web.credits.index') ? 'menu-item-open menu-item-here' : '' }}" data-menu-toggle="click" aria-haspopup="true">
            <a href="{{ route('web.credits.index') }}" class="menu-link">
                <span class="menu-text">Comprar Créditos</span>
                <span class="menu-desc"></span>
                <i class="menu-arrow"></i>
            </a>
        </li>
    @endif -->
    <li class="menu-item menu-item-submenu menu-item-rel {{ request()->routeIs('web.staticPages.howItWorks') ? 'menu-item-open menu-item-here' : '' }}" data-menu-toggle="click" aria-haspopup="true">
        <a href="{{ route('web.staticPages.howItWorks') }}" class="menu-link">
            <span class="menu-text">Como funciona</span>
            <span class="menu-desc"></span>
            <i class="menu-arrow"></i>
        </a>
    </li>
    <li class="menu-item menu-item-submenu menu-item-rel {{ request()->routeIs('web.results') || request()->routeIs('web.results.byLotery') ? 'menu-item-open menu-item-here' : '' }}" data-menu-toggle="click" aria-haspopup="true">
        <a href="{{ route('web.results') }}" class="menu-link">
            <span class="menu-text">Resultados</span>
            <span class="menu-desc"></span>
            <i class="menu-arrow"></i>
        </a>
    </li>
    <li class="menu-item menu-item-submenu menu-item-rel {{ request()->routeIs('web.staticPages.contact') ? 'menu-item-open menu-item-here' : '' }}" data-menu-toggle="click" aria-haspopup="true">
        <a href="{{ route('web.staticPages.contact') }}" class="menu-link">
            <span class="menu-text">Contato</span>
            <span class="menu-desc"></span>
            <i class="menu-arrow"></i>
        </a>
    </li>
</ul>