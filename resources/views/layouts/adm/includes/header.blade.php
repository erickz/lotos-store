@section('header')
<header class="navbar" id="header-navbar">
    <div class="container">
        <a href="{{ route('web.home') }}" id="logo" class="navbar-brand col-md-3 col-sm-3 col-xs-12">
            <img src="{{ asset('img/icon-lotos-facil.png') }}" alt="" width="25"/> <span>{{ env('APP_NAME') }}</span>
        </a>

        <button class="navbar-toggle" data-target=".navbar-ex1-collapse" data-toggle="collapse" type="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="fa fa-bars"></span>
        </button>

        <div class="nav-no-collapse pull-right" id="header-nav">
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown profile-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs">{{ auth()->user()->getNameWithUppercase() }}</span> <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('adm.users.edit', [ auth()->user()->id ]) }}"><i class="fa fa-user"></i>Profile</a></li>
                        <li><a href="{{ route('adm.auth.logout') }}"><i class="fa fa-power-off"></i>Logout</a></li>
                    </ul>
                </li>
                <li class="hidden-xxs">
                    <a class="btn" href="{{ route('adm.auth.logout') }}">
                        <i class="fa fa-power-off"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>
@show