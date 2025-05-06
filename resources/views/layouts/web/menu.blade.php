@if(! Auth::guard('web')->check())
    <ul class="menu-nav">
        <li class="menu-item menu-item-submenu menu-item-rel {{ request()->routeIs('web.home') ? 'menu-item-open menu-item-here' : '' }}" data-menu-toggle="click" aria-haspopup="true">
            <a href="/#home" class="menu-link">
                <span class="menu-text"><b>Home</b></span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="menu-item menu-item-submenu menu-item-rel {{ request()->routeIs('web.boloes.listing') ? 'menu-item-open menu-item-here' : '' }}" data-menu-toggle="click" aria-haspopup="true">
            <a href="{{ route('web.boloes.listing') }}" class="menu-link">
                <span class="menu-text"><b>Bolões</b></span>
                <span class="menu-desc"></span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="menu-item menu-item-submenu menu-item-rel {{ request()->routeIs('web.staticPages.howItWorks') ? 'menu-item-open menu-item-here' : '' }}" data-menu-toggle="click" aria-haspopup="true">
            <a href="/#howItWorks" class="menu-link">
                <span class="menu-text"><b>Como funciona</b></span>
                <span class="menu-desc"></span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
            <a href="/#advantages" class="menu-link">
                <span class="menu-text"><b>Vantagens</b></span>
                <span class="menu-desc"></span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="menu-item menu-item-submenu menu-item-rel {{ request()->routeIs('web.staticPages.faq') ? 'menu-item-open menu-item-here' : '' }}" data-menu-toggle="click" aria-haspopup="true">
            <a href="{{ route('web.staticPages.faq') }}" class="menu-link">
                <span class="menu-text"><b>FAQ</b></span>
                <span class="menu-desc"></span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="menu-item menu-item-submenu menu-item-rel {{ request()->routeIs('web.staticPages.partners') ? 'menu-item-open menu-item-here' : '' }}" data-menu-toggle="click" aria-haspopup="true">
            <a href="{{ route('web.staticPages.partners') }}" class="menu-link">
                <span class="menu-text"><b>Seja um parceiro</b></span>
                <span class="menu-desc"></span>
                <i class="menu-arrow"></i>
            </a>
        </li>
    </ul>
@else
<ul class="menu-nav">
        <li class="menu-item menu-item-submenu menu-item-rel menu-item-open menu-item-here" data-menu-toggle="click" aria-haspopup="true">
            <a href="{{ route("web.boloes.create") }}" class="menu-link bg-success text-white">
                <span class="menu-text"><b>+ Criar Bolão</b></span>
                <span class="menu-desc"></span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="menu-item menu-item-submenu menu-item-rel {{ request()->routeIs('web.boloes.listing') ? 'menu-item-open menu-item-here' : '' }}" data-menu-toggle="click" aria-haspopup="true">
            <a href="{{ route('web.boloes.listing') }}" class="menu-link">
                <span class="menu-text"><b>Bolões</b></span>
                <span class="menu-desc"></span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="menu-item menu-item-submenu menu-item-rel {{ request()->routeIs('web.customers.mybuys') ? 'menu-item-open menu-item-here' : '' }}" data-menu-toggle="click" aria-haspopup="true">
            <a href="{{ route('web.customers.mybuys') }}" class="menu-link">
                <span class="menu-text"><b>Compras</b></span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="menu-item menu-item-submenu menu-item-rel {{ request()->routeIs('web.customers.bets') ? 'menu-item-open menu-item-here' : '' }}" data-menu-toggle="click" aria-haspopup="true">
            <a href="{{ route("web.customers.bets") }}" class="menu-link">
                <span class="menu-text"><b>Meus Bolões</b></span>
                <span class="menu-desc"></span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="menu-item menu-item-submenu menu-item-rel {{ request()->routeIs('web.customers.rescue') ? 'menu-item-open menu-item-here' : '' }}" data-menu-toggle="click" aria-haspopup="true">
            <a href="{{ route('web.customers.rescue') }}" class="menu-link">
                <span class="menu-text"><b>Créditos</b></span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="menu-item menu-item-submenu menu-item-rel {{ request()->routeIs('web.customers.edit') ? 'menu-item-open menu-item-here' : '' }}" data-menu-toggle="click" aria-haspopup="true">
            <a href="{{ route('web.customers.edit') }}" class="menu-link">
                <span class="menu-text"><b>Alterar dados</b></span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="menu-item menu-item-submenu menu-item-rel {{ request()->routeIs('web.boloes.customer', [auth()->guard('web')->user()->id, auth()->guard('web')->user()->getProfileNameForURL()]) ? 'menu-item-open menu-item-here' : '' }}" data-menu-toggle="click" aria-haspopup="true">
            <a href="{{ route("web.boloes.customer", [auth()->guard('web')->user()->id, auth()->guard('web')->user()->getProfileNameForURL()]) }}" class="menu-link">
                <span class="menu-text"><b>Minha página</b></span>
                <span class="menu-desc"></span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="menu-item menu-item-submenu menu-item-rel {{ request()->routeIs('web.customers.logout') ? 'menu-item-open menu-item-here' : '' }}" data-menu-toggle="click" aria-haspopup="true">
            <a href="{{ route('web.customers.logout') }}" class="menu-link">
                <span class="menu-text"><b>Sair</b></span>
                <i class="menu-arrow"></i>
            </a>
        </li>
    </ul>
@endif