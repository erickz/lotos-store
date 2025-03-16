<div class="topbar d-flex align-items-center">            
    @if(! Auth::guard('web')->check())
        <div class="topbar-item responsive-item">
            <button type="button" class="btn btn-success mr5" data-toggle="modal" data-target="#loginModal">
                <b>Login</b>
            </button>

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registerModal">
                <b>Criar Conta</b>
            </button>
        </div>
    @else
        <div class="topbar-item me-5 responsive-item">
            <div class="text-dark d-flex order-2 order-md-1 copyright align-items-center">
                <div class="text-dark-75 align-items-center">
                    <div class="customer-name text-center">
                        <b>Seu saldo </b><br />
                        <label class='bg-success p-2 badge'><b>{{ auth()->guard('web')->user()->getFormattedCredits() }}</b></label>
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