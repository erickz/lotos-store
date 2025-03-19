<div class="wizard-nav border-bottom m-auto">
    <div class="wizard-steps d-flex justify-content-center px-4 border border-secondary rounded py-2">
        {{--<div class="wizard-step me-10 d-flex align-items-center text-center" data-wizard-type="step" data-wizard-state="current">
            <div class="wizard-label">
                <span class="svg-icon svg-icon-4x wizard-icon {{ request()->routeIs('web.cart.customer') ? 'svg-icon-primary' : '' }}"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo2\dist/../src/media/svg/icons\General\User.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24"/>
                        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                        <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                        </g>
                    </svg><!--end::Svg Icon-->
                </span>
                <h3 class="wizard-title {{ request()->routeIs('web.cart.customer') ? 'text-primary' : '' }}"><b>1. Identificação</b></h3>
            </div>
        </div>--}}
        <div class="wizard-step me-10 d-flex align-items-center text-center" data-wizard-type="step" data-wizard-state="pending">
            <div class="wizard-label">
                <span class="svg-icon svg-icon-4x wizard-icon {{ request()->routeIs('web.payments.index') ? 'svg-icon-primary' : '' }}"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo2\dist/../src/media/svg/icons\Shopping\Credit-card.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <rect fill="#000000" opacity="0.3" x="2" y="5" width="20" height="14" rx="2"/>
                            <rect fill="#000000" x="2" y="8" width="20" height="3"/>
                            <rect fill="#000000" opacity="0.3" x="16" y="14" width="4" height="2" rx="1"/>
                        </g>
                    </svg><!--end::Svg Icon-->
                </span>
                <h3 class="wizard-title {{ request()->routeIs('web.payments.index') ? 'text-primary' : '' }}"><b>1. Pagamento</b></h3>
            </div>
        </div>
        <div class="wizard-step d-flex align-items-center text-center" data-wizard-type="step" data-wizard-state="pending">
            <div class="wizard-label">
                <span class="svg-icon svg-icon-4x wizard-icon {{ request()->routeIs('web.payments.finish') || request()->routeIs('web.payments.finish_boloes') ? 'svg-icon-primary' : '' }}"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo2\dist/../src/media/svg/icons\General\Like.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M9,10 L9,19 L10.1525987,19.3841996 C11.3761964,19.7920655 12.6575468,20 13.9473319,20 L17.5405883,20 C18.9706314,20 20.2018758,18.990621 20.4823303,17.5883484 L21.231529,13.8423552 C21.5564648,12.217676 20.5028146,10.6372006 18.8781353,10.3122648 C18.6189212,10.260422 18.353992,10.2430672 18.0902299,10.2606513 L14.5,10.5 L14.8641964,6.49383981 C14.9326895,5.74041495 14.3774427,5.07411874 13.6240179,5.00562558 C13.5827848,5.00187712 13.5414031,5 13.5,5 L13.5,5 C12.5694044,5 11.7070439,5.48826024 11.2282564,6.28623939 L9,10 Z" fill="#000000"/>
                            <rect fill="#000000" opacity="0.3" x="2" y="9" width="5" height="11" rx="1"/>
                        </g>
                    </svg><!--end::Svg Icon-->
                </span>
                <h3 class="wizard-title {{ request()->routeIs('web.payments.finish') || request()->routeIs('web.payments.finish_boloes') ? 'text-primary' : '' }}"><b>2. Sucesso</b></h3>
            </div>
        </div>
    </div>
</div>