<div class="topbar d-flex align-items-center">            
    @if(! Auth::guard('web')->check())
        <div class="topbar-item responsive-item">
            <button type="button" class="btn btn-success mr5" data-toggle="modal" data-target="#loginModal">
                <b>Login</b>
            </button>

            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#registerModal">
                <b>Cadastre-se!</b>
            </button>
        </div>
    @else
        <div class="topbar-item me-5 responsive-item">
            <div class="text-dark d-flex order-2 order-md-1 copyright align-items-center">
                <a href="{{ route('web.customers.mybuys') }}" class="me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill='#333' viewBox="0 0 16 16" width="35" height="35"><path d="M10.561 8.073a6.005 6.005 0 0 1 3.432 5.142.75.75 0 1 1-1.498.07 4.5 4.5 0 0 0-8.99 0 .75.75 0 0 1-1.498-.07 6.004 6.004 0 0 1 3.431-5.142 3.999 3.999 0 1 1 5.123 0ZM10.5 5a2.5 2.5 0 1 0-5 0 2.5 2.5 0 0 0 5 0Z"></path></svg>
                </a>
                <div class="text-dark-75 align-items-center">
                    <div class="customer-name">
                        <b>Olá, {{ auth()->guard('web')->user()->getFirstName() }}</b>
                    </div>
                    <div class='d-flex'>
                        <a href="{{ route('web.customers.bets') }}" class="customer-text color-default"><b>Meu Perfil</b></span>
                        <span class='border border-light me-2 ms-2'></span>
                        <a href='{{ route("web.customers.logout") }}' class="text-dark-75 align-items-center me-1 link-logout">Sair</a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class='cart-section me-5'>
        <div class="topbar-item">
            @if(session()->get('cart.boloes'))
                <label class='label label-danger labelNotifications'>{{ count(session()->get('cart.boloes')) }}</label>
            @endif

            <a href="{{ route('web.cart') }}" class="btn btn-icon btn-lg mr-1 border-secondary">
                <i class='fas fa-shopping-cart text-primary'></i>
            </a>
        </div>
    </div>
</div>