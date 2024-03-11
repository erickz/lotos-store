<div id="kt_header" class="header header-fixed">
    <!--begin::Container-->
    <div class="container d-flex align-items-stretch justify-content-between">

        <div class="d-flex align-items-stretch mr-3">
            <!--begin::Header Logo-->
            <div class="header-logo">
                <a href="{{ route('web.home') }}">
                    <img alt="Logo Lotos Fácil" title="Lotos Fácil" src="{{ asset('img/logo-lotos-facil.png') }}" class="max-h-75px">
                </a>
            </div><!--end::Header Logo-->

            <!--begin::Header Menu Wrapper-->
            <div class="header-menu-wrapper header-menu-wrapper-left">
                <!--begin::Header Menu-->
                <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                    <!--begin::Header Nav-->
                    @include('layouts.web.menu')
                </div>
                <!--end::Header Menu-->
            </div>
            <!--end::Header Menu Wrapper-->
        </div><!-- d-flex -->

        @include('layouts.web.header-toolbar')
    </div>
    <!--end::Container-->
</div>