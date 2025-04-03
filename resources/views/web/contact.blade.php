@extends('layouts.web.web')

@section('titlePage', 'Entre em Contato Conosco | ' . env('APP_NAME'))
@section('descriptionPage', 'Tem dúvidas, sugestões ou precisa de suporte? Entre em contato conosco e nossa equipe estará 
pronta para atender você.')

@section('content')

<!--begin::Entry-->
<!--begin::Entry-->
<div class="mt-5">
    <!--begin::Container-->
    <div class="p-5 container">
        <h1 class='ps-0 mb-0 text-secondary'><b>Contato</b></h1>

        <div class='row'>
            <div class='mt-5 bg-white p-5 col-md-12 rounded'>
                <!--begin::Form-->
                <form id='contactForm' data-url="{{ route('web.staticPages.contactPost') }}" method="POST" class="form form-ajax">
                    {{ csrf_field() }}

                    <div class="card-body">

                        <div class="alert d-none mb-5"></div>

                        <div class="form-group row p-1">
                            <div class="col-lg-12">
                                <label><strong>Nome*:</strong></label>
                                <input type="text" name="name" class="form-control" value="{{ old('full_name') }}" />
                            </div>
                        </div>
                        <div class="form-group row p-1">
                            <div class="col-lg-12">
                                <label><strong>Email*:</strong></label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" />
                            </div>
                        </div>
                        <div class="form-group row p-1">
                            <div class="col-lg-12">
                                <label><strong>Motivo de contato*:</strong></label>
                                <div class='max-w-150px'>
                                    <select name='reason' class='form-control border-secondary'>
                                        <option value='Dúvidas' {{ old('reason') == 'Dúvidas' ? 'selected="selected"' : '' }}>Dúvidas</option>
                                        <option value='Sugestões' {{ old('reason') == 'Sugestões' ? 'selected="selected"' : '' }}>Sugestões</option>
                                        <option value='Reclamações' {{ old('reason') == 'Reclamações' ? 'selected="selected"' : '' }}>Reclamações</option>
                                        <option value='Outros' {{ old('reason') == 'Outros' ? 'selected="selected"' : '' }}>Outros</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row p-1">
                            <div class="col-lg-12">
                                <label><strong>Mensagem*:</strong></label>
                                <textarea name='message' class='form-control'></textarea>
                            </div>
                        </div>
                        <!-- <div class="form-group row p-1">
                            <div class="col-lg-12">
                                <label><strong>Captcha*:</strong></label>
                                <div class='position-relative'>
                                    {!! RecaptchaV3::field('captcha') !!}
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group p-0 mt-3">
                            <button class="btn btn-success ms-1 btn-send"><strong>Enviar</strong></button>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div><!--end::Container-->
</div><!--end::Entry-->

@endsection