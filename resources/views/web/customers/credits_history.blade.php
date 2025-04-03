@extends('layouts.web.web')

@section('titlePage', 'Seu histórico de créditos | ' . env('APP_NAME'))
@section('descriptionPage', 'Confira o seu histórico de créditos')

@section('content')

@include('web.customers.register_modal')
@include('web.customers.login_modal')

<!--begin::Entry-->
<div class="d-flex flex-column-fluid mt-5" id='user-profile'>
    <!--begin::Container-->
    <div class="container">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                @include('web.customers.menu')
                
                <div class="profile-user-info mt-4">
                    <h2>Seu histórico de créditos</h2>

                    <div>
                        <!--begin::Timeline-->
                        <div class="timeline timeline-2 max-h-250px overflow-auto">
                            <div class="timeline-bar"></div>
                            @foreach($customer->creditsHistory()->orderBy('created_at', 'DESC')->get() as $history)
                                <div class="timeline-item">
                                    <span class="timeline-badge {{ $history->type == 'add' ? 'bg-success' : 'bg-warning' }}"></span>
                                    <div class="timeline-content d-flex align-items-center justify-content-between">
                                        <span class="mr-3">
                                            {{ $history->getFormattedAmount() . ($history->type == 'add' ? ' adicionados' : ' descontados') }}
                                        </span>
                                        <span class="text-muted font-italic text-right">{{ $history->getCreatedAtFormatted() }}</span>
                                    </div>
                                </div>
                            @endforeach
                            <div class="timeline-item">
                                <span class="timeline-badge"></span>
                                <div class="timeline-content d-flex align-items-center justify-content-between">
                                    <span class="mr-3">New order has been placed and pending for processing.</span>
                                    <span class="text-muted text-right">2 days ago</span>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <span class="timeline-badge bg-danger"></span>
                                <div class="timeline-content d-flex align-items-center justify-content-between">
                                    <span class="mr-3">Database server overloaded 80% and requires quick reboot
                                    <span class="label label-inline label-danger font-weight-bolder">pending</span></span>
                                    <span class="text-muted text-right">3 days ago</span>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <span class="timeline-badge bg-warning"></span>
                                <div class="timeline-content d-flex align-items-center justify-content-between">
                                    <span class="mr-3">System error occured and hard drive has been shutdown.</span>
                                    <span class="text-muted font-italic text-right">5 days ago</span>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <span class="timeline-badge bg-success"></span>
                                <div class="timeline-content d-flex align-items-center justify-content-between">
                                    <span class="mr-3">Production server is rebooting.</span>
                                    <span class="text-muted text-right">1 month ago</span>
                                </div>
                            </div>
                        </div>
                        <!--end::Timeline-->
                    </div>
                </div><!-- /profile-user-info -->    
            </div><!-- /main-box -->
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

@endsection