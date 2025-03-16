<nav class="nav nav-tabs d-flex-responsive">
<a class="nav-link {{ Route::is('web.customers.bets') ? 'active' : '' }}" href="{{ route('web.customers.bets') }}"><b>Meus Bolões</b></a>
    <a class="nav-link {{ Route::is('web.customers.mybuys') ? 'active' : '' }}" href="{{ route('web.customers.mybuys') }}"><b>Minhas Compras</b></a>
    <a class="nav-link {{ Route::is('web.customers.edit') ? 'active' : '' }}" href="{{ route('web.customers.edit') }}"><b>Alterar Dados</b></a>
    <a class="nav-link {{ Route::is('web.customers.rescue') ? 'active' : '' }}" href="{{ route('web.customers.rescue') }}"><b>Créditos</b></a>
    <a class="nav-link {{ Route::is('web.credits.index') ? 'active' : '' }} text-primary" href="{{ route('web.credits.index') }}"><b>Comprar Créditos</b></a>
    <!-- <a class="nav-link" href="#">Meu plano</a> -->
</nav><!-- /nav -->