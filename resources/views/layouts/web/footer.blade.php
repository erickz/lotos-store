<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
        <div class="text-dark order-2 order-md-1 copyright align-items-center">
            <a href="#" target="_blank" class="text-dark-75 text-hover-primary d-flex align-items-center">
                <i class="icon icon-logo d-flex me-2"></i>
                <div>
                    <span class="d-block"><b>{{ env('APP_NAME') }}</b> - 2025</span>
                </div>
            </a>
        </div>
        <div class="nav nav-dark order-1 order-md-2">
            <a href="{{ route('web.staticPages.faq') }}" class="nav-link pr-3 pl-0">Ajuda</a>
            <a href="{{ route('web.staticPages.about') }}" class="nav-link pr-3 pl-0">Sobre nós</a>
            <a href="{{ route('web.staticPages.contact') }}" class="nav-link pr-3 pl-0">Contato</a>
        </div>
</div><!-- /footer -->