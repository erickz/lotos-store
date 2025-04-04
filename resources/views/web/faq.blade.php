@extends('layouts.web.web')

@section('titlePage', 'Perguntas Frequentes | Tire suas dúvidas!')
@section('descriptionPage', 'Perguntas rápidas sobre Bolões, pagamentos, premiações e segurança. Confira nosso FAQ e aposte com mais tranquilidade!')

@section('content')

<!--begin::Entry-->
<!--begin::Entry-->
<div class="mt-5">
    <!--begin::Container-->
    <div class="p-5 container">
        <h1 class='ps-0 mb-0 text-secondary'><b>FAQ</b></h1>

        <div class='w-100 mt-5'>
            <div class='bg-white p-5 col-md-12 rounded'>
                @include('web.faq_container', ['allFaq' => true])
            </div>  
        </div>

        @include('web.call-to-action-contact')
    </div><!--end::Container-->
</div><!--end::Entry-->

@endsection